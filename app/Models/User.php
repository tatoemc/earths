<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Orphan;
use App\Models\Sponserform;
use App\Models\Guardian;
use App\Models\Sponsor;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    use SoftDeletes;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    use SoftDeletes;
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $dates = ['deleted_at'];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name' => 'array',
    ];

    public function orphans()
    {
        return $this->hasMany(Orphan::class);
    }
    public function sponserforms()
    {
     return $this->belongsToMany('App\Sponserform','sponserform_user');

    }
    public function guardian()
    {
        return $this->hasOne(Guardian::class);
    }
    public function sponsor()
    {
        return $this->hasOne(Sponsor::class);
    }





}//end og model
