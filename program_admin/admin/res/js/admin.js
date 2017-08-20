layout();
window.onresize = function () {
    layout();
}
function layout(){
    var doc = document.documentElement, //DOM基对象
        body = document.body;

    var ww = doc.offsetWidth,  //窗口宽度
        wh = doc.clientHeight || doc.offsetHeight; //窗口高度 //ie

    //右侧
    var control = document.getElementById('control');
    control.style.height = wh + 'px';
    //左侧
    var operate = document.getElementById('operate');
    operate.style.cssText = 'width:' + (ww - 150) + 'px;height:' + wh + 'px;';
}