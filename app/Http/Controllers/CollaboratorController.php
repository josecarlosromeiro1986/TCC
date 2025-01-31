<?php

namespace App\Http\Controllers;

use App\Collaborator;
use App\Http\Requests\CollaboratorRequest;
use App\Http\Requests\UpdateCollaboratorRequest;
use App\Office;
use App\Phone;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CollaboratorController extends Controller
{
    private $office;
    private $collaborator;

    public function __construct(Collaborator $collaborator, Office $office)
    {
        $this->office = $office;
        $this->collaborator = $collaborator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collaborators = $this->collaborator
            ->join('offices', 'collaborators.office_id', '=', 'offices.id')
            ->join('phones', 'collaborators.id', '=', 'phones.collaborator_id')
            ->select('collaborators.*', 'offices.description AS office', 'offices.access_id', 'phones.number AS phone')
            ->where([
                ['collaborators.active', '=', 'Y'],
                ['phones.main', '=', 'Y']
            ])->orderByRaw('collaborators.name ASC')
            ->paginate(5)
            ->onEachSide(0);

        return view('collaborator.index', [
            'collaborators' => $collaborators,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offices = $this->office
            ->where('active', 'y')
            ->select('id', 'description')
            ->get();

        return view('collaborator.create', [
            'offices' => $offices,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollaboratorRequest $request)
    {
        if (!$this->validaCPF($request->cpf)) {

            return back()->withInput()
                ->with('error', 'CPF inválido, favor informe um CPF válido');
        }

        $access = Office::where('offices.id', $request->office_id)
            ->join('access', 'access.id', 'offices.access_id')
            ->select('access.access')
            ->first();

        //dd($access->access);

        $collaborator = $this->collaborator->create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'birth' => $request->birth,
            'office_id' => $request->office_id,
            'start' => $request->start,
            'cep' => $request->cep,
            'address' => $request->address,
            'complement' => $request->complement,
            'number' => $request->number,
            'neighborhood' => $request->neighborhood,
            'state' => $request->state,
            'city' => $request->city,
            'password' => Hash::make($request->password),
            'note' => $request->note,
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'access' => $access->access
        ]);

        $phone = new Phone;
        $phone->number = $request->phone;
        $phone->collaborator_id = $collaborator->id;
        $phone->contact = $collaborator->name;
        $phone->main = 'Y';
        $phone->save();

        return redirect()
            ->route('collaborator.index')
            ->with('success', 'Usuário: "' . $collaborator->name . '" Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Collaborator  $collaborator
     * @return \Illuminate\Http\Response
     */
    public function show(Collaborator $collaborator)
    {
        $collaborator = $this->collaborator
            ->join('offices', 'collaborators.office_id', '=', 'offices.id')
            ->select('collaborators.*', 'offices.description as office')
            ->where([
                ['collaborators.id', '=',  $collaborator->id]
            ])->first();

        $phones = Phone::where([
            ['collaborator_id', '=', $collaborator->id],
            ['active', '=', 'Y']
        ])->orderByRaw('main ASC, contact ASC')
            ->paginate(6)
            ->onEachSide(0);

        return view('collaborator.show', [
            'collaborator' => $collaborator,
            'phones' => $phones,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Collaborator  $collaborator
     * @return \Illuminate\Http\Response
     */
    public function edit(Collaborator $collaborator)
    {
        $offices = $this->office
            ->where('active', 'y')
            ->select('id', 'description')
            ->get();

        $phone = Phone::where([
            ['collaborator_id', '=', $collaborator->id],
            ['main', '=', 'Y'],
        ])->first();

        return view('collaborator.edit', [
            'collaborator' => $collaborator,
            'offices' => $offices,
            'phone' => $phone,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Collaborator  $collaborator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCollaboratorRequest $request, Collaborator $collaborator)
    {
        if (!$this->validaCPF($request->cpf)) {

            return back()->withInput()
                ->with('error', 'CPF inválido, favor informe um CPF válido');
        }

        if ($request->office_id != 1) {
            $collaborators = $this->collaborator
                ->join('offices', 'collaborators.office_id', '=', 'offices.id')
                ->where([
                    ['collaborators.active', '=', 'Y'],
                    ['offices.access_id', '=', 1],
                    ['collaborators.id', '!=', $collaborator->id]
                ])->get();

            if (count($collaborators) == 0) {
                return back()->withInput()
                    ->with('error', 'O sistema deve ter pelo menos um Administrador!');
            }
        }

        Phone::where('id', $request->phone_id)
            ->update([
                'number' => $request->phone,
                'contact' => $request->name
            ]);

        User::where('email', $collaborator->email)->update(['email' => $request->email]);

        $collaborator->update(
            $request->except(
                '_method',
                '_token',
                'phone_id',
                'phone',
            )
        );

        return redirect()
            ->route('collaborator.index')
            ->with('success', 'Usuário: "' . $collaborator->name . '" Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Collaborator  $collaborator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collaborator $collaborator)
    {
        $collaborators = $this->collaborator
            ->join('offices', 'collaborators.office_id', '=', 'offices.id')
            ->where([
                ['collaborators.active', '=', 'Y'],
                ['offices.access_id', '=', 1],
                ['collaborators.id', '!=', $collaborator->id]
            ])->get();

        if (count($collaborators) == 0) {
            return back()->withInput()
                ->with('error', 'O sistema deve ter pelo menos um Administrador!');
        }

        $collaborator->update([
            'active' => 'N',
            'exit' => date('Y-m-d'),
        ]);

        Phone::where('collaborator_id', $collaborator->id)
            ->update([
                'active' => 'N',
            ]);

        User::where('email', $collaborator->email)->delete();

        return redirect()->back()
            ->with('success', 'Usuário: "' . $collaborator->name . '" deletado com sucesso!');
    }

    /**
     * Search by filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $collaborators = $this->collaborator->search($request->filter);

        return view('collaborator.index', [
            'collaborators' => $collaborators,
            'filters' => $filters,
        ]);
    }

    public function collaborators()
    {
        $collaborators = $this->collaborator
            ->where('active', 'Y')
            ->select('id', 'name')
            ->get();

        return view('schedule.index', [
            'collaborators' => $collaborators,
        ]);
    }
}
