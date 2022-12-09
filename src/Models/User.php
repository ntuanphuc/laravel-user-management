<?php

namespace Smbplus\UserManagement\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
  use HasFactory;
  use HasRoles;
  // Disable Laravel's mass assignment protection
  //protected $guarded = [];

    protected $table = 'users';

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'email', 
        'is_active', 
        'password'
    ];

    public function getMorphClass()
    {
        return "App\\Models\\User";
    }
}