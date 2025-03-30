<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class CarImage extends EloquentModel
{
    //
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'car_id',
        'image_path',
        'position'
    ];
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}