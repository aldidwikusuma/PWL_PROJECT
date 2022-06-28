<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ["id"];
    
    public function rooms(){
        return $this->belongsToMany(Room::class, "chair_room", "fk_id_chair", "fk_id_room");
    }
}
