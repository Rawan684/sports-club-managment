<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sport;
use App\Models\Schedule;

class ScheduleController extends Controller
{


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Sport $sport)
    {
        $request->validate([
            'start_time' => 'required|array',
            'end_time' => 'required|array',
        ]);


        foreach ($request->input('start_time') as $day => $startTime) {
            $schedule = new Schedule();
            $schedule->sport_id = $sport->id;
            $schedule->day = $day;
            $schedule->start_time = $startTime;
            $schedule->end_time = $request->input('end_time.' . $day);
            $schedule->save();
        }


        return response()->json(['message' => 'Schedule entry created successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
