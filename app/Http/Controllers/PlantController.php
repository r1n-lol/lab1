<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantRequest;
use App\Models\Plant;
use App\Models\PlantSpecies;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class PlantController extends Controller
{
    public function index()
    {
        $plants = Plant::with(['species', 'room'])->latest()->paginate(8);
        return view('plants.index', compact('plants'));
    }

    public function create()
    {
        return view('plants.form', [
            'plant' => new Plant(),
            'species' => PlantSpecies::orderBy('name')->get(),
            'rooms' => Room::orderBy('name')->get(),
        ]);
    }

    public function store(PlantRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('plants', 'public');
        }
        Plant::create($data);
        return redirect()->route('plants.index')->with('success', 'Растение успешно добавлено.');
    }

    public function show(Plant $plant)
    {
        $plant->load(['species', 'room']);
        return view('plants.show', compact('plant'));
    }

    public function edit(Plant $plant)
    {
        return view('plants.form', [
            'plant' => $plant,
            'species' => PlantSpecies::orderBy('name')->get(),
            'rooms' => Room::orderBy('name')->get(),
        ]);
    }

    public function update(PlantRequest $request, Plant $plant)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            if ($plant->photo) {
                Storage::disk('public')->delete($plant->photo);
            }
            $data['photo'] = $request->file('photo')->store('plants', 'public');
        }
        $plant->update($data);
        return redirect()->route('plants.index')->with('success', 'Данные растения обновлены.');
    }

    public function destroy(Plant $plant)
    {
        if ($plant->photo) {
            Storage::disk('public')->delete($plant->photo);
        }
        $plant->delete();
        return redirect()->route('plants.index')->with('success', 'Растение удалено.');
    }
}
