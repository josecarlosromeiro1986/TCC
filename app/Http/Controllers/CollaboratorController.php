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
            ])//->toSql();
            ->orderByRaw('collaborators.name ASC')
            ->paginate(5)
            ->onEachSide(0);
        //dd($collaborators);
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
            ->paginate();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Collaborator  $collaborator
     * @return \Illuminate\Http\Response
     */
    public function edit(Collaborator $collaborator)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Collaborator  $collaborator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collaborator $collaborator)
    {
        //
    }
}
