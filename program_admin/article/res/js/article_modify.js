var ajax = new Ajax();
var windows = new Windows();
//编辑器
var E = window.wangEditor;
var editor = new E('#toolbar', '#article');
editor.customConfig.uploadImgServer = 'upload.act.php';
editor.customConfig.uploadImgMaxSize = 0.5 * 1024 * 1024;
editor.customConfig.uploadImgTimeout = 10000;
editor.customConfig.zIndex = 1;
editor.create();

//上传图片的预览控件
new UploadPreview({
    uploadID: 'uploadBtn',//按钮的id
    prevWidth: 120,//预览的宽度
    prevHeight: 100,//预览的高度
    max: 3//最大上传数
});


//添加分类
var categoryArr = [];//选中的
var categoryListObj;//服务器返回的，避免多次请求数据
document.getElementById('addCategory').onmousedown = function () {
    //var parent = this.parentNode;
    var addCategoryBtn = this;
    if (categoryListObj == undefined) {
        ajax.post({
            async: true,
            url: 'article.act.php',
            data: {
                act: 'getCategoryList'
            },
            success: function (response) {
                categoryListObj = eval('(' + response + ')');
                categoryFun(categoryListObj, addCategoryBtn);
            }
        })
    } else {
        categoryFun(categoryListObj, addCategoryBtn);
    }
}

/**
 * 分类函数
 * @param categoryListObj 服务器返回的数据
 * @param addCategoryBtn 最初点击的按钮，因为选中的select要一标签的形式放到之前
 */
function categoryFun(categoryListObj, addCategoryBtn) {
    //构造弹窗数据
    var content = '<div style="height: 8px;"></div>';
    for (var item in categoryListObj) {
        var cid = categoryListObj[item].id;
        var checked = '';
        if (categoryArr.indexOf(cid) > -1) {
            checked = 'checked="checked"';
        }
        content += '<label class="category-items">' +
            '<input type="checkbox" name="categoryItems" value="' + cid + '" ' + checked + '/>' +
            categoryListObj[item].name +
            '[' + categoryListObj[item].article_count + '篇]' +
            '</label>';
    }
    content += '<input class="btn-category" id="btnCategory" type="button" value="确定"/>';

    //弹窗窗口
    var close = windows.win({
        width: 400,
        height: 200,
        title: '添加分类',
        content: content,
        seal: true
    });

    //弹窗的添加按钮
    document.getElementById('btnCategory').onmousedown = function () {
        var checkBox = document.getElementsByName("categoryItems");
        var span = document.createElement('span');
        span.className = 'category-item';
        var parent = addCategoryBtn.parentNode;
        for (var i = 0; i < checkBox.length; ++i) {
            if (checkBox[i].checked) {
                var value = checkBox[i].value;
                var name = checkBox[i].parentNode.textContent;
                if (categoryArr.indexOf(value) == -1) {
                    var cloneSpan = span.cloneNode(true);
                    cloneSpan.innerHTML = '✖ ' + name;
                    cloneSpan.setAttribute('cid', value);
                    parent.insertBefore(cloneSpan, addCategoryBtn);
                    categoryArr.push(value);
                }
            }
        }

        close.click();

        //重新绑定新的事件
        parent.onmousedown = function (e) {
            var e = window.event || e;
            var t = e.target || e.srcElement;
            if (t.className == 'category-item') {

                var cid = t.getAttribute('cid');

                for (var item in categoryArr) {
                    if (categoryArr[item] == cid) {
                        categoryArr.splice(item, 1);
                        break;
                    }
                }
                parent.removeChild(t);
            }
        }
    }
}


//添加关键词
var keywordArr = [];
var keywordListObj; //避免重复请求
document.getElementById('addKeyword').onmousedown = function () {
    //var parent = this.parentNode;
    var addKeywordBtn = this;
    if (keywordListObj == undefined) {
        ajax.post({
            async: true,
            url: 'article.act.php',
            data: {
                act: 'getKeywordList'
            },
            success: function (response) {
                keywordListObj = eval('(' + response + ')');
                keywordFun(keywordListObj, addKeywordBtn);
            }
        })
    } else {
        keywordFun(keywordListObj, addKeywordBtn)
    }
}


