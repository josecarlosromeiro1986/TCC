<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Client;
use App\Collaborator;
use App\Schedule;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $collaborator = Collaborator::where('id', $request->collaborator_id)->first();

        $attendance = $this->attendance->create([
            'client_id' => $request->client_id,
            'collaborator_id' => $request->collaborator_id,
        ]);

        $schedule = new Schedule;
        $schedule->attendance_id = $attendance->id;
        $schedule->title = $collaborator->name;
        $schedule->start = $request->start;
        $schedule->end = $request->end;
        $schedule->save();

        return redirect()
            ->route('attendance.index')
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
