<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videws extends Model
{
    use HasFactory;

    public function types()
    {
        return $this->belongsTo(Dept::class,'type');
    }

    public function channle()
    {
        return $this->belongsTo(Channel::class,'id_channal','uname');
    }
}
