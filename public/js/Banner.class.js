/**
 * Created by Administrator on 2017/5/14.
 */
function Banner(opt) {
    var sheet = gatSheet();  //style对象

    //banner元素===========================
    var banner = document.getElementById(opt.id);
    var bannerClass = getRandomChar();
    banner.className = bannerClass;
    //宽高度
    var bannerWidth = parseFloat(banner.style.width),
        bannerHeight = parseFloat(banner.style.height);
    //子节点
    var child = banner.childNodes;
    for (var i = 0; i < child.length; i++) {
        if (child[i].nodeType == 3) {//文字节点
            banner.removeChild(child[i]);
        }
    }


    //滚动元素===========================
    var rollClass = getRandomChar();
    var roll = banner.firstChild;
    roll.className = rollClass;
    var child = roll.childNodes;
    for (var i = 0; i < child.length; i++) {
        if (child[i].nodeType == 3) {//文字节点
            roll.removeChild(child[i]);
        }
    }
    var lastRoll = roll.firstChild.cloneNode(true);
    roll.appendChild(lastRoll);

    var rollLength = roll.childNodes.length;
    var allWidth = rollLength * bannerWidth;

    rollLength -= 1;


    //所有页数===========================
    var page = document.createElement('div');
    var pageClass = getRandomChar();
    page.className = pageClass;
    var pageItem = document.createElement('span');
    for (var pi = 0; pi < rollLength; pi++) {
        var pageItemClone = pageItem.cloneNode(true);
        //pageItemClone.innerHTML = pi + 1;
        pageItemClone.innerHTML = '●';
        pageItemClone.setAttribute('i', pi);
        page.appendChild(pageItemClone);
    }
    var pageItemClassSelect = getRandomChar();
    page.firstChild.className = pageItemClassSelect;
    banner.appendChild(page);


    //动画开始
    var timer1 = 0;
    var index = 0;
    var runFlag = true; //设置一个动画是否走完的标志位

    //所有翻页的点击事件
    page.onclick = function (e) {
        var e = window.event || e;
        var t = e.target || e.srcElement;
        if (t.nodeName.toLowerCase() === 'span') {
            index = t.getAttribute('i');
            tab();
        }
    }


    function tab() {
        //star要转换为rem,因为js的默认单位是px。
        var HFS = parseFloat(document.documentElement.style.fontSize).toFixed(2);
        var start = roll.offsetLeft;
        start = start / HFS;

        var end = -bannerWidth * index;
        var change = end - start;
        var t = 0;
        var maxT = 25;

        clearInterval(timer1);
        timer1 = setInterval(function () {
            t++;
            if (t >= maxT) {
                clearInterval(timer1);
                // alert("停下来了");
                runFlag = true;
            }

            roll.style.left = change / maxT * t + start + "rem";
            if (index == rollLength && t >= maxT) {
                roll.style.left = 0;
            }
        }, 25);

        // inner.style.left = - perWidth * index + "px";
        for (var j = 0; j < rollLength; j++) {
            page.childNodes[j].className = "";
        }
        if (index >= rollLength) {
            page.firstChild.className = pageItemClassSelect;
        } else {
            page.childNodes[index].className = pageItemClassSelect;
        }

    }


    //循环滚动
    function animateRoll() {
        index++;

        if (index > rollLength) {
            index = 1;
        }
        tab();
    }

    //开始
    var timer = setInterval(animateRoll, 3000);

    //暂停
    roll.onmouseover = function () {
        clearInterval(timer);
    }
    //开始
    roll.onmouseout = function () {
        timer = setInterval(animateRoll, 3000);
    }

    //左右翻页===========================
    if (opt.pn) {
        var pn = document.createElement('span');
        var pnClass = getRandomChar();
        pn.className = pnClass;

        var prevBtn = pn.cloneNode(true);
        prevBtn.innerHTML = '▶';//有&#62;
        prevBtn.style.right = 0;

        var nextBtn = pn.cloneNode(true);
        nextBtn.innerHTML = '◀';//座&#60;
        nextBtn.style.left = 0;

        banner.appendChild(prevBtn);
        banner.appendChild(nextBtn);

        //向左
        function next() {
            index--;
            if (index < 0) {
                index = rollLength - 1;
                roll.style.left = -rollLength * bannerWidth + "px";
            }
            tab();
        }

        //向右
        function prev() {

            index++;
            if (index > rollLength) {
                index = 1;
            }
            tab();


        }


        //下一张
        nextBtn.onclick = function () {
            clearInterval(timer);
            if (runFlag) {
                next();
            }
            runFlag = false;

        }
        //上一张
        prevBtn.onclick = function () {
            clearInterval(timer);
            if (runFlag) {
                prev();
            }
            runFlag = false;
        }

        addCSSRule(
            '.' + pnClass,
            'position:absolute;' +
            'top:' + (bannerHeight / 2) + 'rem;' +
            'font-size:.7rem;' +
            'color:#fafafa;' +
            'cursor:pointer'
        );


    }


    //设布局body

    addCSSRule(
        '.' + bannerClass,
        'overflow:hidden;' +
        'position: relative;'
    );

    addCSSRule(
        '.' + rollClass,
        'width:' + allWidth + 'rem;' +
        'height:' + bannerHeight + 'rem;' +
        'position: relative;'
    );
    addCSSRule(
        '.' + rollClass + ' img',
        'width:' + bannerWidth + 'rem;' +
        'height:' + bannerHeight + 'rem;' +
        'float:left;'
    );

    addCSSRule(
        '.' + pageClass,
        'position:absolute;' +
        'bottom:0;' +
        'width:' + bannerWidth + 'rem;' +
        'text-align:center;' +
        'color:#ccc;' +
        'font-size:.4rem;'
    );

    addCSSRule(
        '.' + pageClass + ' span',
        'cursor:pointer;'+
        'padding:0 .1rem'
    )

    addCSSRule(
        '.' + pageItemClassSelect,
        'color:#fff;'
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
