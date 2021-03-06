<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use App\Legionnaire;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract,
                                    SluggableInterface
{
    use Authenticatable, 
        Authorizable, 
        CanResetPassword, 
        SluggableTrait;

    protected $sluggable = [
        'build_from' => 'username',
        'save_to'    => 'slug',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'username'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Each user can own multiple legionnaires, ownership being
     * defined by having added the legionnaire to the database.
     * @return [type] [description]
     */
    public function legionnaires()
    {
        return $this->hasMany('App\Legionnaire');
    }

    /**
     * Each user can star multiple legionnaires.
     * @return [type] [description]
     */
    public function stars()
    {
        return $this->belongsToMany('App\Legionnaire', 'legionnaire_user');
    }

    /**
     * Determine if user owns (has submitted) a particular legionnaire
     * @param  [type] $legionnaire [description]
     * @return [type]      [description]
     */
    public function owns($id)
    {

        if (\Auth::check())
        {

            if ($this->legionnaires->contains($id))
                return true;
            
        }

        return false;

    }

    /**
     * Retrieve a list of recently active users, active
     * being defined by having added a lagionnaire
     * @return [type] [description]
     */
    static function active($count = 5)
    {
        return User::whereHas('Legionnaires', function($q) {
            $q
            ->groupBy('user_id')
            ->orderBy('created_at', 'desc');
        })->take($count)->get();

    }

    /**
     * Determine whether the user is an administrator.
     * @return boolean [description]
     */
    public function isAdmin()
    {
        if (\Auth::check()) 
        {

            if ($this->is_admin == 1) 
                return true;

        }

        return false;
    }
    
}
