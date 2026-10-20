<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

     protected $fillable = ['department_id', 'name', 'position', 'salary', 'joined_at'];

    // Model Employee menggunakan relasi belongsTo() sesuai soal
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
