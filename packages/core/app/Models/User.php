<?php

namespace Core\Models;

use Core\Models\Traits\HasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,HasMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'designation',
        'memberable_id',
        'memberable_type',
        'email_verified_at',
        'status'
    ];

    public $appends = [
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $pivots = [
        'roles'
    ];

    protected $with = [
        'roles'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->roles->first();
    }

    public function memberable()
    {
        return $this->morphTo();
    }

    public function getAvatarAttribute()
    {
        if($this->image()){
            return $this->image()->path;
        }
        return \Avatar::create($this->name)->toBase64();
    }
}
