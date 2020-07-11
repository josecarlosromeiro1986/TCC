<?php

namespace App\Http\Controllers;

use App\Access;
use App\Http\Requests\OfficeRequest;
use App\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    private $office;

    public function __construct(Office $office)
    {
        $this->office = $office;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$offices = Office::orderBy('description', 'asc')->get();
        $offices = $this->office->join('access', 'offices.access_id', '=', 'access.id')
            ->select('offices.*', 'access.access')
            ->paginate(5)->onEachSide(0);
        //dd($offices);
        return view('office.index', [
            'offices' => $offices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $access = Access::paginate();

        return view('office.create', [
            'access' => $access,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfficeRequest $request)
    {
        $this->office->description = $request->description;
        $this->office->access_id = $request->access_id;
        $this->office->save();

        return redirect()->route('office.index')->with('success', 'Cargo: "' . $this->office->description . '" Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        if (!$office = $this->office->find($office->id)) {
            return redirect()->back();
        }

        $access = Access::paginate();

        return view('office.edit', [
            'office' => $office,
            'access' => $access,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function update(OfficeRequest $request, Office $office)
    {
        if (!$office = $this->office->find($office->id)) {
            return redirect()->back();
        }

        $data = $request->except('_token', '_method');

        $office->update($data);

        return redirect()->route('office.index')->with('success', 'Cargo: "' . $office->description . '" editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Office  $office
     * @return \Illuminate\Http\Response
     */
    public function destroy(Office $office)
    {
        //dd($office);

        /* if (!$office = $this->office->find($office->id)) {
            return redirect()->back();
        }

        $office->delete(); */

        return redirect()->route('office.index')->with('success', 'Cargo: "' . $office->description . '" deletado com sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');
        $offices = $this->office->search($request->filter);

        return view('office.index', [
            'offices' => $offices,
            'filters' => $filters,
        ]);
    }
}
