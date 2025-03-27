<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

}
