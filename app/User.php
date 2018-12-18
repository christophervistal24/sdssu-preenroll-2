<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'password','id_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role','user_role','user_id','role_id');
    }


    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else  {
                if ($this->hasRole($roles)) {
                    return true;
                }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name',$role)->first()) {
             return true;
        }
        return false;
    }

    public function getRole(string $role)
    {
        return Role::where('name',$role)->first();
    }

    public function getLastRecord()
    {
        return $this->all()->last()->id;
    }

    public function getRecordsAfterLast(int $last_record_id)
    {
        return $this->where('id','>',$last_record_id)->get(['id']);
    }
}
