<?php

namespace App;

use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, EntrustUserTrait;

    /**
     * The database table used by the model.
     *
     * @var string $table
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    /**
     * @return mixed|string
     */
    public function getAvatarAttribute($avatar)
    {
        if ($avatar != "" && file_exists(public_path('uploads/avatars/' . $avatar))) {
            return $avatar;
        } else {
            return 'placeholder.png';
        }
    }

    /**
     * Delete avatar and company logo first.
     * Then proceed with regular deleting.
     * @return parent::delete()
     */
    public function delete()
    {
        if ($this->attributes['avatar']) {
            $file = $this->attributes['avatar'];
            if ($file != "placeholder.png") {
                $path = public_path('uploads/avatars/' . $file);

                if (\File::isFile($path)) {
                    \File::delete($path);
                }
            }
        }

        parent::delete();
    }
}
