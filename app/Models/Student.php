<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'students';
    protected $fillable = ['user_id','CNE', 'group_id'];

    
    public function user () {
        return $this->belongsTo(User::class);
    }

    public function exam () {
        return $this->hasMany(Exam::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

   
}
