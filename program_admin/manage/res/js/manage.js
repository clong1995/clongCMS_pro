var ajax = new Ajax();
//logo
(function logoFun() {
    var oldLogo = '';
    document.getElementById('logoDel').onmousedown = function () {
        var logoParent = this.parentNode;
        oldLogo = logoParent.innerHTML;
        logoParent.innerHTML = '<span id="upLogo"></span>';
        new UploadPreview({
            uploadID: 'upLogo',//按钮的id
            prevWidth: 120,//预览的宽度
            prevHeight: 100,//预览的高度
            max: 3//最大上传数
        });
        var backObj = document.createElement('span');
        backObj.innerHTML = '取消';
        backObj.id = 'logoBack';
        backObj.className = 'text-btn';
        document.getElementById('logoSub').parentNode.appendChild(backObj);
        backObj.onmousedown = function () {
            logoParent.innerHTML = oldLogo;
            backObj.parentNode.removeChild(backObj);
            logoFun();
        }
    }
})();

//icon
(function faviconFun() {
    var oldFavicon = '';
    document.getElementById('faviconDel').onmousedown = function () {
        var faviconParent = this.parentNode;
        oldFavicon = faviconParent.innerHTML;
        faviconParent.innerHTML = '<span id="upFavicon"></span>';
        new UploadPreview({
            uploadID: 'upFavicon',//按钮的id
            prevWidth: 120,//预览的宽度
            prevHeight: 100,//预览的高度
            max: 3//最大上传数
        });
        var backObj = document.createElement('span');
        backObj.innerHTML = '取消';
        backObj.className = 'text-btn';
        backObj.id = 'faviconBack';
        document.getElementById('faviconSub').parentNode.appendChild(backObj);
        backObj.onmousedown = function () {
            faviconParent.innerHTML = oldFavicon;
            backObj.parentNode.removeChild(backObj);
            faviconFun();
        }
    }
})();

//提交网站名
document.getElementById('webNameSubmit').onmousedown = function () {
    var title = document.getElementById('webNameInp').value;
    ajax.post({
        async: true,
        url: 'manage.act.php',
        data: {
            act: 'setWebName',
            title:title
        },
        success: function (response) {
            if (response == 'success'){
                alert('设置成功！');
            }else{
                alert('设置失败！');
            }
        }
    })
}

//提交网网址
document.getElementById('linkSubmit').onmousedown = function () {
    var link = document.getElementById('linkInp').value;
    ajax.post({
        async: true,
        url: 'manage.act.php',
        data: {
            act: 'setWebLink',
            link:link
        },
        success: function (response) {
            if (response == 'success'){
                alert('设置成功！');
            }else{
                alert('设置失败！');
            }
        }
    })
}


//提交网网址
document.getElementById('mobileLinkSubmit').onmousedown = function () {
    var link = document.getElementById('mobileLinkInp').value;
    ajax.post({
        async: true,
        url: 'manage.act.php',
        data: {
            act: 'setMobileLink',
            link:link
        },
        success: function (response) {
            if (response == 'success'){
                alert('设置成功！');
            }else{
                alert('设置失败！');
            }
        }
    })
}

//提交简介
document.getElementById('introSubmit').onmousedown = function () {
    var intro = document.getElementById('introInp').value;
    ajax.post({
        async: true,
        url: 'manage.act.php',
        data: {
            act: 'setWebIntro',
            intro:intro
        },
        success: function (response) {
            if (response == 'success'){
                alert('设置成功！');
            }else{
                alert('设置失败！');
            }
        }
    })
}

//提交简介
document.getElementById('adminSubmit').onmousedown = function () {
    var name = document.getElementById('nameInp').value;
    var newPassword = document.getElementById('newPasswordInp').value;
    var oldPassword = document.getElementById('oldPasswordInp').value;
    ajax.post({
        async: true,
        url: 'manage.act.php',
        data: {
            act: 'setAdmin',
            name:name,
            newPassword:newPassword,
            oldPassword:oldPassword
        },
        success: function (response) {
            if (response == 'success'){
                alert('设置成功！');
            }else{
                alert('设置失败！');
            }
        }
    })
}

//提交logo
document.getElementById('logoSub').onmousedown = function () {
    document.getElementById('logoImg').submit();
    setTimeout(imgRs, 500);
    //获取图片返回值
    function imgRs() {
        var feature = document.getElementById('ifr').contentDocument.body.textContent;
        if (feature == '') {
            setTimeout(imgRs, 500);
        } else {
            //处理贴点图
            var featureObj = eval('(' + feature + ')');
            if (featureObj.errno == 0) {
                var featureStr = featureObj.data[0];

                ajax.post({
                    async: true,
                    url: 'manage.act.php',
                    data: {
                        act: 'setLogoSrc',
                        src:featureStr
                    },
                    success: function (response) {
                        if (response == 'success'){
                            alert('设置成功！');
                            var back = document.getElementById('logoBack');
                            back.parentNode.removeChild(back);
                        }else{
                            alert('设置失败！');
                        }
                    }
                })
            } else {
                alert('上传失败');
            }
        }

    }
}

//提交favicon
document.getElementById('faviconSub').onmousedown = function () {
    document.getElementById('faviconImg').submit();
    setTimeout(imgRs, 500);
    //获取图片返回值
    function imgRs() {
        var feature = document.getElementById('ifr').contentDocument.body.textContent;
        if (feature == '') {
            setTimeout(imgRs, 500);
        } else {
            //处理贴点图
            var featureObj = eval('(' + feature + ')');
            if (featureObj.errno == 0) {
                var featureStr = featureObj.data[0];

                ajax.post({
                    async: true,
                    url: 'manage.act.php',
                    data: {
                        act: 'setFaviconSrc',
                        src:featureStr
                    },
                    success: function (response) {
                        if (response == 'success'){
                            alert('设置成功！');
                            var back = document.getElementById('faviconBack');
                            back.parentNode.removeChild(back);
                        }else{
                            alert('设置失败！');
                        }
                    }
                })
            } else {
                alert('上传失败');
            }
        }

    }

}