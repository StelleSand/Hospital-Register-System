<?php
/**
 * Created by PhpStorm.
 * User: v5
 * Date: 2015/12/14
 * Time: 15:02
 */

namespace App\Http\Controllers;

use App\Hospital;
use App\Doctor;
use App\Office;
use App\User;
use Auth;
use Request;

class HospitalController extends Controller {

    protected $user;
    protected $data = array();

    public function __construct()
    {
        $this->user = Auth::check()? Auth::user() : null;
        $this->data['user'] = $this->user;
    }

    public function getAllHospital()
    {
        $hospitals = Hospital::all();
        $this->data['hospitals'] = $hospitals;
        return view('index',$this->data);
    }

    public function getAllOffices()
    {
        $hospital = Hospital::find(Request::input('id'));
        $offices = $hospital->offices()->get();
        $this->data['offices'] = $offices;
        $this->data['hospital'] = $hospital;
        return view('hospital/hospital',$this->data);
    }

}