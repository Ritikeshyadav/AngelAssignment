<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    
    protected $table = 'students', $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_xid')->select('id','name');
    }
}
