<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $table = 'options';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'school_id'];

    public function module () {
        return $this->hasMany(Module::class);
    }

    public function school () {
        return $this->belongsTo(School::class);
    }
}
