var windows = new Windows();
var ajax = new Ajax();

//获取导航
getAllNav();

//缓存分类
var categoryList;
//缓存文章
var articleList;

var addNavigationArr = [];


document.getElementById('navigationAdd').onmousedown = function () {
    var selectDiv = "<div class='win-select'>" +
        "类别：" +
        "<select id='selectObj'>" +
        "<option value='1'>到分类</option>" +
        "<option value='2'>到文章</option>" +
        "<option value='3'>到链接</option>" +
        "</select>" +
        "</div>";
    var optDiv = "<div class='win-opt' id='optDiv'></div>";

    var btnDiv = "<div class='win-btn'>" +
        "<input id='winBtn' type='button' value='确定'/>　"
    "</div>";

    var close = windows.win({
        width: 600,
        height: 150,
        title: '选择连接到',
        content: selectDiv + optDiv + btnDiv,
        seal: true
    });

    //默认获取分类
    getCategory();

    //不同的操作
    document.getElementById('selectObj').onchange = function () {
        if (this.value == 1) { //选择分类
            getCategory();
        } else if (this.value == 2) {//选择文章
            getArticle();
        } else {//输入链接
            setLink();
        }
    }

    //确定选择
    document.getElementById('winBtn').onmousedown = function () {
        var selectVal = document.getElementById('selectObj').value;
        var selected = document.getElementById('categoryVal').value;
        var selectedIndex = document.getElementById('categoryVal').selectedIndex;
        var selectHtml = '';
        if (selectedIndex == undefined) {
            selectHtml = selected;
        } else {
            selectHtml = document.getElementById('categoryVal').options[selectedIndex].text;
        }
        addNavigationArr[0] = selectVal;
        addNavigationArr[1] = selected;
        document.getElementById('modelSelected').innerHTML = selectHtml;
        close.click();
    }
}

//确定添加
document.getElementById('navigationAddBtn').onmousedown = function () {
    var name = document.getElementById('navigationAddName').value;
    var sort = document.getElementById('navigationSort').value;
    var type = addNavigationArr[0];
    var val = addNavigationArr[1];
    addNavFun(name,sort,type,val);
}

function addNavFun(name,sort,type,val) {
    if (name == '') {
        alert('请填写导航名称');
    } else if (sort == '') {
        alert('请填写排序');
    } else {
        ajax.post({
            async: true,
            url: 'navigation.act.php',
            data: {
                act: 'addNavigation',
                name: name,
                sort: sort,
                type: type,
                val: val
            },
            success: function (response) {
                if (response == 'success') {
                    window.location.href = window.location.href;
                }
            }
        });
    }
}

//选择分类
function getCategory(select) {
    var val = select || '';
    if (categoryList != undefined) {
        categoryFun(categoryList,val);
    } else {
        ajax.post({
            async: true,
            url: 'navigation.act.php',
            data: {
                act: 'getCategoryList'
            },
            success: function (response) {
                categoryList = eval('(' + response + ')');
                categoryFun(categoryList,val);
            }
        });
    }
}
//分类函数
function categoryFun(categoryList,val) {
    var categoryListHtml = '选择：<select id="categoryVal">';
    var selected = '';
    for (var i = 0; i < categoryList.length; ++i) {
        var valueId = categoryList[i].id;
        if (valueId == val) {
            selected = 'selected="selected"';
        }
        categoryListHtml += '<option value="' + valueId + '" ' + selected + '>' + categoryList[i].name + '[' + categoryList[i].article_count + '篇]</option>';
        selected = '';
    }
    categoryListHtml += '</select>';
    document.getElementById('optDiv').innerHTML = categoryListHtml;
}


//输入链接
function setLink(select) {
    var val = select || '';
    var linkHtml = '输入链接：<input type="text" id="categoryVal" value="' + val + '"/>';
    document.getElementById('optDiv').innerHTML = linkHtml;
}

//获取文章列表
function getArticle(select) {
    var val = select || '';
    if (articleList == undefined) {
        ajax.post({
            async: true,
            url: 'navigation.act.php',
            data: {
                act: 'getArticleList'
            },
            success: function (response) {
                articleList = eval('(' + response + ')');
                articleFun(articleList,val);
            }
        })
    } else {
        articleFun(articleList,val);
    }
}

function articleFun(articleList,val) {
    var articleListHtml = '选择：<select id="categoryVal">';

    var selected = '';
    for (var i = 0; i < articleList.length; ++i) {
        var valueId = articleList[i].id;
        if (valueId == val) {
            selected = 'selected="selected"';
        }
        articleListHtml += '<option value="' + valueId + '" ' + selected + '>' + articleList[i].title + '</option>';
        selected = '';
    }
    articleListHtml += '</select>';
    document.getElementById('optDiv').innerHTML = articleListHtml;
}


