<?php

namespace App\Http\Controllers;

use App\Collaborator;
use Illuminate\Http\Request;
use PDF;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.collaborators.index');
    }

    public function pdf(Request $request)
    {
        //dd($request->type);
        switch ($request->type) {

            case 'ACTIVE':
                $collaborators = Collaborator::where('collaborators.active', '=', 'Y')
                    ->orderby('collaborators.active', 'asc')
                    ->join('offices', 'offices.id', '=', 'collaborators.office_id')
                    ->select(
                        'collaborators.name',
                        'collaborators.active',
                        'collaborators.start',
                        'collaborators.exit',
                        'offices.description',
                    )
                    ->get();

                    $view = 'reports.collaborators.active';
                    $name = 'ativos' . time() . '.pdf';
                break;

            case 'INACTIVE':
                $collaborators = Collaborator::where('collaborators.active', '=', 'N')
                    ->orderby('collaborators.active', 'asc')
                    ->join('offices', 'offices.id', '=', 'collaborators.office_id')
                    ->select(
                        'collaborators.name',
                        'collaborators.active',
                        'collaborators.start',
                        'collaborators.exit',
                        'offices.description',
                    )
                    ->get();

                    $view = 'reports.collaborators.inactive';
                    $name = 'ativos' . time() . '.pdf';
                break;

            default:
                $collaborators = Collaborator::orderby('active', 'asc')
                    ->join('offices', 'offices.id', '=', 'collaborators.office_id')
                    ->select(
                        'collaborators.name',
                        'collaborators.active',
                        'collaborators.start',
                        'collaborators.exit',
                        'offices.description',
                    )
                    ->get();

                    $view = 'reports.collaborators.all';
                    $name = 'ativos' . time() . '.pdf';
                break;
        }

        $pdf = PDF::loadView($view, ['collaborators' => $collaborators]);

        return $pdf->setPaper('a4')->download($name);
    }
}
