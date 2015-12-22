<?php
/**
 * Created by PhpStorm.
 * User: v5
 * Date: 2015/11/25
 * Time: 13:54
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $table = 'order';

    protected $fillable = ['user_id','doctor_id','office_id','hospital_id','order_date','pay_date','state','price','refund','appoint_date'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function office()
    {
        return $this->belongsTo('App\Office');
    }

    public function hospital()
    {
        return $this->belongsTo('App\Hospital');
    }

}