/**
 * 分类关键词
 * @param categoryListObj 服务器返回的数据
 * @param addCategoryBtn 最初点击的按钮，因为选中的select要一标签的形式放到之前
 */
function keywordFun(keywordListObj, addKeywordBtn) {
    var content = '<div style="height: 8px;"></div>';
    for (var item in keywordListObj) {
        var kid = keywordListObj[item].id;
        var checked = '';
        if (keywordArr.indexOf(kid) > -1) {
            checked = 'checked="checked"';
        }
        content += '<label class="keyword-items">' +
            '<input type="checkbox" name="keywordItems" value="' + kid + '" ' + checked + '/>' +
            keywordListObj[item].name +
            '[' + keywordListObj[item].article_count + '篇]' +
            '</label>';
    }
    content += '<input class="btn-keyword" id="btnKeyword" type="button" value="确定"/>';

    //窗口
    var close = windows.win({
        width: 400,
        height: 200,
        title: '添加关键词',
        content: content,
        seal: true
    });

    //添加按钮
    document.getElementById('btnKeyword').onmousedown = function () {
        var checkBox = document.getElementsByName("keywordItems");
        var span = document.createElement('span');
        span.className = 'keyword-item';
        var parent = addKeywordBtn.parentNode;
        for (var item in checkBox) {
            if (checkBox[item].checked) {
                var value = checkBox[item].value;
                var name = checkBox[item].parentNode.textContent;
                if (keywordArr.indexOf(value) == -1) {
                    var cloneSpan = span.cloneNode(true);
                    cloneSpan.innerHTML = '✖ ' + name;
                    cloneSpan.setAttribute('kid', value);
                    parent.insertBefore(cloneSpan, addKeywordBtn);
                    keywordArr.push(value);
                }
            }
        }

        close.click();

        //重新绑定新的事件
        parent.onmousedown = function (e) {
            var e = window.event || e;
            var t = e.target || e.srcElement;
            if (t.className == 'keyword-item') {
                var kid = t.getAttribute('kid');
                for (var item in keywordArr) {
                    if (keywordArr[item] == kid) {
                        keywordArr.splice(item, 1);
                        break;
                    }
                }
                parent.removeChild(t);
            }
        }
    }
}





