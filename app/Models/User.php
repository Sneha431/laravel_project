<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'facebook_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function favouredCars()
    {
        // return $this->belongsToMany(
        //     Car::class,        // Related model
        //     'favourite_cars',  // Pivot table
        //     'user_id',         // Foreign key on the pivot table referencing the current model
        //     'car_id'           // Foreign key on the pivot table referencing the related model
        // )->withTimestamps();
        return $this->belongsToMany(
            Car::class,        // Related model
            'favourite_cars',  // Pivot table
            'user_id',         // Foreign key on the pivot table referencing the current model
            'car_id'           // Foreign key on the pivot table referencing the related model
        );
    }
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}
