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
use App\Order;
use App\Orders;
use App\User;
use Auth;
use Carbon\Carbon;
use Request;

class HospitalController extends Controller {

    protected $user;
    protected $data = array();
    protected $ajaxData = array();
    protected $ajaxMessages = array();
    protected $timeZone = 'Asia/Shanghai';

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
        foreach($offices as &$office)
        {
            $office->doctors = $office->doctors()->get();
            foreach($office->doctors as &$doctor)
            {
                $doctor->user = $doctor->user()->first();
            }
        }
        $this->data['offices'] = $offices;
        $this->data['hospital'] = $hospital;
        return view('hospital/hospital',$this->data);
    }

    public function getDoctorInfo()
    {
        $doctor = Doctor::find(Request::input('id'));
        $doctor->user = $doctor->user()->first();
        $this->data['doctor'] = $doctor;
        return view('hospital/doctor_information',$this->data);
    }

    public function ajaxSubmitOrder()
    {
        $today = Carbon::today($this->timeZone);
        if(!isset($this->user) || is_null($this->user))
        {
            $this->ajaxData['status'] = 'error';
            $this->ajaxData['message'] = '创建订单失败！请先登录！';
            goto submitOrderEnd;
        }
        $inputs = Request::all();
        $doctor = Doctor::find($inputs['id']);
        if(!isset($doctor) || is_null($doctor))
        {
            $this->ajaxData['status'] = 'error';
            $this->ajaxData['message'] = '请求的医生不存在！请不要随意修改页面！如为正常操作，请联系网站管理员！';
            goto submitOrderEnd;
        }
        $appointDay = Carbon::createFromFormat('Y-m-d',$inputs['date'],$this->timeZone);
        $result = $today->diffInDays($appointDay, false);
        if($result < 0)
        {
            $this->ajaxData['status'] = 'error';
            $this->ajaxData['message'] = '预约的时间必须是今天或者更晚的时间！';
            goto submitOrderEnd;
        }

        if($inputs['daytime'] == 'am')
            $appointDate = $inputs['date'].' 8:00:00';
        else if($inputs['daytime'] == 'pm')
            $appointDate = $inputs['date'].' 14:00:00';
        else
            $appointDate = $inputs['date'];
        if($doctor->isAppointmentsOut($appointDate))
        {
            $this->ajaxData['status'] = 'error';
            $this->ajaxData['message'] = '请求时间内医生的预约数已满，请重新选择！';
            goto submitOrderEnd;
        }
        $office = $doctor->office()->first();
        $hospital = $office->hospital()->first();
        $orderInfo = array(
            'user_id' => $this->user->id,
            'doctor_id' => $doctor->id,
            'office_id' => $office->id,
            'hospital_id' => $hospital->id,
            'order_date' => Carbon::now($this->timeZone),
            'pay_date' => Carbon::now($this->timeZone),
            'state' => 'payed',
            'price' => $doctor->price,
            'refund' => 0,
            'appoint_date' => $appointDate
            );
        $order = Order::create($orderInfo);

        $this->ajaxData['status'] = 'success';
        $this->ajaxData['message'] = '挂号成功！请于指定日期根据挂号信息就诊！';
        $this->ajaxData['order'] = $order;
        submitOrderEnd:
        return json_encode($this->ajaxData);
    }

}