<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'clocked_in_at',
        'clocked_out_at'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
