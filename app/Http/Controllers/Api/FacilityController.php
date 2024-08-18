<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FacilityResource;
use App\Models\Facility;
use App\Http\Requests\Api\FacilityStoreRequest;
use App\Http\Requests\Api\FacilityUpdateRequest;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { {
            $sports = Facility::all();
            return FacilityResource::collection($sports);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacilityStoreRequest $request)
    {
        $facility = Facility::create($request->validated());
        return  FacilityResource::make($facility);
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        return  FacilityResource::make($facility);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacilityUpdateRequest $request, Facility $facility)
    {
        $facility->update($request->validated());
        return  FacilityResource::make($facility);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();
        return response()->json(null, 204);
    }
}
