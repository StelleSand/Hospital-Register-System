<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Doctor;
use App\HospitalAdmin;
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

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
    protected $fillable = ['name', 'email', 'password','photo','phone','group','description'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function doctor(){
        if($this->group != 'doctor')
            return null;
        else return $this->hasOne('App\Doctor');
    }
    public function hospitalAdmin(){
        if($this->group != 'hospital_admin' && $this->group != 'hospital_triage')
            return null;
        else return $this->hasOne('App\HospitalAdmin');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function appointments()
    {
        $now = Carbon::today('Asia/Shanghai')->format('Y-m-d H:i:s');
        return $this->orders()->where('state','payed')->where('appoint_date','>',$now)->orderBy('appoint_date');
    }

    public function historyOrders()
    {
        return $this->orders()->orderBy('pay_date','desc');
    }

}
