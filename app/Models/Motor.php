<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Motor extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'nama_motor', 
        'slug',
        'vendor_id',
        'harga_sewa',
        'denda',
        'samsat',
        'gambar',
        'bahan_bakar',
        'transmisi',
        'status',
        'deskripsi',
        'remind'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_motor'
            ]
        ];
    }

    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'motor_category', 'motor_id','category_id');
    }

    public function samsats()
    {
        return $this->hasMany(Samsat::class);
    }
}
