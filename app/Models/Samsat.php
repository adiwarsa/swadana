<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Samsat extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'motor_id',
        'code_samsat',
        'old_samsat',
        'renew_samsat',
        'new_samsat', 
        
    ];
    
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }
}
