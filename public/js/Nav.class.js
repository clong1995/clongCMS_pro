/**
 * Created by Administrator on 2017/5/14.
 */
function Nav(opt) {
    var doc = document.documentElement, //DOM基对象
        body = document.body,  //body
        sheet = gatSheet();  //style对象


    //遮罩
    var blank = document.createElement('div');
    var blankClass = getRandomChar();
    blank.className = blankClass;

    //菜单
    var menu = document.getElementById(opt.menu);
    var menuClass = getRandomChar();
    menu.className = menuClass;


    document.getElementById(opt.menuBtn).onclick = function () {
        blank.style.height = document.documentElement.offsetHeight + 'px';
        body.appendChild(blank);
        //菜单出现
        var start = -1 * opt.width;
        startRun(menu, opt.position, start, 0);
    }

    //遮罩消失
    blank.onclick = function () {
        body.removeChild(this);
        //菜单消失
        var end = -1 * opt.width;
        startRun(menu, opt.position, 0, end);
    }


    function startRun(obj, towards, start, end) {
        var timer = null;
        var change = end - start;
        var t = 0;
        var maxT = 7;
        var move = 0;
        timer = setInterval(function () {
            t++;
            if (t >= maxT) {
                clearInterval(timer);
            }
            move = change / maxT * t + start + "rem";
            if (towards == 'top') {
                obj.style.top = move;
            } else if (towards == 'right') {
                obj.style.right = move;
            } else if (towards == 'bottom') {
                obj.style.bottom = move;
            } else if (towards == 'left') {
                obj.style.left = move;
            }
        }, 41);
    }


    //设布局body

    addCSSRule(
        '.' + blankClass,
        'background: rgba(0, 0, 0, 0.4);' +
        'width: 100%;' +
        'position: absolute;' +
        'top: 0;' +
        'left: 0;' +
        'z-index: 3;'
    );

    addCSSRule(
        '.' + menuClass,
        'height: 100%;' +
        'width: ' + opt.width + 'rem;' +
        opt.position + ': -' + opt.width + 'rem;' +
        'background: #383838;' +
        'position: fixed;' +
        'top: 0;' +
        'z-index: 4;'
    );

    addCSSRule(
        '.' + menuClass + ' a',
        'display: block;'
    );


    //获取随机字母
    function getRandomChar(len) {
        var len = len || 4;
        var rc = '';
        for (var i = 0; i < len; ++i) {
            rc += String.fromCharCode(65 + Math.ceil(Math.random() * 25));
        }
        return rc;
    }

    //创建style
    function gatSheet() {
        var style = document.createElement("style");
        document.getElementsByTagName("head")[0].appendChild(style);
        return document.styleSheets[0];
    }

    //设置style规则
    function addCSSRule(selector, rules) {
        if ("insertRule" in sheet)
            sheet.insertRule(selector + "{" + rules + "}", sheet.cssRules.length);
        else if ("addRule" in sheet)
            sheet.addRule(selector, rules, -1);
    }
}
