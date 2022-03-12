var $eleBtn = $("#btn");
$eleBtn.click(function () {
    var $eleForm = $("<form method='get'></form>");

    $eleForm.attr("action", "resources/xfResume.rar");

    $(document.body).append($eleForm);

    //提交表单，实现下载
    $eleForm.submit();
});


var waitTime = 180;
var iname = document.getElementById('form_name');
var email = document.getElementById('form_email');
var massage = document.getElementById('form_message');

document.getElementById('towcfmail').onclick = function () {
    if (iname.value == '' || email.value == '' || massage.value == '') {
        alert("填写信息才可以发送哦！");
        return false;
    } else {
        time(this);
        iname.value = '';
        email.value = '';
        massage.value = '';
    }
}

function time(ele) {
    if (waitTime == 0) {
        ele.disabled = false;
        ele.innerHTML = "<input type='submit' class='button btn-send' value='发送信息'>";
        waitTime = 180;// 恢复计时
    } else {
        ele.disabled = true;
        ele.innerHTML = "<h5 style='color: red;'>" + waitTime + " 秒后可以再次发送！</h5>";
        waitTime--;
        setTimeout(function () {
            time(ele)// 关键处-定时循环调用
        }, 1000)
    }
}