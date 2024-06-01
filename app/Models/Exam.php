<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    
    protected $table = 'exams';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'mark' , 'student_id' , 'module_id'
    ];
    

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function module () {
        return $this->belongsTo(Module::class);
    }
}
