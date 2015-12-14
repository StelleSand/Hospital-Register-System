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

    protected $table = 'table';

    protected $fillable = ['user_id','doctor_id','order_date','pay_date','state','price','refund','appoint_date'];

    protected $timestamps = false;

}