<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Client;
use App\Collaborator;
use App\Http\Requests\ScheduleRequest;
use App\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                'collaborators.name AS collaborator',
                'clients.name AS client',
                'attendances.client_id',
                'attendances.collaborator_id',
                'attendances.note',
            )
            ->get();
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
    public function update(ScheduleRequest $request)
    {
        /* DB::enableQueryLog();
        dd(DB::getQueryLog()); */

        $schedules = DB::select("SELECT
                                        sc.*
                                    FROM
                                        schedules sc
                                        INNER JOIN attendances att
                                        ON att.id = sc.attendance_id
                                    WHERE att.collaborator_id = :collaborator
                                        AND sc.id <> :schedule
                                        AND :date BETWEEN sc.start
                                        AND sc.end", ['date' => $request->start, 'collaborator' => $request->collaborator_id, 'schedule' => $request->schedule_id]);

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
                                        AND sc.id <> :schedule
                                        AND :date BETWEEN sc.start
                                        AND sc.end", ['date' => $request->end, 'collaborator' => $request->collaborator_id, 'schedule' => $request->schedule_id]);

        if (count($schedules) > 0) {
            return back()->withInput()
                ->with('error', 'Já existe um atendimento com está data!');
        }

        Attendance::where('id', $request->attendance_id)
            ->update([
                'note' => $request->note
            ]);

        $this->schedule->where('id', $request->schedule_id)
            ->update(
                $request->only(
                    'title',
                    'start',
                    'end'
                )
            );

        return back()->withInput()
            ->with('success', 'Attendimento: "' . $request->attendance_id . '" Atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        dd($request->all());
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
                'collaborators.name AS collaborator',
                'clients.name AS client',
                'attendances.client_id',
                'attendances.collaborator_id',
                'attendances.note',
            )
            ->get();
        return response()->json($schedules);
    }

    public function collaborator(Request $request)
    {
        if (isset($request->client_id)) {

            $collaborator = Collaborator::where('id', $request->collaborator_id)->first();
            $client = Client::where('id', $request->client_id)->first();

            $data['client_id'] = $client->id;
            $data['client_name'] = $client->name;
            $data['collaborator_id'] = $collaborator->id;
            $data['collaborator_name'] = $collaborator->name;
        } else {

            $collaborator = Collaborator::where('id', $request->collaborator_id)->first();

            $data['collaborator_id'] = $collaborator->id;
            $data['collaborator_name'] = $collaborator->name;

            return view('schedule.schedule', [
                'data' => $data,
            ]);
        }

        return view('attendance.schedule', [
            'data' => $data,
        ]);
    }
}
