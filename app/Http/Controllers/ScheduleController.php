<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Client;
use App\Collaborator;
use App\Schedule;
use Illuminate\Http\Request;
use stdClass;

class ScheduleController extends Controller
{
    private $schedule;

    public function __construct(Schedule $schedule)
    {
        $this->schedule = $schedule;
    }

    public function index()
    {
        $schedules = $this->schedule
            ->join('attendances', 'attendances.id', '=', 'schedules.attendance_id')
            ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
            ->join('clients', 'clients.id', '=', 'attendances.client_id')
            ->select(
                'schedules.*',
                'attendances.collaborator_id',
                'collaborators.name AS collaborator',
                'attendances.client_id',
                'clients.name AS client'
            )
            ->paginate();
        return response()->json($schedules);
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
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /*  Attendance::where('id', $request->attendance_id)
            ->update([
                'note' => $request->note
            ]); */

        $this->schedule->where('id', $request->schedule_id)
            ->update(
                $request->only(
                    'title',
                    'start',
                    'end'
                )
            );

        return redirect()
            ->route('attendance.index')
            ->with('success', 'Atendimento Nº ' . $request->attendance_id . ' Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }

    public function search(Request $request)
    {
        $schedules = $this->schedule
            ->where('collaborators.id', $request->collaborator_id)
            ->join('attendances', 'attendances.id', '=', 'schedules.attendance_id')
            ->join('collaborators', 'collaborators.id', '=', 'attendances.collaborator_id')
            ->join('clients', 'clients.id', '=', 'attendances.client_id')
            ->select(
                'schedules.*',
                'attendances.collaborator_id',
                'collaborators.name AS collaborator',
                'attendances.client_id',
                'clients.name AS client'
            )
            ->get();
        return response()->json($schedules);
    }

    public function collaborator(Request $request)
    {
        $collaborator = Collaborator::where('id', $request->collaborator_id)->first();
        $client = Client::where('id', $request->client_id)->first();

        $data['client_id'] = $client->id;
        $data['client_name'] = $client->name;
        $data['collaborator_id'] = $collaborator->id;
        $data['collaborator_name'] = $collaborator->name;

        return view('attendance.schedule', [
            'data' => $data,
        ]);
    }
}
