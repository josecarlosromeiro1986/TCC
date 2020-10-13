<?php

namespace App\Http\Controllers;

use App\Collaborator;
use App\Equipment;
use App\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $equipments = Equipment::where('equipment.active', 'Y')
        ->leftjoin('collaborators', 'collaborators.id', 'equipment.collaborator_id')
        ->select('equipment.*', 'collaborators.name as collaborator')->get();

        $products = Product::where('active', 'Y')->get();

        $collaborators = Collaborator::where('active', 'Y')
            ->select('id', 'name')->get();

        return view('stock.index', [
            'equipments' => $equipments,
            'products' => $products,
            'collaborators' => $collaborators
        ]);
    }
}
