<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelType extends Model
{
    //`use HasFactory;` enables Laravel factories for generating test data, 
    //simplifying database seeding and testing.
    use HasFactory;
    // protected $table = "car_fuel_types";
    // protected $primaryKey = "fuel_type_id";
    //public $incrementing = false;
    //disables auto-incrementing for the model's primary key,
    //  meaning you must manually assign a value when creating records.
    //protected $keyType = "string";
    //protected $keyType = "string"; tells Laravel that the primary key of the model is a string instead of an integer. 
    //This is useful when using UUIDs or other non-integer keys.by default it is integer
    //customize created_at and updated_at explicitly
    // const CREATED_AT = "created_at";
    // const UPDATED_AT = null;
    //Disables the updated_at column. Laravel will no longer automatically update this field.
    public $timestamps = false;
    // Disables both created_at and updated_at. Laravel will not handle timestamps for this model.


}