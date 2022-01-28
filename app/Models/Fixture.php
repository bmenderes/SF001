<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    public function home(){
        return $this->belongsTo(Team::class,'home_id');
    }
    public function away(){
        return $this->belongsTo(Team::class,'away_id');
    }
}
