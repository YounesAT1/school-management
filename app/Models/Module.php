<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'numberOfHours', 'group_id', 'option_id'
    ];

    public function group () {
        return $this->belongsTo(Group::class);
    }

    public function option () {
        return $this->belongsTo(Option::class);
    }

    public function exam () {
        return $this->hasMany(Exam::class);
    }
}
