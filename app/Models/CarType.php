<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class CarType extends EloquentModel
{
    //
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["name"];

    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}