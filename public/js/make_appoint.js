
//展示带有日历的表单
function make_appoint(btn){
    var user_name=$("meta[name='isloggedin']").attr('content');
    if(user_name=='no')
        window.location.href="/login";
    else{
        var doc_id=$(btn).parents('.panel').children('.doc_name').attr('data-id');
        if(doc_id==undefined)
            doc_id=$(btn).prevAll("#doc_name").attr('data-id');
        $("#addFormModal").find(".modal-title").html("挂号预约");
        var make_appoint_form=$('<form></form>').addClass("appoint_form").attr("id","make_appoint").attr('data-id',doc_id);
        var calendar=add_calendar();
        var select=add_select();
        make_appoint_form.append(calendar).append(select);

        showForm(make_appoint_form);
        $('.form_date').datetimepicker({
            language:  'zh-CN',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
    }
}
function add_calendar(){    //添加一个带有日历的form-group
    var form_group=$("<div></div>").addClass('form-group');
    var label=$("<label></label>").attr('for','cal_input2').addClass('control-label').text('选择日期');
    var form_cal=$('<div></div>').addClass('input-group').addClass('date').attr('id','datetimepicker').addClass('form_date').attr('data-date','').attr('data-date-format','yyyy年mm月dd日').attr('data-link-field','cal_input2').attr('data-link-format','yyyy-m-d');
    var input1=$("<input>",{
        type:"text",
        name:"show_date",
        value:""
    }).addClass('form-control').attr('id','cal_input1').attr('readonly','readonly');
    var icon1=$("<span></span>").addClass('input-group-addon').append($("<span></span>").addClass('glyphicon').addClass('glyphicon-remove'));
    var icon2=$("<span></span>").addClass('input-group-addon').append($("<span></span>").addClass('glyphicon').addClass('glyphicon-calendar'));
    var input2=$("<input>",{
        type:"hidden",
        value:""
    }).attr('id','cal_input2');
    form_cal.append(input1).append(icon1).append(icon2);
    form_group.append(label).append(form_cal).append(input2).append('<br/>');
    return form_group
}
function add_select(){    //添加一个select来选择上午下午
    var form_group=$("<div></div>").addClass('form-group');
    var label=$("<label></label>").text('选择时段');
    var select=$('<select></select>').addClass('form-control');
    var option1=$('<option></option>').text('上午');
    var option2=$('<option></option>').text('下午');
    select.append(option1).append(option2);
    form_group.append(label).append(select);
    return form_group;
}

//用Ajax提交日历表单中的日期
function modal_form_click(btn){
    $("#addFormModal").modal('hide');
    $("#addFormModal").one('hidden.bs.modal',function(e){
        //URL需重新写
        ajaxCalDateFormById('make_appoint','/make_appoint',show_result);
    })
}
function ajaxCalDateFormById(formId,postAddress,recallFunc){    //用Ajax提交带有日历的表单
    var data=getFormDateTime($("#"+formId));
    ajaxData(postAddress,data,recallFunc);
}
function getFormDateTime(formId){    //获取表单中的标准格式日期值和时间段值(y-m-d am)，添加医生id字段
    var data={};
    if($(formId).attr('data-id')!=undefined){
        data['id']=$(formId).attr('data-id');
    }
    var date=$(formId).find("#cal_input2").val();
    var date_time=$(formId).find('select').val();
    if(date_time=="上午")
        date_time="am";
    else
        date_time="pm";
    if(isNull(date)){
        throw new Error( '请先选择好日期！',1);
    }
    data['date']=date+' '+date_time;
    return data;
}
function getShowDateTime(formId){    //获取表单中向用户展示的时间值和时间段值(y年m月d日 上午),添加医生id字段
    var data={};
    data['id']=$(formId).attr('data-id');
    var date=$(formId).find("#cal_input1").val();
    var date_time=$(formId).find('select').val();
    data['date']=date+" "+date_time;
    return data;
}

//用Ajax提交表单之后的回调函数，向用户展示请求状态
function show_result(data,status){
    if(status!="success"){
        var err_message=$('<div></div>').addClass('alert').addClass('alert-warning').addClass('text-center');
        err_message.html("服务器请求失败");
        showMessage(err_message);
    }
    else{
        var result=JSON.parse(data);
        if(result['status']=="error"){
            var err_message=$('<div></div>').addClass('alert').addClass('alert-warning').addClass('text-center');
            err_message.html(result['message']);
            showMessage(err_message);
        }
        else{
            var succ_message=$('<div></div>').addClass('alert').addClass('alert-success').addClass('text-center');
            succ_message.html(result['message']);
            showMessage(succ_message);
        }
    }
}
