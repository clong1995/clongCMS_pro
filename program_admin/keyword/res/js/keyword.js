var ajax = new Ajax();
var windows = new Windows();
//点击添加按钮
document.getElementById('addKeyword').onmousedown = function () {
    var keywordName = document.getElementById('keywordName').value;
    if (keywordName != '') {
        ajax.post({
            async: true,
            url: 'keyword.act.php',
            data: {
                act: 'add',
                name: keywordName
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

document.getElementById('keywordItem').onmousedown = function (e) {
    var e = window.event || e;
    var t = e.target || e.srcElement;
    if (t.className.indexOf('keyword-modify') > -1) {
        var cid = t.getAttribute('cid');
        ajax.post({
            async: true,
            url: 'keyword.act.php',
            data: {
                act: 'getKeywordById',
                id: cid
            },
            success: function (response) {
                var content = '<input class="input-text keyword-modify-input" id="keywordModifyInput" type="text" value="' + response + '">' +
                    '<input class="input-btn keyword-modify-btn" id="keywordModifyBtn" type="button" value="修改">';
                windows.win({
                    width: 400,
                    height: 200,
                    title: '修改分类',
                    content: content,
                    seal: true
                });
                document.getElementById('keywordModifyBtn').onmousedown = function () {
                    ajax.post({
                        async: true,
                        url: 'keyword.act.php',
                        data: {
                            act: 'modifyKeywordById',
                            id: cid,
                            name: document.getElementById('keywordModifyInput').value
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
    } else if (t.className.indexOf('keyword-delete') > -1) {
        if (confirm('确实要删除该内容吗?')) {
            ajax.post({
                async: true,
                url: 'keyword.act.php',
                data: {
                    act: 'delKeywordById',
                    id: t.getAttribute('cid')
                },
                success: function (response) {
                    window.location.href = window.location.href;
                }
            });
        }
    }
}