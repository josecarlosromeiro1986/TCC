<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Phone;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->client
            ->join('phones', 'clients.id', '=', 'phones.client_id')
            ->select('clients.*', 'phones.number AS phone')
            ->where([
                ['clients.active', '=', 'Y'],
                ['phones.main', '=', 'Y']
            ])->orderByRaw('clients.name ASC')
            ->paginate(5)
            ->onEachSide(0);

        return view('client.index', [
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        if (!$this->validaCPF($request->cpf)) {

            return back()->withInput()
                ->with('error', 'CPF inválido, favor informe um CPF válido');
        }

        $client = $this->client->create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'birth' => $request->birth,
            'cep' => $request->cep,
            'address' => $request->address,
            'complement' => $request->complement,
            'number' => $request->number,
            'neighborhood' => $request->neighborhood,
            'state' => $request->state,
            'city' => $request->city,
            'note' => $request->note,
        ]);

        $phone = new Phone;
        $phone->number = $request->phone;
        $phone->client_id = $client->id;
        $phone->contact = $client->name;
        $phone->main = 'Y';
        $phone->save();

        return redirect()
            ->route('client.show', $client)
            ->with('success', 'Cliente: "' . $client->name . '" Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $phones = Phone::where([
            ['client_id', '=', $client->id],
            ['active', '=', 'Y'],
        ])->orderByRaw('main ASC, contact ASC')
            ->paginate(6)
            ->onEachSide(0);

        return view('client.show', [
            'client' => $client,
            'phones' => $phones
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $phone = Phone::where([
            ['client_id', '=', $client->id],
            ['main', '=', 'Y'],
        ])->first();

        return view('client.edit', [
            'client' => $client,
            'phone' => $phone,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        if (!$this->validaCPF($request->cpf)) {

            return back()->withInput()
                ->with('error', 'CPF inválido, favor informe um CPF válido');
        }

        Phone::where('id', $request->phone_id)
            ->update([
                'number' => $request->phone,
                'contact' => $request->name
            ]);

        $client->update(
            $request->except(
                '_method',
                '_token',
                'phone_id',
                'phone',
            )
        );

        return redirect()
            ->route('client.index')
            ->with('success', 'Cliente: "' . $client->name . '" Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->update([
            'active' => 'N',
        ]);

        return redirect()->back()
            ->with('success', 'Cliente: "' . $client->name . '" deletado com sucesso!');
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
        $clients = $this->client->search($request->filter);

        return view('client.index', [
            'clients' => $clients,
            'filters' => $filters,
        ]);
    }
}