//回显
//知道原来的特点图
var oldImgArr = [];
var aid = document.getElementById('aid').value;
ajax.post({
    async: true,
    url: 'article.act.php',
    data: {
        act: 'getArticleById',
        id: aid
    },
    success: function (response) {
        var article = eval('(' + response + ')');
        var articleObj = article[0];

        var span = document.createElement('span');

        console.log(articleObj);

        //标题
        document.getElementById('title').value = articleObj.title;
        //简介
        document.getElementById('intro').value = articleObj.intro;
        //分类
        categoryArr = articleObj.category_id.split(',');
        categoryNameArr = articleObj.category_name.split(',');


        var addCategoryBtn = document.getElementById('addCategory');
        var categoryParent = addCategoryBtn.parentNode;
        for (var i = 0; i < categoryNameArr.length; i++) {
            var cloneSpan = span.cloneNode(true);
            cloneSpan.className = 'category-item';
            cloneSpan.innerHTML = '✖ ' + categoryNameArr[i];
            cloneSpan.setAttribute('cid', categoryArr[i]);
            categoryParent.insertBefore(cloneSpan, addCategoryBtn);
        }
        //重新绑定新的事件
        categoryParent.onmousedown = function (e) {
            var e = window.event || e;
            var t = e.target || e.srcElement;
            if (t.className == 'category-item') {

                var cid = t.getAttribute('cid');

                for (var item in categoryArr) {
                    if (categoryArr[item] == cid) {
                        categoryArr.splice(item, 1);
                        break;
                    }
                }
                categoryParent.removeChild(t);
            }
        }


        //关键词
        keywordArr = articleObj.keyword_id.split(',');
        keywordNameArr = articleObj.keyword_name.split(',');

        var addKeywordBtn = document.getElementById('addKeyword');
        var keywordParent = addKeywordBtn.parentNode;
        for (var i = 0; i < keywordNameArr.length; i++) {
            var cloneSpan = span.cloneNode(true);
            cloneSpan.className = 'keyword-item';
            cloneSpan.innerHTML = '✖ ' + keywordNameArr[i];
            cloneSpan.setAttribute('kid', keywordArr[i]);
            keywordParent.insertBefore(cloneSpan, addKeywordBtn);
        }
        //重新绑定新的事件
        keywordParent.onmousedown = function (e) {
            var e = window.event || e;
            var t = e.target || e.srcElement;
            if (t.className == 'keyword-item') {
                var kid = t.getAttribute('kid');
                for (var item in keywordArr) {
                    if (keywordArr[item] == kid) {
                        keywordArr.splice(item, 1);
                        break;
                    }
                }
                keywordParent.removeChild(t);
            }
        }

        //特点图
        document.getElementById('ifr').contentDocument.body.textContent = '{"errno":4,"data":['+articleObj.feature_img+']}';
        //逻辑
        //知道原来的
        oldImgArr = articleObj.feature_img.split(',');
        //绘制原来的
        var oldImgHtml = '';
        for(var i= 0;i < oldImgArr.length; ++i){
            oldImgHtml += '<div class="old-img" style="display: block;">'+
                '<img src="'+oldImgArr[i]+'">'+
                '<div class="old-img-close" oiid="'+oldImgArr[i]+'">✖</div>'+
                '</div>';
        }
        document.getElementById('oldImg').innerHTML = oldImgHtml;
        //知道杀掉的
        var oldImg = document.getElementById('oldImg');
        oldImg.onmousedown = function (e) {
            var e = window.event || e;
            var t = e.target || e.srcElement;
            var oiid = '';
            if (t.className == 'old-img-close') {
                oiid = t.getAttribute('oiid');
                this.removeChild(t.parentNode);
            }
            for(var i = 0; i<oldImgArr.length;++i){
                if(oldImgArr[i] == oiid){
                    oldImgArr.splice(i, 1);
                }
            }
        }
        //就知道剩下的 //oldImgArr

        //知道新加的

        //剩下的+新加的 就是更新的数据

        //文章
        editor.txt.html(articleObj.article);
    }
})



function addNewArticle() {
    document.getElementById('featureImg').submit();
    //标题
    var title = document.getElementById('title').value;
    //简介
    var intro = document.getElementById('intro').value;
    //文章
    var article = editor.txt.html();

    //分类
    var category = categoryArr.join(",");

    //关键词
    var keyword = keywordArr.join(",");

    //特色图片
    var feature = '';

    setTimeout(featureRSP, 500);

    function featureRSP() {
        feature = document.getElementById('ifr').contentDocument.body.textContent;
        if (feature == '') {
            setTimeout(featureRSP, 500);
        } else {
            //处理贴点图
            var featureObj = eval('(' + feature + ')');
            if (featureObj.errno == 0) {
                //新图片

                for(var i = 0; i<oldImgArr.length;++i){
                    featureObj.data.push(oldImgArr[i]);
                }

                var featureStr = featureObj.data.join(",");

                ajax.post({
                    async: true,
                    url: 'article.act.php',
                    data: {
                        act: 'addArticle',
                        title: title,
                        intro: intro,
                        article: article,
                        category: category,
                        keyword: keyword,
                        feature: featureStr
                    },
                    success: function (response) {
                        if (response == 'success') {
                            alert('修改成功!');
                            window.location.href = 'article_manager.xhtml';
                        } else {
                            alert('修改失败!');
                        }
                    }
                });
            } else {
                alert('特色图上传失败');
            }
        }

    }
}

document.getElementById('btnSubmit').onmousedown = function(){
    //提交
    //删掉之前的
    ajax.post({
        async: true,
        url: 'article.act.php',
        data: {
            act: 'deleteArticleById',
            id: aid
        },
        success: function (response) {
            if (response == 'success') {
                //再添加
                addNewArticle();
            }
        }
    })
}


document.getElementById('btnDraft').onmousedown = function () {
    alert('开发中！');
}