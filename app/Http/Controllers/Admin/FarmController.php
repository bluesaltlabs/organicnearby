<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farm;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\Farm\FarmStoreRequest;
use App\Http\Requests\Farm\FarmUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $farms = Farm::latest()->paginate(10);
        return Inertia::render('admin/farms/List', [
            'farms' => $farms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('admin/farms/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FarmStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $farm = Farm::create($data);
        return Redirect::route('admin.farms.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Farm $farm): Response
    {
        return Inertia::render('admin/farms/Show', [
            'farm' => $farm,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farm $farm): Response
    {
        $farm->load('location');
        return Inertia::render('admin/farms/Edit', [
            'farm' => $farm,
            'location' => $farm->location,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FarmUpdateRequest $request, Farm $farm)
    {
        $this->authorize('update', $farm);
        $farm->update($request->validated());
        $locationData = $request->input('location');
        if ($locationData) {
            $fillable = (new \App\Models\Location)->getFillable();
            $farm->location()->updateOrCreate([], Arr::only($locationData, $fillable));
        }
        return Redirect::route('admin.farms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farm $farm)
    {
        $this->authorize('delete', $farm);
        $farm->delete();
        return Redirect::route('admin.farms.index');
    }
} 