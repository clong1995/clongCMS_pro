/**
 * Created by clong on 2017/4/17.
 *
 * 登录类
 * new Login({
 *      logo: 'http://www.skyisco.com/image/login/logo.png',
 *      fn: function(userId,pssword){
 *      }
 * });
 */
function Login(opt) {
    //style对象
    var sheet = gatSheet();

    //基本对象
    var doc = document.documentElement;
    var body = document.body;  //body

    var ww = doc.offsetWidth,  //窗口宽度
        wh = doc.clientHeight || doc.offsetHeight; //窗口高度 //ie

    var loginId = getRandomChar(4);

    var login = document.createElement('div');
    var logo = document.createElement('img');
    var userId = document.createElement('input');
    var password = document.createElement('input');
    var button = document.createElement('input');

    var width = 350,
        height = 300;

    login.setAttribute('id', loginId);
    logo.setAttribute('src', opt.logo);

    userId.setAttribute('type', 'text');
    userId.setAttribute('value', '账号');
    password.setAttribute('type', 'password');
    password.setAttribute('value', '密码');
    button.setAttribute('type', 'button');
    button.setAttribute('value', '登录');


    login.appendChild(logo);

    login.appendChild(userId);
    login.appendChild(password);
    login.appendChild(button);

    body.appendChild(login);


    userId.onclick = function () {
        this.value = '';
    }
    userId.onblur = function () {
        if (this.value == '') {
            this.value = '账号';
        }
    }

    password.onclick = function () {
        this.value = '';
    }
    password.onblur = function () {
        if (this.value == '') {
            this.value = '密码';
        }
    }

    button.onclick = function () {
        opt.fn(userId.value, password.value);
    }

    //设置标题布局
    addCSSRule(
        'body',
        'background: #fafafa'
    );
    addCSSRule(
        '#' + loginId,
        'width:' + width + 'px;' +
        'height:' + height + 'px;' +
        'position:absolute;' +
        'top:' + ((wh - 300) / 2 - 50) + 'px;' +
        'left:' + (ww - 350) / 2 + 'px;' +
        'margin:0 auto;'
    );

    addCSSRule(
        '#' + loginId + ' img',
        'width:140px;' +
        'height:140px;' +
        'margin:15px auto 20px auto;' +
        'display:block;'
    );

    addCSSRule(
        '#' + loginId + ' input',
        'width:200px;' +
        'height:20px;' +
        'margin:10px auto;' +
        'text-align:center;' +
        'display:block;'
    );

    addCSSRule(
        '#' + loginId + ' input[type=button]',
        'width:150px;' +
        'height:28px;' +
        'margin:15px auto;' +
        'display:block;' +
        'cursor:pointer;'
    );


    //获取随机字母
    function getRandomChar(len) {
        var rc = '';
        for (var i = 0; i < len; ++i) {
            //大写字母'A'的ASCII是65,A~Z的ASCII码就是65 + 0~25;然后调用String.fromCharCode()传入ASCII值返回相应的字符
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
