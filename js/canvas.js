// const 用于声明一个或多个常量，声明时必须进行初始化，且初始化后值不可再修改;
// const 定义的变量并非常量，并非不可变，它定义了一个常量引用一个值。使用 const 定义的对象或者数组，其实是可变的

// 获取显示浏览器的屏幕的可用宽度、高度并赋值给canvas，然后初始化变量width和变量height
const width = document.getElementById("myCanvas").width = screen.availWidth;
const height = document.getElementById("myCanvas").height = screen.availHeight;

// 获取一个用于在画布上绘图的环境
const ctx = document.getElementById("myCanvas").getContext("2d");

// 获取一个长度指定，元素全为0的数组，以便后面调用map方法(至于为什么会/10呢，因为这一个字符的字号就是10)
const arr = Array(Math.ceil(width / 10)).fill(0);

// 指定显示的字符串，并且分割为单个字符，返回一个数组
const str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789".split("");

// forEach() 方法用于调用数组的每个元素，并将元素传递给回调函数。
// 然而forEach是不会有返回值的，如果需要接收返回值，就调用.map方法，这里用map当然也可以，但是不符合规范
function rain() {
    //这里的重点就是每次调用这个方法的时候都会重新绘制一张透明度为0.05的黑色画布来覆盖前图
    //所以就会形成人眼中的下雨效果

    // fillStyle 属性设置或返回用于填充绘画的颜色、渐变或模式，rgba指定了rgb颜色以及Alpha透明度
    ctx.fillStyle = "rgba(0,0,0,0.05)";

    // fillRect() 方法绘制“已填色”的矩形。默认的填充颜色是黑色(Rect-rectangular矩形)
    /**
     * context.fillRect(x,y,width,height);
     * x        矩形左上角的 x 坐标
     * y        矩形左上角的 y 坐标
     * width    矩形的宽度，以像素计
     * height   矩形的高度，以像素计
     */
    ctx.fillRect(0, 0, width, height);

    ctx.fillStyle = "#0f0";
    // ctx.fillStyle = "black";
    arr.forEach(function (value, index) {
        // fillText() 方法在画布上绘制填色的文本。文本的默认颜色是黑色。前面已经定义文字为绿色，即代码的颜色;
        /**
         * context.fillText(text,x,y,maxWidth);
         * text     规定在画布上输出的文本
         * x        开始绘制文本的 x 坐标位置（相对于画布）
         * y        开始绘制文本的 y 坐标位置（相对于画布）
         */
        // 随机选取定义的数组中的一个元素，以便出现单个字符
        ctx.fillText(str[Math.floor(Math.random() * str.length)], index * 10, value + 10);

        // 数组arr通过调用forEach方法，将数组中每个元素在第一行进行打印，然而，forEach方法是没办法改变原数组的
        arr[index] = value >= height || value > 8888 * Math.random() ? 0 : value + 10;
    });
}

setInterval(rain, 30);