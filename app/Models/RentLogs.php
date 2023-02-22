<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RentLogs extends Model
{
    use Notifiable;
    use HasFactory;

    protected $table = 'rent_logs';

    protected $fillable = [
        'no_invoice','user_id', 'car_id', 'motor_id', 'rent_date', 'return_date','delivery','return_at','proof', 'status', 'actual_return_date', 'fine', 'pay',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class, 'motor_id', 'id');
    }
}
