<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Student extends Model implements Authenticatable
{

    use HasFactory, AuthenticatableTrait;

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'program',
        'gender',
        'dob',
        'country',
        'interests',
    ];
}
