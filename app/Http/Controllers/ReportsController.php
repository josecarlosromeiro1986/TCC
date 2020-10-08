<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Client;
use App\Collaborator;
use Illuminate\Http\Request;
use PDF;

class ReportsController extends Controller
{
    public function collaborator()
    {
        return view('reports.collaborators.index');
    }

    public function client()
    {
        return view('reports.clients.index');
    }

    public function attendance()
    {
        $collaborators = Collaborator::all();
        $clients = Client::all();

        return view('reports.attendances.index', [
            'collaborators' => $collaborators,
            'clients' => $clients
        ]);
    }

    public function collaboratorPdf(Request $request)
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
                $name = 'col-ativos' . time() . '.pdf';
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
                $name = 'col-inativos' . time() . '.pdf';
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
                $name = 'colaboradores' . time() . '.pdf';
                break;
        }

        $pdf = PDF::loadView($view, ['collaborators' => $collaborators]);

        return $pdf->setPaper('a4')->download($name);
    }

    public function clientPdf(Request $request)
    {
        //dd($request->type);
        switch ($request->type) {

            case 'ACTIVE':
                $clients = Client::where('clients.active', '=', 'Y')
                    ->orderby('clients.active', 'asc')
                    ->get();

                $view = 'reports.clients.active';
                $name = 'cli-ativos' . time() . '.pdf';
                break;

            case 'INACTIVE':
                $clients = Client::where('clients.active', '=', 'N')
                    ->orderby('clients.active', 'asc')
                    ->get();

                $view = 'reports.clients.inactive';
                $name = 'cli-inativos' . time() . '.pdf';
                break;

            default:
                $clients = Client::orderby('active', 'asc')
                    ->get();

                $view = 'reports.clients.all';
                $name = 'clientes' . time() . '.pdf';
                break;
        }

        $pdf = PDF::loadView($view, ['clients' => $clients]);

        return $pdf->setPaper('a4')->download($name);
    }

    public function attendancePdf(Request $request)
    {
        //dd($request->all());
        $date = date('d/m/Y', strtotime($request->start)) . " até " . date('d/m/Y', strtotime($request->end));
        $attendances = Attendance::join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
            ->join('clients', 'clients.id', '=', 'attendances.client_id')
            ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
            ->where([
                ['schedules.start', '>=', $request->start],
                ['schedules.end', '<=', $request->end]
            ])->select(
                'attendances.*',
                'clients.name AS client',
                'collaborators.name AS collaborator',
                'schedules.start',
                'schedules.end'
            )->orderby('schedules.start', 'desc')
            ->get();

        $pdf = PDF::loadView('reports.attendances.all', [
            'attendances' => $attendances,
            'date' => $date
            ]);

        return $pdf->setPaper('a4')->download('todos_atendimentos' . time() . '.pdf');
    }
}
