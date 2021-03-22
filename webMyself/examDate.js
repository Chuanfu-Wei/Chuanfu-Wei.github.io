// if (typeof window.onload == 'function') {
//     var saved = null;
//     saved = window.onload;
// }

window.onload = function () {

            function checkNum(nums) {
                if (nums < 10) {
                    return '0' + nums;
                }
                return nums;
            }

            var mydiv = document.querySelector('#examDate');
            mydiv.onclick=function(){
                console.log("1");
            }
  
            function showTime() {
                var now = new Date();
                var target = new Date(2022, 2, 20)
                var result = Math.floor((target.getTime() - now.getTime()) / 1000); // 总秒数
                if (result == 0) {
                    mydiv.innerText = '今天考试啦！！！';
                    return;
                }
                var days = checkNum(Math.floor(result / (24 * 60 * 60))); // 天数
                var hours = checkNum(Math.floor((result / (60 * 60))) % 24); // 小时
                var minutes = checkNum(Math.floor((result / 60) % 60)); // 分钟
                var seconds = checkNum(Math.floor(result % 60)); // 秒数
                mydiv.innerText = '距离2022年专转本考试还有：' + days + '天' + hours + '小时' + minutes + '分钟' + seconds + '秒';

                setTimeout(showTime, 1000);
            }
            showTime();
  
}
