<?php
/**
 * Created by PhpStorm.
 * User: v5
 * Date: 2015/11/25
 * Time: 13:50
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model{
    protected $table = 'office';

    protected $fillable = ['id','name','description','hospital_id','default_am_appoints_number','default_pm_appoints_number','default_appoint_price'];

    public $timestamps = false;

    public function doctors()
    {
        return $this->hasMany('App\Doctor');
    }

    public function hospital()
    {
        return $this->belongsTo('App\Hospital');
    }
}