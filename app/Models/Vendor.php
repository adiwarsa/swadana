<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'name', 'slug' , 'type'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name', 'type']
            ]
        ];
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function motors()
    {
        return $this->hasMany(Motor::class);
    }
}
