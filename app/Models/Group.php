<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'description', 'school_id'];

    public function student () {
        return $this->hasMany(Student::class);
    }

    public function module () {
        return $this->hasMany(Module::class);
    }

    public function school () {
        return $this->belongsTo(School::class);
    }

}
