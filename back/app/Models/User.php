<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,SoftDeletes,HasRoles,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
//$table->string('name')->nullable();
//$table->string('gestion')->nullable();
//$table->string('bloque')->nullable();
//$table->string('codigo')->nullable();
//$table->string('avatar')->nullable();
//$table->string('email')->nullable()->unique();
//$table->string('username')->nullable()->unique();
//$table->string('phone')->nullable()->unique();
//$table->timestamp('email_verified_at')->nullable();
//$table->string('password');
//$table->rememberToken();
//$table->softDeletes();
//$table->timestamps();
    protected $fillable = [
        'name',
        'gestion',
        'bloque',
        'codigo',
        'avatar',
        'email',
        'username',
        'phone',
        'email_verified_at',
        'password',
        'remember_token',
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
}
