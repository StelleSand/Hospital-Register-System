<?php
/**
 * Created by PhpStorm.
 * User: v5
 * Date: 2015/12/14
 * Time: 15:24
 */

namespace App\Http\Controllers;
use App\Doctor;
use App\Hospital;
use App\HospitalAdmin;
use App\User;
use Auth;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
use Request;
use App\Office;
class UserController extends Controller {

    protected $user;
    protected $data = array();
    protected $ajaxData = array();
    protected $messages = array();
    protected $office_default_am_appoints_number = 8;
    protected $office_default_pm_appoints_number = 8;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->data['user'] = $this->user;
        if(Session::has('messages'))
        {
            $this->messages = Session::get('messages');
            $this->data['messages'] = $this->messages;
        }
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
                foreach($offices as $office)
                {
                    $office->doctors = $office->doctors()->get();
                }
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

    public function ajaxAddOffice()
    {
        if(Request::has('office_id'))
            return $this->ajaxEditOffice();
        if($this->user->group != 'hospital_admin')
            //dump($this->user);
            abort(403, 'Unauthorized action.');
        $hospitalId = $this->user->hospitalAdmin->hospital_id;
        $inputs = Request::all();
        $officeInfo = array(
            'name' => $inputs['name'],
            'description' => $inputs['description'],
            'hospital_id' => $hospitalId,
            'default_am_appoints_number' => $this->office_default_am_appoints_number,
            'default_pm_appoints_number' => $this->office_default_pm_appoints_number
        );
        $office = Office::create($officeInfo);
        if(is_null($office))
        {
            $this->ajaxData['status'] = 'error';
            $this->ajaxData['message'] = '服务器内部错误，无效的登录用户或者sql错误,马上找BUG!';
        }
        else
        {
            $this->ajaxData['status'] = 'success';
            $this->ajaxData['message'] = '创建科室成功！';
            $this->ajaxData['office'] = $office->toArray();
        }
        return json_encode($this->ajaxData);
    }

    public function ajaxEditOffice()
    {
        $inputs = Request::all();
        $office = Office::find($inputs['office_id']);
        $office->name = $inputs['name'];
        $office->description = $inputs['description'];
        $office->save();
        $this->ajaxData['status'] = 'success';
        $this->ajaxData['message'] = '修改科室信息成功！';
        $this->ajaxData['office'] = $office->toArray();
        return json_encode($this->ajaxData);
    }

    public function getAddDoctor()
    {
        $officeId = Request::input('id');
        $office = $this->user->hospitalAdmin->hospital->offices()->find($officeId);
        if(is_null($office))
        {
            $message = '不存在指定科室号或者您无权访问该科室，篡改狗带！如为正常操作，请联系网站管理员！';
            array_push($this->messages,$message);
            return redirect('workSpace')->with('messages', $this->messages);
        }
        $doctors = $office->doctors()->get();
        foreach($doctors as $doctor)
        {
            $doctor->user = $doctor->user()->first();
        }
        $this->data['doctors'] = $doctors;
        $this->data['office'] = $office;
        return view('hospital_admin/addDoctor',$this->data);
    }

    public function ajaxAddDoctor()
    {
        if(!Request::has('email'))
            return $this->ajaxEditDoctor();
        $inputs = Request::all();
        //检查Email是否重复
        $user = User::where('email',$inputs['email'])->first();
        if(!is_null($user))
        {
            $message = '创建用户失败！邮箱已被注册！';
            goto end;
        }
        $userInfo = array('name'=>$inputs['name'],'email'=>$inputs['email'],'password'=>bcrypt($inputs['password']));
        $user = User::create($userInfo);
        if(is_null($user))
        {
            $message = '创建用户失败！未知错误！';
            goto end;
        }
        $office = $this->user->hospitalAdmin->hospital->offices()->find($inputs['id']);
        $doctorInfo = array('level' => $inputs['level'],
            'price' => $inputs['price'],
            'level' => $inputs['level'],
            'am_appoints_number'=> $office->default_am_appoints_number,
            'pm_appoints_number'=> $office->default_pm_appoints_number,
            'user_id' => $user->id,
            'office_id' => $office->id
        );
        $doctor = Doctor::create($doctorInfo);
        $doctor->user = $doctor->user()->first();
        $message = '医生创建成功！';
        end:
        if(!isset($doctor) || is_null($doctor))
        {
            $this->ajaxData['status'] = 'error';
            $this->ajaxData['message'] = $message;
        }
        else
        {
            $this->ajaxData['status'] = 'success';
            $this->ajaxData['message'] = $message;
            $this->ajaxData['doctor'] = $doctor->toArray();
        }
        return json_encode($this->ajaxData);
    }

    public function ajaxEditDoctor()
    {
        $inputs = Request::all();
        $doctor = Doctor::find($inputs['id']);
        if(is_null($doctor))
        {
            $message = '修改医生信息失败！不存在的医生！';
            $this->ajaxData['status'] = 'error';
            goto end;
        }
        $doctor->level = $inputs['level'];
        $doctor->price = $inputs['price'];
        $doctor->save();
        $user = $doctor->user()->first();
        $user->name = $inputs['name'];
        $user->save();
        $doctor->user = $user;

        $message = '修改医生信息成功！';
        $this->ajaxData['status'] = 'success';

        end:
        $this->ajaxData['message'] = $message;
        $this->ajaxData['doctor'] = $doctor->toArray();
        return json_encode($this->ajaxData);
    }
}