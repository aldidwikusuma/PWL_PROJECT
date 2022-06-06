<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    protected $with = ['genre'];

    public function genre()
    {
        return $this->belongsTo(Genre::class, "fk_id_genre");
    }
}
