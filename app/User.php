<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function avatar()
    {
        return $this->belongsTo(File::class, 'image_file_id');
    }

    public function access_property()
    {
        return $this->belongsTo(Property::class, 'access_property_id');
    }

    public function getFullNamewMAttribute()
    {
        if ($this->middlename == null) {
            return "{$this->lastname}, {$this->firstname}";
        } else {
            return "{$this->lastname}, {$this->firstname} {$this->middlename }";
        }
    }

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
