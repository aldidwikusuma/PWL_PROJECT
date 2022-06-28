<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function film()
    {
        return $this->belongsTo(Film::class, "fk_id_film");
    }

    public function room()
    {
        return $this->belongsTo(Room::class, "fk_id_room");
    }
}
