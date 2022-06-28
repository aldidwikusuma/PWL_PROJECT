<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = ["id"];

    public function room()
    {
        return $this->hasMany(Room::class);
    }
}
