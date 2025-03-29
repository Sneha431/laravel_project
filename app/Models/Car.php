<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Car extends Model
{
    //
    use HasFactory, SoftDeletes;
    protected $fillable = [
        "maker_id",
        "model_id",
        "year",
        "price",
        "vin",
        "mileage",
        "car_type_id",
        "fuel_type_id",
        "user_id",
        "city_id",
        "address",
        "phone",
        "description",
        "published_at"
    ];

    protected $guarded = ["user_id"];
    //All fields except user_id(ignored value will not be assigned in home controller) can be mass-assigned.
    //$guarded property in a Laravel model defines which attributes cannot be mass-assigned.
    // Any attribute listed in $guarded cannot be modified using fill(), create(), or update(),
    // helping prevent mass-assignment vulnerabilities.

    public function features(): HasOne
    {
        return $this->hasOne(CarFeatures::class, 'car_id');
        //The hasOne() method in Laravel defines a one-to-one relationship between two models.
        //Laravel assumes the foreign key second param in car_features is car_id.
    }

    public function primaryImage(): HasOne
    {
        //The oldestOfMany("position") method in Laravel defines a one-to-one relationship where the 
        //oldest related record (based on the position column) is selected.
        return $this->hasOne(CarImage::class)->latestOfMany("position");
        // return $this->hasOne(CarImage::class)->oldestOfMany("position");
        ////Laravel assumes the foreign key second param in car_features is car_id.
    }

    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }

    public function carType(): BelongsTo
    {
        //The belongsTo() method in Laravel defines a one-to-many (inverse) relationship between two models. 
        //It is used when a child model (Car) references a parent model (CarType) through a foreign key.
        return $this->belongsTo(CarType::class);
    }
    public function favouredUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class, // Related model
            'favourite_cars', // Pivot table
            'car_id', // Foreign key on the pivot table referencing the current model
            "user_id" // Foreign key on the pivot table referencing the related model
        );
    }
}
