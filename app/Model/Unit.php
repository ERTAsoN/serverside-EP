<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = [
        'title'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'unit_id', 'id');
    }
}