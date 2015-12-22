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
use App\Order;
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

    public function getHomePage()
    {
        return view('home_page',$this->data);
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
            case 'hospital_triage':
                return view('',$this->data);
        }
    }

    public function getPerson()
    {
        return view('user/personal_information',$this->data);
    }

    public function ajaxEditPersonInfo()
    {
        if(Request::input('id') == 'edit')
        {
            $inputs = Request::all();
            $this->user->name = $inputs['name'];
            $this->user->phone = $inputs['phone'];
            $this->user->description = $inputs['description'];
            $this->user->save();
            $this->ajaxData['status'] = 'success';
            $this->ajaxData['message'] = '个人信息更新成功！';
            $this->ajaxData['user'] = $this->user;
            $this->ajaxData['type'] = 'edit';
            return json_encode($this->ajaxData);
        }
        else
        {
            $this->ajaxData['type'] = 'password';
            $inputs = Request::all();
            $oldPassword = $inputs['old_password'];
            $password = $inputs['password'];
            $confirmPassword = $inputs['confirm_password'];
            if(!isset($inputs['old_password']) || empty($oldPassword))
            {
                $this->ajaxData['status'] = 'error';
                $this->ajaxData['message'] = '原密码不能为空！';
            }
            else if(!isset($inputs['password']) || !isset($inputs['confirm_password']) || empty($password) || empty($confirmPassword))
            {
                $this->ajaxData['status'] = 'error';
                $this->ajaxData['message'] = '新密码不能置为空！';
            }
            else if(!Auth::validate(array('email'=>$this->user->email,'password'=>$oldPassword)))
            {
                $this->ajaxData['status'] = 'error';
                $this->ajaxData['message'] = '原密码错误！';
            }
            else if($password != $confirmPassword)
            {
                $this->ajaxData['status'] = 'error';
                $this->ajaxData['message'] = '两次密码不相同，请重新输入！';
            }
            else {
                $this->user->password = bcrypt($password);
                $this->user->save();
                $this->ajaxData['status'] = 'success';
                $this->ajaxData['message'] = '密码修改成功！';
            }
            return json_encode($this->ajaxData);
        }
    }

    public function getAppointments()
    {
        $orders = $this->user->appointments()->get();
        foreach ($orders as &$order) {
            $order->user = $order->user()->first();
            $order->doctor = $order->doctor()->first();
            $order->doctor->user = $order->doctor->user()->first();
            $order->doctor->office = $order->doctor->office()->first();
            $order->doctor->office->hospital = $order->doctor->office->hospital()->first();
        }
        $this->data['orders'] = $orders;
        return view('user/manage_appointment',$this->data);
    }
    public function getHistoryAppointments()
    {
        $orders = $this->user->historyOrders()->get();
        foreach ($orders as &$order) {
            $order->user = $order->user()->first();
            $order->doctor = $order->doctor()->first();
            $order->doctor->user = $order->doctor->user()->first();
            $order->doctor->office = $order->doctor->office()->first();
            $order->doctor->office->hospital = $order->doctor->office->hospital()->first();
        }
        $this->data['orders'] = $orders;
        return view('user/historical_order',$this->data);
    }

    public function ajaxCancelAppointment()
    {
        $id = Request::input('id');
        $order = $this->user->appointments()->find($id);
        if(is_null($order))
        {
            $this->ajaxData['status'] = 'error';
            $this->ajaxData['message'] = '订单不存在或者你无权编辑该订单！';
            if(is_null($id))
            return 'NULL';
            else return $id;
        }
        else {
            $order->state = 'payment_canceled';
            $order->save();
            $this->ajaxData['status'] = 'success';
            $this->ajaxData['message'] = '取消订单成功！';
        }
        return json_encode($this->ajaxData);
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
            $message = '用户创建失败！邮箱已被占用！';
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
            $message = '医院创建成功！';
            array_push($this->messages, $message);
        }
        //更新Message
        end:
        $this->data['messages'] = $this->messages;
        return view('site_admin/site_admin', $this->data);
    }

    public function ajaxAddTriage()
    {
        $inputs = Request::all();
        $userInfo = array(
            'name' => $inputs['name'],
            'email' => $inputs['email'],
            'password' => bcrypt($inputs['password']),
            'group' => 'hospital_triage'
        );
        $user = User::where('email',$inputs['email'])->first();
        if(!is_null($user))
        {
            $this->ajaxData['status'] = 'error';
            $this->ajaxData['message'] = '创建用户失败！邮箱已被使用！';
            goto addTriageEnd;
        }
        //新建user
        $user = User::create($userInfo);
        if(is_null($user))
        {
            $this->ajaxData['status'] = 'error';
            $this->ajaxData['message'] = '创建用户失败！未知原因，请联系网站管理员！';
            goto addTriageEnd;
        }
        else {
            $this->ajaxData['status'] = 'success';
            $this->ajaxData['message'] = '分诊台账号创建成功！';
            goto addTriageEnd;
        }
        addTriageEnd:
        return json_encode($this->ajaxData);
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
            goto addDoctorEnd;
        }
        $userInfo = array('name'=>$inputs['name'],'email'=>$inputs['email'],'password'=>bcrypt($inputs['password']));
        $user = User::create($userInfo);
        if(is_null($user))
        {
            $message = '创建用户失败！未知错误！';
            goto addDoctorEnd;
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
        addDoctorEnd:
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
            goto editDoctorEnd;
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

        editDoctorEnd:
        $this->ajaxData['message'] = $message;
        $this->ajaxData['doctor'] = $doctor->toArray();
        return json_encode($this->ajaxData);
    }
}