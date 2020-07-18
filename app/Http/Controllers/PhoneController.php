<?php

namespace App\Http\Controllers;

use App\Client;
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
        if (isset($request->collaborator_id)) {
            $this->phone->collaborator_id = $request->collaborator_id;
        }

        if (isset($request->client_id)) {
            $this->phone->client_id = $request->client_id;
        }

        $this->phone->number = $request->phone;
        $this->phone->contact = $request->contact;
        $this->phone->main = 'N';
        $this->phone->save();

        return redirect()->back()
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
        $phone->update([
            'number' => $request->phone,
            'contact' => $request->contact
        ]);

        return redirect()->back()
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
        if ($phone->main == 'Y') {
            return redirect()->back()
                ->with('error', 'O contato principal não pode ser deletado!');
        }

        $phone->update([
            'active' => 'N',
        ]);

        return redirect()->back()
            ->with('success', 'Contato: "' . $phone->contact . '" deletado com sucesso!');
    }
}
