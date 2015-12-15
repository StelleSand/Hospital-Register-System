<?php
/**
 * Created by PhpStorm.
 * User: v5
 * Date: 2015/12/14
 * Time: 15:24
 */

namespace App\Http\Controllers;
use App\Hospital;
use App\HospitalAdmin;
use App\User;
use Auth;
use Request;
use App\Office;
class UserController extends Controller {

    protected $user;
    protected $data = array();
    protected $messages = array();

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
                $hospitalAdmin = $this->user->hospitalAdmin()->first();
                $hospital = $hospitalAdmin->hospital()->first();
                $offices = $hospital->offices()->get();
                $this->data['offices'] = $offices;
                return view('hospital_admin/hospital_admin',$this->data);
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
        $inputs = $request::all();
        //检查Email是否重复
        $user = User::where('email',$inputs['email'])->first();
        if(!is_null($user))
        {
            $message = 'Create User Failed! Repeated User Email!';
            array_push($this->messages, $message);
            goto end;
        }
        //新建user
        $userInfo = array(
            'name' => $inputs['username'],
            'email' => $inputs['email'],
            'password' => bcrypt($inputs['password']),
            'group' => 'hospital_admin'
        );
        $user = User::create($userInfo);
        if(is_null($user))
        {
            $message = 'Create User Failed! Unknown Bug!';
            array_push($this->messages, $message);
            goto end;
        }
        //新建hospital
        $hospitalInfo = array(
            'name' => $inputs['name'],
            'description' => $inputs['description'],
            'location' => $inputs['location'],
            'district' => $inputs['district'],
            'phone' => $inputs['phone']
        );
        $hospital = Hospital::create($hospitalInfo);
        if(is_null($hospital))
        {
            $message = 'Create Hospital Failed! Unknown Bug!';
            array_push($this->messages, $message);
            goto end;
        }
        //新建管理员
        $adminInfo = array(
            'user_id' => $user->id,
            'hospital_id' => $hospital->id,
            'type' => 'admin'
        );
        $admin = HospitalAdmin::create($adminInfo);
        if(!is_null($admin))
        {
            $message = 'Create Admin Success!';
            array_push($this->messages, $message);
        }
        //更新Message
        end:
        $this->data['messages'] = $this->messages;
        return view('site_admin/site_admin', $this->data);
    }

}