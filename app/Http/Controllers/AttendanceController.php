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
            ->select(
                'attendances.*',
                'clients.name AS client',
                'collaborators.name AS collaborator',
            )
            ->paginate(5)
            ->onEachSide(0);

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
        ]);

        $schedule = new Schedule;
        $schedule->attendance_id = $attendance->id;
        $schedule->title = $request->client_name;
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
        //
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
        //
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
}
