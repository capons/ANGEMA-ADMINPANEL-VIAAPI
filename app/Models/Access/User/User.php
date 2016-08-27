<?php

namespace App\Models\Access\User;

use App\Models\Access\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;

/**
 * Class User
 * @package App\Models\Access\User
 */
class User extends Authenticatable
{

    use SoftDeletes, UserAccess, UserAttribute, UserRelationship;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['ID'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'Email'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table      = 'tblusers';
    protected $primaryKey = 'ID';
    // protected $appends    = ['id', 'email', 'name'];

    public function getEmailAttribute()
    {
        return $this->attributes['Email'];
    }

    public function getIdAttribute()
    {
        return $this->attributes['ID'];
    }

    public function getNameAttribute()
    {
        return "{$this->attributes['Firstname']} {$this->attributes['Surname']}";
    }

    public function getFirstnameAttribute()
    {
        return $this->attributes['Firstname'];
    }

    public function getSurnameAttribute()
    {
        return $this->attributes['Surname'];
    }
}
