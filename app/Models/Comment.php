<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function vid()
    {
        return $this->belongsTo(Videws::class,'id_v');
    }

    public function user()
    {
        return $this->belongsTo(UsersOFAll::class,'id_user');
    }
}
