<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromissoryRecord extends Model
{
    protected $fillable = ['payment_id', 'mop_id', 'student_id'];
    public function student_record()
    {
        return $this->hasMany(StudentRecord::class);
    }
}
