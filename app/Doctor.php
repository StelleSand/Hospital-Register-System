<?php
/**
 * Created by PhpStorm.
 * User: v5
 * Date: 2015/11/25
 * Time: 13:52
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {

    protected $table = 'doctor';

    protected $fillable = ['user_id','office_id','level','price','am_appoints_number','pm_appoints_number'];

    protected $timestamps = false;
}