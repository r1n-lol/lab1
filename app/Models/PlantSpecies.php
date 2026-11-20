<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantSpecies extends Model
{
    protected $fillable = ['name', 'care_level'];

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }
}
