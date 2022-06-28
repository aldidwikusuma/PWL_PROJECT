<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChairCategory extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function chair()
    {
        return $this->hasMany(Chair::class);
    }
}
