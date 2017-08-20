var ajax = new Ajax();
var windows = new Windows();
//点击添加按钮
document.getElementById('addCategory').onmousedown = function () {
    var categoryNmae = document.getElementById('categoryNmae').value;
    if (categoryNmae != '') {
        ajax.post({
            async: true,
            url: 'category.act.php',
            data: {
                act: 'add',
                name: categoryNmae
            },
            success: function (response) {
                if (response == 'success') {
                    window.location.href = window.location.href;
                }
            }
        });
    } else {
        alert('空');
    }
}

document.getElementById('categoryItem').onmousedown = function (e) {
    var e = window.event || e;
    var t = e.target || e.srcElement;
    if (t.className.indexOf('category-modify') > -1) {
        var cid = t.getAttribute('cid');
        ajax.post({
            async: true,
            url: 'category.act.php',
            data: {
                act: 'getCategoryById',
                id: cid
            },
            success: function (response) {
                var content = '<input class="input-text category-modify-input" id="categoryModifyInput" type="text" value="' + response + '">' +
                    '<input class="input-btn category-modify-btn" id="categoryModifyBtn" type="button" value="修改">';
                windows.win({
                    width: 400,
                    height: 200,
                    title: '修改分类',
                    content: content,
                    seal: true
                });
                document.getElementById('categoryModifyBtn').onmousedown = function () {
                    ajax.post({
                        async: true,
                        url: 'category.act.php',
                        data: {
                            act: 'modifyCategoryById',
                            id: cid,
                            name: document.getElementById('categoryModifyInput').value
                        },
                        success: function (response) {
                            if (response == 'success') {
                                window.location.href = window.location.href;
                            } else {
                                alert('修改失败');
                            }
                        }
                    });
                }
            }
        });
    } else if (t.className.indexOf('category-delete') > -1) {
        if (confirm('确实要删除该内容吗?')) {
            ajax.post({
                async: true,
                url: 'category.act.php',
                data: {
                    act: 'delCategoryById',
                    id: t.getAttribute('cid')
                },
                success: function (response) {
                    window.location.href = window.location.href;
                }
            });
        }
    }
}