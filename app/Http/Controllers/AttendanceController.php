<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Client;
use App\Collaborator;
use App\Http\Requests\ScheduleRequest;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    private $attendance;

    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = $this->attendance
            ->join('clients', 'attendances.client_id', '=', 'clients.id')
            ->join('collaborators', 'attendances.collaborator_id', '=', 'collaborators.id')
            ->join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
            ->select(
                'attendances.*',
                'clients.name AS client',
                'collaborators.name AS collaborator',
                'schedules.start'
            )
            ->orderBy('schedules.start', 'asc')
            ->paginate(5)
            ->onEachSide(0);
        // dd($attendances);
        return view('attendance.index', [
            'attendances' => $attendances,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::select('id', 'name')
            ->where([
                ['active', '=', 'Y'],
            ])->get();

        $collaborators = Collaborator::select('id', 'name')
            ->where([
                ['active', '=', 'Y'],
            ])->get();

        return view('attendance.create', [
            'clients' => $clients,
            'collaborators' => $collaborators,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        $schedules = DB::select("SELECT
                                        sc.*
                                    FROM
                                        schedules sc
                                        INNER JOIN attendances att
                                        ON att.id = sc.attendance_id
                                    WHERE att.collaborator_id = :collaborator
                                        AND :date BETWEEN sc.start
                                        AND sc.end", ['date' => $request->start, 'collaborator' => $request->collaborator_id]);

        if (count($schedules) > 0) {
            return back()->withInput()
                ->with('error', 'Já existe um atendimento com está data!');
        }

        $schedules = DB::select("SELECT
                                        sc.*
                                    FROM
                                        schedules sc
                                        INNER JOIN attendances att
                                        ON att.id = sc.attendance_id
                                    WHERE att.collaborator_id = :collaborator
                                        AND :date BETWEEN sc.start
                                        AND sc.end", ['date' => $request->end, 'collaborator' => $request->collaborator_id]);

        if (count($schedules) > 0) {
            return back()->withInput()
                ->with('error', 'Já existe um atendimento com está data!');
        }

        $collaborator = Collaborator::where('id', $request->collaborator_id)->first();

        $attendance = $this->attendance->create([
            'client_id' => $request->client_id,
            'collaborator_id' => $request->collaborator_id,
            'note' => $request->note,
        ]);

        $schedule = new Schedule;
        $schedule->attendance_id = $attendance->id;
        $schedule->title = $collaborator->name . " - " . $request->client_name;
        $schedule->start = $request->start;
        $schedule->end = $request->end;
        $schedule->save();

        return back()->withInput()
            ->with('success', 'Attendimento: "' . $attendance->id . '" Adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        $attendance = $this->attendance
            ->where([
                ['attendances.id', '=', $attendance->id]
            ])
            ->join('clients', 'attendances.client_id', '=', 'clients.id')
            ->join('collaborators', 'attendances.collaborator_id', '=', 'collaborators.id')
            ->join('schedules', 'schedules.attendance_id', '=', 'attendances.id')
            ->select(
                'attendances.*',
                'clients.name AS client',
                'collaborators.name AS collaborator',
                'schedules.start',
                'schedules.end'
            )
            ->orderBy('schedules.start', 'asc')
            ->first();

        //dd($attendance);

        return view('attendance.show', [
            'attendance' => $attendance
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //dd($request->all());
        $attendance->update(
            $request->except(
                '_method',
                '_token'
            )
        );

        return redirect()
            ->back()->withInput()
            ->with('success', 'Atendimento: "' . $attendance->id . '" Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function status(Request $request)
    {
        if ($request->attendance_status == 'STARTED') {

            $this->attendance
                ->where('id', '=', $request->attendance_id)
                ->update([
                    'status' => $request->attendance_status
                ]);

            Schedule::where('attendance_id', '=', $request->attendance_id)
                ->update([
                    'start' => date('Y-m-d H:m:s')
                ]);

            return back()->withInput()
                ->with('success', 'Attendimento: Iniciado com sucesso!');
        }

        if ($request->attendance_status == 'FINISHED') {

            $this->attendance
                ->where('id', '=', $request->attendance_id)
                ->update([
                    'status' => $request->attendance_status
                ]);

            Schedule::where('attendance_id', '=', $request->attendance_id)
                ->update([
                    'end' => date('Y-m-d H:m:s')
                ]);

            return back()->withInput()
                ->with('success', 'Attendimento: Finalizado com sucesso!');
        }

        return back()->withInput()
            ->with('error', 'Erro ao atualizar Atendimento');
    }
}
