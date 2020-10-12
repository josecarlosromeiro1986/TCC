<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Client;
use App\Collaborator;
use App\Schedule;
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
        return view('reports.attendances.index');
    }

    public function tatuador()
    {
        $collaborators = Collaborator::where('access.access', 'TATUADOR')
            ->join('offices', 'offices.id', '=', 'collaborators.office_id')
            ->join('access', 'access.id', '=', 'offices.access_id')
            ->select('collaborators.*')
            ->get();

        $years = Schedule::selectRaw("DATE_FORMAT(schedules.start, '%Y') as year")
            ->groupByRaw("DATE_FORMAT(schedules.start, '%Y')")
            ->orderby('schedules.start', 'DESC')
            ->get();

        return view('reports.tatuador.index', [
            'years' => $years,
            'collaborators' => $collaborators
        ]);
    }

    public function collaboratorPdf(Request $request)
    {
        //dd($request->type);
        switch ($request->type) {

            case 'ACTIVE':
                $collaborators = Collaborator::where('collaborators.active', '=', 'Y')
                    ->orderby('collaborators.active', 'ASC')
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
                    ->orderby('collaborators.active', 'ASC')
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
                $collaborators = Collaborator::orderby('active', 'ASC')
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

        if (count($collaborators) == 0) {
            return back()->withInput()
                ->with('error', 'Não existe Colaborador com este filtro!');
        }

        $pdf = PDF::loadView($view, [
            'collaborators' => $collaborators,
            'amount' => count($collaborators)
        ]);

        return $pdf->setPaper('a4')->download($name);
    }

    public function clientPdf(Request $request)
    {
        switch ($request->type) {

            case 'ACTIVE':
                $clients = Client::where('clients.active', '=', 'Y')
                    ->leftJoin('attendances', 'attendances.client_id', '=', 'clients.id')
                    ->selectRaw('clients.*, COUNT(attendances.client_id) as attendances')
                    ->groupBy('clients.id')
                    ->orderby('clients.active', 'ASC')
                    ->get();

                $view = 'reports.clients.active';
                $name = 'cli-ativos' . time() . '.pdf';
                break;

            case 'INACTIVE':
                $clients = Client::where('clients.active', '=', 'N')
                    ->leftJoin('attendances', 'attendances.client_id', '=', 'clients.id')
                    ->selectRaw('clients.*, COUNT(attendances.client_id) as attendances')
                    ->groupBy('clients.id')
                    ->orderby('clients.active', 'ASC')
                    ->get();

                $view = 'reports.clients.inactive';
                $name = 'cli-inativos' . time() . '.pdf';
                break;

            default:
                $clients = Client::leftJoin('attendances', 'attendances.client_id', '=', 'clients.id')
                    ->selectRaw('clients.*, COUNT(attendances.client_id) as attendances')
                    ->groupBy('clients.id')
                    ->orderby('active', 'ASC')
                    ->get();

                $view = 'reports.clients.all';
                $name = 'clientes' . time() . '.pdf';
                break;
        }
        //dd($clients);
        if (count($clients) == 0) {
            return back()->withInput()
                ->with('error', 'Não existe Cliente com este filtro!');
        }

        $pdf = PDF::loadView($view, [
            'clients' => $clients,
            'amount' => count($clients)
        ]);

        return $pdf->setPaper('a4')->download($name);
    }

    public function attendancePdf(Request $request)
    {
        $date = date('d/m/Y', strtotime($request->start)) . " até " . date('d/m/Y', strtotime($request->end));

        switch ($request->type) {

            case 'START':
                $attendances = Attendance::join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                    ->join('clients', 'clients.id', '=', 'attendances.client_id')
                    ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                    ->where([
                        ['schedules.start', '>=', $request->start],
                        ['schedules.end', '<=', $request->end],
                        ['attendances.status', '=', 'STARTED'],
                    ])->select(
                        'attendances.*',
                        'clients.name AS client',
                        'collaborators.name AS collaborator',
                        'schedules.start',
                        'schedules.end'
                    )->orderby('schedules.start', 'desc')
                    ->get();

                $view = 'reports.attendances.start';
                $name = 'atendimentos_iniciados' . time() . '.pdf';
                break;

            case 'CLOSED':
                $attendances = Attendance::join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                    ->join('clients', 'clients.id', '=', 'attendances.client_id')
                    ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                    ->where([
                        ['schedules.start', '>=', $request->start],
                        ['schedules.end', '<=', $request->end],
                        ['attendances.status', '=', 'FINISHED'],
                    ])->select(
                        'attendances.*',
                        'clients.name AS client',
                        'collaborators.name AS collaborator',
                        'schedules.start',
                        'schedules.end'
                    )->orderby('schedules.start', 'desc')
                    ->get();

                $view = 'reports.attendances.closed';
                $name = 'atendimentos_finalizados' . time() . '.pdf';
                break;

            case 'WAIT':
                $attendances = Attendance::join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                    ->join('clients', 'clients.id', '=', 'attendances.client_id')
                    ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                    ->where([
                        ['schedules.start', '>=', $request->start],
                        ['schedules.end', '<=', $request->end],
                        ['attendances.status', '=', 'WAIT'],
                    ])->select(
                        'attendances.*',
                        'clients.name AS client',
                        'collaborators.name AS collaborator',
                        'schedules.start',
                        'schedules.end'
                    )->orderby('schedules.start', 'desc')
                    ->get();

                $view = 'reports.attendances.wait';
                $name = 'atendimentos_esperando' . time() . '.pdf';
                break;

            default:
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

                $amount = count($attendances);
                $view = 'reports.attendances.all';
                $name = 'todos_atendimentos' . time() . '.pdf';
                break;
        }

        $amount = count($attendances);

        if ($amount == 0) {
            return back()->withInput()
                ->with('error', 'Não existe Atendimentos com este filtro!');
        }

        $pdf = PDF::loadView($view, [
            'attendances' => $attendances,
            'date' => $date,
            'amount' => $amount
        ]);

        return $pdf->setPaper('a4')->download($name);
    }

    public function tatuadorPdf(Request $request)
    {
        setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");

        $amount = 0;
        $total = 0;
        $title = '';

        if ($request->radio == 'MONTH') {

            if ($request->year == 'ALL') {

                if ($request->collaborator == 'ALL') {

                    $attendances = Attendance::join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                        ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                        ->where('attendances.status', 'FINISHED')
                        ->selectRaw("
                            collaborators.name,
                            COUNT(attendances.id) AS attendances,
                            schedules.start AS date
                        ")->groupByRaw("attendances.collaborator_id, DATE_FORMAT(schedules.start, '%m/%Y')")
                        ->orderbyRaw('schedules.start ASC')
                        ->get();

                    foreach ($attendances as $attendance) {
                        $amount += $attendance->attendances;
                    }

                    $total = count($attendances);
                    $view = 'reports.tatuador.all';
                    $name = 'todos_tatuadores' . time() . '.pdf';
                } else {

                    $collaborator = Collaborator::where('collaborators.id', $request->collaborator)->first();

                    $attendances = Attendance::where([
                        ['collaborators.id', $request->collaborator],
                        ['attendances.status', 'FINISHED'],
                    ])
                        ->join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                        ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                        ->selectRaw("
                            collaborators.name,
                            COUNT(attendances.id) AS attendances,
                            schedules.start AS date
                        ")->groupByRaw("attendances.collaborator_id, DATE_FORMAT(schedules.start, '%m/%Y')")
                        ->orderbyRaw('schedules.start ASC')
                        ->get();

                    foreach ($attendances as $attendance) {
                        $amount += $attendance->attendances;
                    }

                    $total = count($attendances);
                    $title = $collaborator->name;
                    $view = 'reports.tatuador.allYear';
                    $name = $collaborator->name . '_' . time() . '.pdf';
                }
            } else {

                if ($request->collaborator == 'ALL') {

                    $attendances = Attendance::whereRaw("DATE_FORMAT(schedules.start, '%Y') = $request->year")
                        ->where('attendances.status', 'FINISHED')
                        ->join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                        ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                        ->selectRaw("
                            collaborators.name,
                            COUNT(attendances.id) AS attendances,
                            schedules.start AS date
                        ")->groupByRaw("attendances.collaborator_id, DATE_FORMAT(schedules.start, '%m/%Y')")
                        ->orderbyRaw('schedules.start ASC')
                        ->get();

                    foreach ($attendances as $attendance) {
                        $amount += $attendance->attendances;
                    }

                    $total = count($attendances);
                    $title = $request->year;
                    $view = 'reports.tatuador.allCollaborator';
                    $name = $request->year . '_' . time() . '.pdf';
                } else {

                    $collaborator = Collaborator::where('collaborators.id', $request->collaborator)->first();

                    $attendances = Attendance::whereRaw("DATE_FORMAT(schedules.start, '%Y') = $request->year")
                        ->where([
                            ['collaborators.id', $request->collaborator],
                            ['attendances.status', 'FINISHED'],
                        ])
                        ->join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                        ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                        ->selectRaw("
                            collaborators.name,
                            COUNT(attendances.id) AS attendances,
                            schedules.start AS date
                        ")->groupByRaw("attendances.collaborator_id, DATE_FORMAT(schedules.start, '%m/%Y')")
                        ->orderbyRaw('schedules.start ASC')
                        ->get();

                    foreach ($attendances as $attendance) {
                        $amount += $attendance->attendances;
                    }

                    $total = count($attendances);
                    $title = $collaborator->name . ' em ' . $request->year;
                    $view = 'reports.tatuador.collaborator';
                    $name = $collaborator->name . '_' . $request->year . '_' . time() . '.pdf';
                }
            }
        } else {

            if ($request->year == 'ALL') {

                if ($request->collaborator == 'ALL') {

                    $attendances = Attendance::join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                        ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                        ->where('attendances.status', 'FINISHED')
                        ->selectRaw("
                            collaborators.name,
                            COUNT(attendances.id) AS attendances,
                            schedules.start AS date
                        ")->groupByRaw("attendances.collaborator_id, DATE_FORMAT(schedules.start, '%Y')")
                        ->orderbyRaw('schedules.start ASC')
                        ->get();

                    foreach ($attendances as $attendance) {
                        $amount += $attendance->attendances;
                    }

                    $total = count($attendances);
                    $view = 'reports.tatuador.allForYear';
                    $name = 'todos_anos_' . time() . '.pdf';
                } else {

                    $collaborator = Collaborator::where('collaborators.id', $request->collaborator)->first();

                    $attendances = Attendance::where([
                        ['collaborators.id', $request->collaborator],
                        ['attendances.status', 'FINISHED'],
                    ])
                        ->join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                        ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                        ->selectRaw("
                            collaborators.name,
                            COUNT(attendances.id) AS attendances,
                            schedules.start AS date
                        ")->groupByRaw("attendances.collaborator_id, DATE_FORMAT(schedules.start, '%Y')")
                        ->orderbyRaw('collaborators.name, schedules.start ASC')
                        ->get();

                    foreach ($attendances as $attendance) {
                        $amount += $attendance->attendances;
                    }

                    $total = count($attendances);
                    $title = $collaborator->name;
                    $view = 'reports.tatuador.collaboratorAllYear';
                    $name = 'todos_anos_' . $collaborator->name . '_' . time() . '.pdf';
                }
            } else {

                if ($request->collaborator == 'ALL') {

                    $attendances = Attendance::whereRaw("DATE_FORMAT(schedules.start, '%Y') = $request->year")
                        ->where('attendances.status', 'FINISHED')
                        ->join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                        ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                        ->selectRaw("
                            collaborators.name,
                            COUNT(attendances.id) AS attendances,
                            schedules.start AS date
                        ")->groupByRaw("attendances.collaborator_id, DATE_FORMAT(schedules.start, '%Y')")
                        ->orderbyRaw('collaborators.name, schedules.start ASC')
                        ->get();

                    foreach ($attendances as $attendance) {
                        $amount += $attendance->attendances;
                    }

                    $total = count($attendances);
                    $title = $request->year;
                    $view = 'reports.tatuador.allCollaboratorForYear';
                    $name = $request->year . '_' . time() . '.pdf';
                } else {

                    $collaborator = Collaborator::where('collaborators.id', $request->collaborator)->first();

                    $attendances = Attendance::whereRaw("DATE_FORMAT(schedules.start, '%Y') = $request->year")
                        ->where([
                            ['collaborators.id', $request->collaborator],
                            ['attendances.status', 'FINISHED'],
                        ])
                        ->join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
                        ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
                        ->selectRaw("COUNT(attendances.id) AS attendances")
                        ->groupByRaw("attendances.collaborator_id, DATE_FORMAT(schedules.start, '%Y')")
                        ->orderbyRaw('collaborators.name, schedules.start ASC')
                        ->first();

                    if (is_null($attendances)) {

                        $amount = 0;
                        $total = 0;
                    } else {

                        $amount = $attendances->attendances;
                        $total = $attendances->attendances;
                    }

                    $title = $collaborator->name . ' em ' . $request->year;
                    $view = 'reports.tatuador.CollaboratorForYear';
                    $name = $collaborator->name . '_' . $request->year . '_' . time() . '.pdf';
                }
            }
        }


        if ($total == 0) {
            return back()->withInput()
                ->with('error', 'Não existe Atendimentos com este filtro!');
        }

        $pdf = PDF::loadView($view, [
            'attendances' => $attendances,
            'amount' => $amount,
            'title' => $title
        ]);

        return $pdf->setPaper('a4')->download($name);
    }
}
