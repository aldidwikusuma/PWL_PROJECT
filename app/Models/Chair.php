<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chair extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $with = ['category'];

    public function category()
    {
        return $this->belongsTo(ChairCategory::class, "fk_id_chair_category");
    }
}
