<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'last_name',
        'patronym',
    ];
    public $timestamps = false;

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id'); // Связь один-ко-многим с Gender
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id'); // Связь один-ко-многим с Position
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id'); // Связь один-ко-многим с Unit
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id'); // Связь один-ко-многим со Staff
    }
}