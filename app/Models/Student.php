<?php

namespace App\Models;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'name',
        'surnames',
        'city',
        'birth_date'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
