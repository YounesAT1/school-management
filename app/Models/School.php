<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'schools';
    protected $fillable = ['name', 'picture', 'address'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function directors()
    {
        return $this->users()->where('idRole', 1); 
    }

    public function group() {
        return $this->hasMany(Group::class);
    }

    public function option () {
        return $this->hasMany(Option::class);
    }

    
}
