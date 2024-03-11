<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'logo',
        'email',
        'phone',
        'web'
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    protected function setWebAttribute($value)
    {
        $this->attributes['web'] = str_replace('https://www.', '', $value);
    }
}
