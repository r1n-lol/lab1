<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = [
        'name',
        'plant_species_id',
        'room_id',
        'acquired_at',
        'watering_interval',
        'condition',
        'notes',
        'photo',
    ];

    protected function casts(): array
    {
        return ['acquired_at' => 'date'];
    }

    public function species()
    {
        return $this->belongsTo(PlantSpecies::class, 'plant_species_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
