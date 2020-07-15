<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypePhoneRequest;
use App\TypePhone;
use Illuminate\Http\Request;

class TypePhoneController extends Controller
{
    private $typePhone;

    public function __construct(TypePhone $typePhone)
    {
        $this->typePhone = $typePhone;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typePhones = $this->typePhone
            ->where('active', 'Y')
            ->paginate(5)
            ->onEachSide(0);

        return view('phone.typePhone.index', [
            'typePhones' => $typePhones,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phone.typePhone.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypePhoneRequest $request)
    {
        $this->typePhone->description = $request->description;
        $this->typePhone->save();

        return redirect()
            ->route('typePhone.index')
            ->with('success', 'Tipo Telefone: "' . $request->description . '" Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TypePhone  $typePhone
     * @return \Illuminate\Http\Response
     */
    public function show(TypePhone $typePhone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TypePhone  $typePhone
     * @return \Illuminate\Http\Response
     */
    public function edit(TypePhone $typePhone)
    {
        return view('phone.typePhone.edit', [
            'typePhone' => $typePhone,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TypePhone  $typePhone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypePhone $typePhone)
    {
        $typePhone->update(
            $request->except('_token', '_method')
        );

        return redirect()
            ->route('typePhone.index')
            ->with('success', 'Cargo: "' . $typePhone->description . '" editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypePhone  $typePhone
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypePhone $typePhone)
    {
        $typePhone->update([
            'active' => 'N',
        ]);

        return redirect()
            ->route('typePhone.index')
            ->with('success', 'Cargo: "' . $typePhone->description . '" deletado com sucesso!');
    }
}
