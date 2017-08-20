/**
 * Created by Administrator on 2017/5/15.
 *
 */
function Windows() {
    var doc = document.documentElement, //DOM基对象
        body = document.body,  //body
        sheet = gatSheet();  //style对象
    //窗口class
    var winClass = getRandomChar() + new Date().getTime();
    var sealClass = getRandomChar() + new Date().getTime();
    var contentClass = getRandomChar() + new Date().getTime();

    var ww = doc.offsetWidth,  //窗口宽度
        wh = doc.clientHeight || doc.offsetHeight; //窗口高度 //ie
    var winCount = 3;

    this.win = function (opt) {
        ++winCount;
        var width = opt.width || 200;
        var height = opt.height || 200;
        var title = opt.title || '';
        var content = opt.content || '';
        var seal = opt.seal || false

        //窗体
        var winDiv = document.createElement('div');
        //标题
        var titleH3 = document.createElement('h3');

        //主体
        var contentDiv = document.createElement('div');
        contentDiv.className = contentClass;

        //关闭
        var closeSpan = document.createElement('span');

        var sealDiv = document.createElement('div');


        //设置标题
        titleH3.innerHTML = title;

        //设置主体
        contentDiv.innerHTML = content;

        //关闭
        closeSpan.innerHTML = '●';

        //移动动作
        titleH3.onmousedown = function (e) {
            this.parentNode.style.zIndex = ++winCount;
            var e = window.event || e;
            var winObj = this.parentNode;

            var x = e.clientX - winObj.offsetLeft;
            var y = e.clientY - winObj.offsetTop;

            body.onmousemove = function (event) {
                e = event || window.event;

                winDiv.style.left = e.clientX - x + 'px';
                winDiv.style.top = e.clientY - y + 'px';
            }
        };

        //解除移动
        titleH3.onmouseup = function () {
            body.onmousemove = null;
        }

        //关闭动作
        closeSpan.onclick = function (e) {
            var e = window.event || e;
            if (document.all) {  //只有ie识别
                e.cancelBubble = true;
            } else {
                e.stopPropagation();
            }
            winDiv.parentNode.removeChild(winDiv);
            sealDiv.parentNode.removeChild(sealDiv);
        };

        var winSize = 'width:' + width + 'px;' +
            'height:' + height + 'px;' +
            'top:' + ((wh - height) / 2.5) + 'px;' +
            'left:' + ((ww - width) / 2) + 'px;' +
            'z-index:' + winCount + ';';

        //加入关闭
        titleH3.appendChild(closeSpan);
        //加入标题
        winDiv.appendChild(titleH3);
        //设置主体
        winDiv.appendChild(contentDiv);
        //设置id
        winDiv.className = winClass;
        winDiv.style.cssText = winSize;
        //winDiv.id = winOpt.id;
        if (seal) {
            sealDiv.className = sealClass;
            sealDiv.style.zIndex = winCount - 1;
            body.appendChild(sealDiv);
        }
        body.appendChild(winDiv);

        return closeSpan;
    }

    //设置布局
    addCSSRule(
        '.' + winClass,
        'position:absolute;' +
        'border:1px solid #E4E6E7;'
    );


    //设置标题布局
    addCSSRule(
        '.' + winClass + " h3",
        'text-align:center;' +
        'width:100%;' +
        'height:30px;' +
        'line-height:30px;' +
        'iconfont-weight:normal;' +
        'iconfont-size:14px;' +
        'letter-spacing: 1px;' +
        'cursor:move;' +
        'background:#EEF3F5;' +
        //'background:rgba(204,204,204,1);' +
        'border-radius:7px 7px 0 0;' +
        'margin:0;' +
        'left:-1px;' +
        'position:absolute;' +
        'top:-32px;' +
        'border:1px solid #E4E6E7;' +
        'border-top:2px solid #E4E6E7;'// +
        //'border-bottom:none;'
    );

    //设置主体布局
    addCSSRule(
        '.' + contentClass,
        'width:100%;' +
        'height:100%;' +
        'overflow:hidden;'+
        'position: relative;'+
        'background:#fff;'
    )

    //设置标题布局
    addCSSRule(
        '.' + winClass + " h3 span",
        'color:red;' +
        'iconfont-size:24px;' +
        'cursor:pointer;' +
        'position:absolute;' +
        'right:10px;' +
        'line-height:27px;'
    );

    addCSSRule(
        '.' + sealClass,
        'background:rgba(0, 0, 0,0.2);' +
        'width:100%;' +
        'height:100%;' +
        'position:absolute;' +
        'top:0;' +
        'left:0;'
    );

    //设置iframe布局
    addCSSRule(
        '.' + winClass + " iframe",
        'width:100%;' +
        'height:100%;' +
        'border:none;'
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