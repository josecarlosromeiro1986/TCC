<?php

namespace App\Http\Controllers;

use App\AttendanceProduct;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
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
    public function store(ProductRequest $request)
    {
        $this->product->name = $request->name;
        $this->product->quantity = $request->quantity;
        $this->product->due = $request->due;
        $this->product->description = $request->description;
        $this->product->save();

        return redirect()
            ->route('stock.index')
            ->with('success', 'Insumo: "' . $request->name . '" Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update(
            $request->except(
                '_method',
                '_token',
            )
        );

        return redirect()->back()
            ->with('success', 'Insumo: "' . $product->name . '" Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->update([
            'active' => 'N',
        ]);

        return redirect()->back()
            ->with('success', 'Insumo: "' . $product->name . '" deletado com sucesso!');
    }

    public function move(Request $request)
    {
        $attendance = $request->attendance;
        $request = $request->except('_token', 'attendance');

        foreach ($request as $value) {

            if (isset($value[0]) && $value[1] > 0) {

                $attendanceProduct = AttendanceProduct::where([
                    ['attendance_id', $attendance],
                    ['product_id', $value[0]]
                ])->first();

                if (is_null($attendanceProduct)) {

                    $attendanceProduct = new AttendanceProduct;
                    $attendanceProduct->attendance_id = $attendance;
                    $attendanceProduct->product_id = $value[0];
                    $attendanceProduct->quantity_product = $value[1];
                    $attendanceProduct->save();
                } else {

                    $attendanceProduct->increment('quantity_product', $value[1]);
                }

                $this->product->where('id', $value[0])
                    ->decrement('quantity', $value[1]);
            }
        }

        return redirect()->back()
            ->with('success', 'Insumos: Adicionados com sucesso!');
    }
}
