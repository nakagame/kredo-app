<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function teacher() {
        return $this->belongsTo(User::class);
    }

    public function student() {
        return $this->belongsTo(User::class);
    }
}

