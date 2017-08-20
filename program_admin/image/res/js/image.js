var ajax = new Ajax();
getImageList();


//添加图片
document.getElementById('imageAddBtnSubmit').onmousedown = function () {
    document.getElementById('imgForm').submit();

    //特色图片
    var upImage = '';
    setTimeout(imgRSP, 500);

    function imgRSP() {
        upImage = document.getElementById('ifr').contentDocument.body.textContent;
        if (upImage == '') {
            setTimeout(imgRSP, 500);
        } else {
            //处理贴点图
            var upImageObj = eval('(' + upImage + ')');
            if (upImageObj.errno == 0) {
                var imageStr = upImageObj.data.join(",");
                ajax.post({
                    async: true,
                    url: 'image.act.php',
                    data: {
                        act: 'addImage',
                        src: imageStr
                    },
                    success: function (response) {
                        if (response == 'success') {
                            window.location.href = window.location.href;
                        }
                    }
                });
            } else {
                alert('图上传失败');
            }
        }

    }

}

//获取所有图片
function getImageList() {
    ajax.post({
        async: true,
        url: 'image.act.php',
        data: {
            act: 'getImageList'
        },
        success: function (response) {
            var responseObj = eval('(' + response + ')');
            var imageListHtml = '';
            for (var item in responseObj) {
                imageListHtml += '<div class="image-item">' +
                    '<img class="image-item-img" src="' + responseObj[item].src + '" alt=""/>' +
                    '<div class="image-item-opt">' +
                    //'<span class="text-btn text-btn-yellow image-modify" iid="' + responseObj[item].id + '">修改</span>' +
                    '<span class="text-btn text-btn-red image-delete" iid="' + responseObj[item].id + '">删除</span>' +
                    '</div>' +
                    '</div>';
            }
            document.getElementById('imageItems').innerHTML = imageListHtml;

            document.getElementById('imageItems').onmousedown = function (e) {
                var e = window.event || e;
                var t = e.target || e.srcElement;
                if (t.className.indexOf('image-modify') > -1) {
                    var iid = t.getAttribute('iid');
                    alert('开发中！');
                } else if (t.className.indexOf('image-delete') > -1) {
                    if (confirm('确实要删除该内容吗?')) {
                        var iid = t.getAttribute('iid');
                        ajax.post({
                            async: true,
                            url: 'image.act.php',
                            data: {
                                act: 'deleteImageById',
                                id: iid
                            },
                            success: function (response) {
                                if (response == 'success') {
                                    window.location.href = window.location.href;
                                }
                            }
                        })
                    }
                }
            }

        }
    })
}