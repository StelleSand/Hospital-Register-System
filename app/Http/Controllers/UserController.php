<?php
/**
 * Created by PhpStorm.
 * User: v5
 * Date: 2015/12/14
 * Time: 15:24
 */

namespace App\Http\Controllers;


class UserController extends Controller {

    protected $user;
    protected $data = array();

    public function __construct()
    {
        $this->user = Auth::user();
        $this->date['user'] = $this->user;
    }

    public function getWorkSpace()
    {
        switch($this->user->group)
        {
            case 'site_admin':
                return view('site_admin/site_admin', $this->data);
            case 'doctor':
                return view('',$this->data);
            case 'hospital_admin':
                return view('',$this->data);
        }
    }

    public function getPerson()
    {
        return view('',$this->data);
    }

    public function postAddHospital(Request $request)
    {
        if($this->user->group != 'site_admin')
            abort(403, 'Unauthorized action.');
        $info = $request::all();
    }

}