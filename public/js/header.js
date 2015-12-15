$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $( document ).ajaxError(function( event, request, settings ) {
        showAjaxError(event['type'],request['status'],request['statusText'],request['responseText']);
    });
});
function getFormBtn(btnText,btnColor,btnBlock,btnSize,targetFormName,btnClickFunc,dataProcessFunc)
{
    var btn = $('<button></button>').append(btnText).addClass('btn').addClass(btnColor).addClass(btnBlock).addClass(btnSize).attr('data-form',targetFormName).attr('data-recall',dataProcessFunc).on('click',btnClickFunc);
    return btn;
}
function postFormByFormbtn()
{
    var formID = $(this).attr('data-form');
    var postAddress = $('#' + formID).attr('data-target');
    var recallFunc = $(this).attr('data-recall');
    ajaxOneFormByID(formID,postAddress,recallFunc);
}
function ajaxOneFormByID(formID,postAddress,recallFunc)
{
    var data = getFormData($('#' + formID));
    ajaxData(postAddress,data,recallFunc);
}
function getFormData(formElement){
    var data = {};
    $(formElement).find('input').each(function() {
        var name = $(this).attr('name');
        if(name) {
            if(name=='timebtn'){
                data['time']='';
                var str='#btn';
                for(var i=1;i<=24;i++){
                    var tmp=str+''+i;
                    if($(tmp).prop("checked")){
                        data['time']+='1';
                    }else{
                        data['time']+='0';
                    }
                }
                data['time']+='';
            }
            var val = $(this).val();
            if(!val)
                val = $(this).attr('placeholder');
            data[name] = val;
        }
        if(isNull(data[name])) {
            throw new Error(name + '表单输入框为空或者输入不合法！',1);
        }
    });
    $(formElement).find('textarea').each(function() {
        var name = $(this).attr('name');
        if(name) {
            var val = $(this).val();
            if(!val)
                val = $(this).attr('placeholder');
            data[name] = val;
        }
        if(isNull(data[name])) {
            console.log(formElement);
            throw new Error( name + '文本输入框不能为空！',1);
        }
    });
    return data;
}
function isNull(data)
{
    return (data == null || data == '' || data == undefined) ? true : false;
}
function ajaxData(postAddress,data,recallFunc)
{
    $.post(postAddress,data,function(result,status){
       eval(recallFunc)(result,status);
    });
}
function ajaxData2(postAddress,data)
{
    $.post(postAddress,data,function(result,status){
    });
}
function showAjaxError(ErrorType,status,message,responseText){
    var messages = Array();
    messages[0] = Array();
    messages[0]['class'] = 'alert-warning';
    messages[0]['message'] = ErrorType + "(" + status.toString() + ")  :  " + message;
    messages[0]['message'] += responseText;
    showAlertMessages(messages,null);
}
function showBackEndMessages(messages)
{
    if(isNull(messages) || messages.length < 1)
        return;
    messagesToShow = [];
    for(var i = 0; i < messages.length ; i++)
    {
        messagesToShow[i] = [];
        messagesToShow[i]['class'] = 'alert-warning';
        messagesToShow[i]['message'] = messages[i];
    }
    showAlertMessages(messagesToShow);
}
function showAlertMessages(messages,status){
    var messagesContent;
    for(var i = 0 ; i < messages.length ; i++)
    {
        if(i == 0) messagesContent = getMessageAlert(messages[i]['class'],null,messages[i]['message']);
        else $(messagesContent).after(getMessageAlert(messages[i]['class'],null,messages[i]['message']));
    }
    showMessage(messagesContent);
}
function getMessageAlert(alertClass,label,message)
{
    var alertDiv = $('<div></div>').addClass('alert').addClass(alertClass);
    $(alertDiv).append(label);
    $(alertDiv).append(message);
    return alertDiv
}
function showMessage(messageContent){
    $('#message-content').empty();
    $('#message-content').append(messageContent);
    $('#messageModel').modal('show');
}
function getFormGroup(labelText,inputName,inputType,inputPlaceholder,inputSize)
{
    var formgroup = $('<div></div>').addClass('form-group');
    var label = $('<label></label>').append(labelText);
    if(inputType != 'textarea') {
        var input = $('<input>', {
            type: inputType,
            name: inputName,
            placeholder: inputPlaceholder
        }).addClass(inputSize).addClass('form-control');
    }
    else
    {
        var input = $('<textarea></textarea>',{
            name:inputName,
            placeholder:inputPlaceholder,
            rows:8,
        }).addClass('unresize').addClass('form-control');
    }
    $(formgroup).append(label).append(input);
    return formgroup;
}
function catchClientError(e){
    var messages = Array();
    var message = Array();
    message['type'] = 'error';
    message['class'] = 'alert-warning';
    message['message'] = 'Client Error : ' + e.name + "<hr/>&nbsp;&nbsp;&nbsp;&nbsp;" + e.message;
    messages[0] = message;
    showAlertMessages(messages,'');
}