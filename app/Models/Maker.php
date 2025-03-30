<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Maker extends EloquentModel
{
    //
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ["name"];
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
    // public function models(): BelongsTo
    // {
    //     return $this->belongsTo(Model::class);
    // }

    // protected static function newFactory()
    // {
    //     return CarMakerFactory::new();
    // }

    public function models(): HasMany
    {
        return $this->hasMany(Model::class);
    }
    public function carModels(): HasMany
    {
        return $this->hasMany(Model::class);
    }
}