//获取导航
function getAllNav() {
    ajax.post({
        async: true,
        url: 'navigation.act.php',
        data: {
            act: 'getNavigationList'
        },
        success: function (response) {
            var navObj = eval('(' + response + ')');
            var navHtml = '';
            for (var item in navObj) {
                navHtml += '<div class="navigation-item">' +
                    '<span class="navigation-num">' + (item + 1) + '</span>' +
                    '<span class="navigation-name">' + navObj[item].name + '</span>' +
                    '<span class="navigation-model">' + navObj[item].target_name + '</span>' +
                    '<span class="navigation-position">' + navObj[item].sort + '</span>' +
                    '<span class="navigation-option">' +
                    '<span class="navigation-modify text-btn text-btn-yellow" nid="' + navObj[item].id + '">修改</span>' +
                    '<span class="navigation-del text-btn text-btn-red" nid="' + navObj[item].id + '">删除</span></span>' +
                    '</div>';
            }
            document.getElementById('navigationItems').innerHTML = navHtml;

            document.getElementById('navigationItems').onmousedown = function (e) {
                var e = window.event || e;
                var t = e.target || e.srcElement;
                var nid = t.getAttribute('nid');
                if (t.className.indexOf('navigation-modify') > -1) {
                    //获取导航那内容
                    ajax.post({
                        async: true,
                        url: 'navigation.act.php',
                        data: {
                            act: 'getNavigationById',
                            id: nid
                        },
                        success: function (response) {
                            var navObj = eval('(' + response + ')');
                            console.log(navObj);

                            var inpDiv = '<div class="win-input-div">' +
                                '名称：<input class="win-nav-name" id="winNavName" type="text" value="' + navObj[0].name + '"/>' +
                                '位置:<input class="win-sort" id="winSort" type="text" value="' + navObj[0].sort + '"/>' +
                                '</div>';

                            var selectDiv = "<div class='win-modify-select'>" +
                                "类别：" +
                                "<select id='selectObj'>" +
                                "<option value='1'>到分类</option>" +
                                "<option value='2'>到文章</option>" +
                                "<option value='3'>到链接</option>" +
                                "</select>" +
                                "</div>";
                            var optDiv = "<div class='win-modify-opt' id='optDiv'></div>";

                            var btnDiv = "<div class='win-modify-btn'>" +
                                "<input id='winBtn' type='button' value='确定'/>　"
                            "</div>";

                            var close = windows.win({
                                width: 600,
                                height: 150,
                                title: '修改导航',
                                content: inpDiv + selectDiv + optDiv + btnDiv,
                                seal: true
                            });

                            var selectObj = document.getElementById('selectObj');
                            var selectedVal = 0;
                            if (navObj[0].type == 'category') { //选择分类
                                selectedVal = 1;
                                getCategory(navObj[0].target_id);
                            } else if (navObj[0].type == 'article') {//选择文章
                                selectedVal = 2;
                                getArticle(navObj[0].target_id);
                            } else {
                                selectedVal = 3;
                                setLink(navObj[0].target_id);
                            }

                            //执行选中
                            for (var i = 0; i < selectObj.options.length; i++) {
                                if (selectObj.options[i].value == selectedVal) {
                                    selectObj.options[i].selected = true;
                                    break;
                                }
                            }

                            //不同的操作
                            document.getElementById('selectObj').onchange = function () {
                                if (this.value == 1) { //选择分类
                                    getCategory();
                                } else if (this.value == 2) {//选择文章
                                    getArticle();
                                } else {//输入链接
                                    setLink();
                                }
                            }

                            //close.click();
                            //确定选择
                            document.getElementById('winBtn').onmousedown = function () {
                                var name = document.getElementById('winNavName').value;
                                var sort = document.getElementById('winSort').value;
                                var type = document.getElementById('selectObj').value; //类型
                                var val = document.getElementById('categoryVal').value;
                                //alert(name+"---"+sort+"---"+type+"---"+val);
                                //删除之前的
                                ajax.post({
                                    async: true,
                                    url: 'navigation.act.php',
                                    data: {
                                        act: 'delNavigationList',
                                        id: nid
                                    },
                                    success: function (response) {
                                        if (response == 'success') {
                                            //添加新的
                                            addNavFun(name,sort,type,val);
                                            close.click();
                                        }
                                    }
                                })

                            }
                        }
                    })

                } else if (t.className.indexOf('navigation-del') > -1) {
                    if (confirm('确实要删除该导航吗?')) {
                        ajax.post({
                            async: true,
                            url: 'navigation.act.php',
                            data: {
                                act: 'delNavigationList',
                                id: nid
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
