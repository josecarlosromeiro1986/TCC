<?php

namespace App\Http\Controllers;

use App\Collaborator;
use App\Phone;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    private $phone;

    public function __construct(Phone $phone)
    {
        $this->phone = $phone;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->phone->number = $request->phone;
        $this->phone->contact = $request->contact;
        $this->phone->collaborator_id = $request->collaborator_id;
        $this->phone->main = 'N';
        $this->phone->save();

        $collaborator = new Collaborator;
        $collaborator->id = $request->collaborator_id;

        return redirect()
            ->route('collaborator.show', $collaborator)
            ->with('success', 'Contato: "' . $request->contact . '" Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function edit(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phone $phone)
    {
        $collaborator = new Collaborator;
        $collaborator->id = $phone->collaborator_id;

        $phone->update([
            'number' => $request->phone,
            'contact' => $request->contact
        ]);

        return redirect()
            ->route('collaborator.show', $collaborator)
            ->with('success', 'Contato: "' . $request->contact . '" editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        $collaborator = new Collaborator;
        $collaborator->id = $phone->collaborator_id;

        $phone->update([
            'active' => 'N',
        ]);

        return redirect()
            ->route('collaborator.show', $collaborator)
            ->with('success', 'Contato: "' . $phone->contact . '" deletado com sucesso!');
    }
}
