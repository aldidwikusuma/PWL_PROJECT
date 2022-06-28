<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ["id"];
    protected $with = ['category', 'chairs'];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class, "fk_id_room_category");
    }

    public function chairs()
    {
        return $this->belongsToMany(Chair::class, "chair_room", "fk_id_room", "fk_id_chair")->withPivot("number_chair");
    }
}
