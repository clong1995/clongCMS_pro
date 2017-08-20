/**
 * Created by Administrator on 2017/5/15.
 *  new UploadPreview({
 *        uploadID:'uploadBtn',//按钮的id
 *        prevWidth:100,//预览的宽度
 *        prevHeight:100,//预览的高度
 *        max:3//最大上传数
 *    });
 */
function UploadPreview(opt) {

    var uploadBtn = opt.uploadID;
    var prevWidth = opt.prevWidth || 100;
    var prevHheight = opt.prevHeight || 100;
    var max = opt.max || 3;

    var len = 0;

    var sheet = gatSheet();  //style对象


    //文件域对象
    var imgInpObj = document.createElement('input');
    var imgInpClass = getRandomChar(4);
    imgInpObj.className = imgInpClass;
    imgInpObj.setAttribute('type', 'file');
    imgInpObj.setAttribute('name', 'imgFile[]');
    //imgInpObj.setAttribute('multiple','multiple');//ie10可以一次选择多个文件，为了兼容考虑不适用

    //包含图片
    var imgDiv = document.createElement('div');
    var imgDivClass = getRandomChar(4);
    imgDiv.className = imgDivClass;

    //删除按钮
    var del = document.createElement('div');
    var delClass = getRandomChar(4);
    del.innerHTML = '✖';
    del.className = delClass;

    //图片对象
    var imgObjPreview = new Image();

    //添加按钮
    var upImgBtn = document.getElementById(uploadBtn);
    upImgBtn.innerHTML = '+';

    //提示对象
    var info = document.createElement('span');
    info.innerHTML = '最多' + max + '张';
    info.style.cssText = 'color: red;iconfont-size: 11px;line-height:27px;display:none';
    upImgBtn.appendChild(info);

    //上传事件
    upImgBtn.onclick = function () {
        if (len >= max) {
            info.style.display = 'block';
            return false;
        }
        //克隆新的input
        var newInp = imgInpObj.cloneNode(true);
        newInp.onchange = inpChange;

        //克隆包含图片
        var newImgDiv = imgDiv.cloneNode(true);
        newImgDiv.appendChild(newInp);
        upImgBtn.parentNode.insertBefore(newImgDiv, upImgBtn);
        newInp.click();
    }

    //显示预览的方法，此处有浏览器漏洞，图片地址可以直接写死客户端的地址
    function inpChange() {
        //文件名
        var fileName = this.value;
        if (!fileName.match(/.jpg|.gif|.png|.bmp|.ico/i)) {
            alert('您上传的图片格式不正确，请重新选择');
        } else {

            //克隆删除
            var newDel = del.cloneNode(true);

            if (this.files && this.files[0]) {
                //克隆图片对象
                var img = imgObjPreview.cloneNode(true);
                //谷歌，苹果
                if (window.navigator.userAgent.indexOf("Chrome") >= 1 || window.navigator.userAgent.indexOf("Safari") >= 1) {
                    img.src = window.webkitURL.createObjectURL(this.files[0]);
                } else {//火狐
                    img.src = window.URL.createObjectURL(this.files[0]);
                }
                this.parentNode.appendChild(img);
            } else {
                //IE下，使用滤镜
                this.select();
                this.blur();
                //绕过缓存文件夹，缓存不可访问
                this.parentNode.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
                this.parentNode.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = document.selection.createRange().text;

                document.selection.empty();
            }
            this.parentNode.appendChild(newDel);
            newDel.onclick = delImg;
            this.parentNode.style.display = 'block';
            ++len;
        }
    }

    function delImg() {
        this.parentNode.parentNode.removeChild(this.parentNode);
        info.style.display = 'none';
        --len;
    }

    //设布局body
    addCSSRule(
        '.' + imgInpClass,
        'display:none'
    );

    //包含图片的div
    addCSSRule(
        '.' + imgDivClass,
        'float:left;' +
        'margin-right:10px;' +
        'width:' + prevWidth + 'px;' +
        'height:' + prevHheight + 'px;' +
        'display:none;' +
        'position:relative;'
    );

    //删除
    addCSSRule(
        '.' + delClass,
        'width:15px;' +
        'height:15px;' +
        'border-radius:50%;' +
        'text-align:center;' +
        'line-height:15px;' +
        'top:0;' +
        'right:0;' +
        'cursor:pointer;' +
        'background:red;' +
        'color:#fff;' +
        'position:absolute;'
    );

    //图片
    addCSSRule(
        '.' + imgDivClass + ' img',
        'width:100%;' +
        'height:100%;'
    );

    //上传按钮
    addCSSRule(
        '#' + uploadBtn,
        'border:2px dashed #ccc;' +
        'color:#ccc;' +
        'iconfont-size: 48px;' +
        'width:70px;' +
        'height: 70px;' +
        'line-height: 70px;' +
        'text-align: center;' +
        'cursor: pointer;' +
        'border-radius: 6px;' +
        'float:left;'
    );


    //获取随机字母
    function getRandomChar(len) {
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