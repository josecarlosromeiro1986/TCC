<?php

namespace App\Http\Controllers;

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
        //dd('aqui');
        $typePhones = $this->typePhone
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TypePhone  $typePhone
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypePhone $typePhone)
    {
        //
    }
}
