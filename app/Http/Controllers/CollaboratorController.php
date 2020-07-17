<?php

namespace App\Http\Controllers;

use App\Collaborator;
use App\Office;
use App\Phone;
use Illuminate\Http\Request;

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
            ->select('collaborators.*', 'offices.description AS office', 'phones.number AS phone')
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
    public function store(Request $request)
    {
        $collaborator = $this->collaborator->create(
            $request->only(
                'name',
                'email',
                'cpf',
                'rg',
                'birth',
                'office_id',
                'start',
                'cep',
                'address',
                'complement',
                'number',
                'neighborhood',
                'state',
                'city',
                'user',
                'password',
                'note'
            )
        );

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
    public function update(Request $request, Collaborator $collaborator)
    {
        Phone::where('id', $request->phone_id)
            ->update([
                'number' => $request->phone,
                'contact' => $request->name
            ]);

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
        $collaborator->update([
            'active' => 'N',
        ]);

        Phone::where('collaborator_id', $collaborator->id)
            ->update([
                'active' => 'N',
            ]);

        return redirect()
            ->route('collaborator.index')
            ->with('success', 'Usuário: "' . $collaborator->name . '" deletado com sucesso!');
    }
}
