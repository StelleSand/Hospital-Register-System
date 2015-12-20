<?php
/**
 * Created by PhpStorm.
 * User: v5
 * Date: 2015/11/25
 * Time: 13:52
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Doctor extends Model {

    protected $table = 'doctor';

    protected $fillable = ['user_id','office_id','level','price','am_appoints_number','pm_appoints_number'];

    public $timestamps = false;

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function appointmentsAtDate($dateString)
    {
        return $this->orders()->where('appoint_date',$dateString)->where('state','payed');
    }

    public function isAppointmentsOut($dateString)
    {
        $appointments = $this->appointmentsAtDate($dateString)->get();
        return count($appointments) >= $this->am_appoints_number;
    }
}