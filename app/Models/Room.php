<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'lighting'];

    public function plants()
    {
        return $this->hasMany(Plant::class);
    }
}
