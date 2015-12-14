<?php
/**
 * Created by PhpStorm.
 * User: v5
 * Date: 2015/11/25
 * Time: 13:48
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
class HospitalAdmin extends Model{
    protected $table = 'hospital_admin';

    protected $fillable = ['hospital_id','type','user_id'];

    public $timestamps = false;
}