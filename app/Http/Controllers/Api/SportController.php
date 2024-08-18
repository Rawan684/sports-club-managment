<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sport;
use App\Models\Schedule;
use App\Http\Resources\SportsResource;
use App\Http\Requests\Api\SportStoreRequest;
use App\Http\Requests\Api\SportUpdateRequest;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sports = Sport::all();
        return SportsResource::collection($sports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SportStoreRequest $request)
    {
        $sport = Sport::create($request->validated());
        return  SportsResource::make($sport);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sport $sport)
    {

        return  SportsResource::make($sport);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SportUpdateRequest $request, Sport $sport)
    {
        $sport->update($request->validated());
        return SportsResource::make($sport);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sport $sport)
    {
        $sport->delete();
        return response()->json(null, 204);
    }

    public function assignDay(Request $request, $id)
    {
        $request->validate([
            'start_time' => 'required|array',
            'end_time' => 'required|array',
        ]);

        $sport = Sport::find($id);
        if (!$sport) {
            return response()->json(['error' => 'Sport not found'], 404);
        }
        $schedule = new Schedule();
        $schedule->sport_id = $id;
        $schedule->day = $request->input('day');
        $schedule->start_time = $request->input('start_time');
        $schedule->end_time = $request->input('end_time');
        $schedule->save();
        return response()->json($schedule, 201);
    }
}
