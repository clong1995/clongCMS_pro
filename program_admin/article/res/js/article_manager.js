var ajax = new Ajax();

//获取分页
gatArticlePages(1);

function gatArticlePages(page, count, category, keyword) {
    ajax.post({
        async: true,
        url: 'article.act.php',
        data: {
            act: 'getArticlePages',
            page: page || 1,
            count: count || 7,
            category: category || '',
            keyword: keyword || ''
        },
        success: function (response) {

            var responseObj = eval('(' + response + ')');

            //翻页条========
            var pageInfo = responseObj.info;
            var pagesHtml = '';
            for (var i = 1; i <= pageInfo.allPage; i++) {
                var select = '';
                if (i == pageInfo.page) {
                    select = ' article-page-select';
                }
                pagesHtml += '<span class="article-page' + select + '">' + i + '</span>';
            }
            document.getElementById('articleItemsPages').innerHTML = pagesHtml;

            //翻页
            document.getElementById('articleItemsPages').onmousedown = function (e) {
                var e = window.event || e;
                var t = e.target || e.srcElement;
                if (t.nodeName.toLowerCase() === 'span') {
                    var page = t.textContent;
                    gatArticlePages(page);
                }
            }


            //内容=========
            var pageDate = responseObj.data;
            var pageDateHtml = '';
            for (var item in pageDate) {
                var pageItem = pageDate[item];
                var time = pageItem.time,
                    id = pageItem.id,
                    title = pageItem.title,
                    category_name = pageItem.category_name || '无',
                    keyword_name = pageItem.keyword_name || '无',
                    visit_count = pageItem.visit_count || 0,
                    comment_count = pageItem.comment_count || 0,
                    admin_name = pageItem.admin_name;

                pageDateHtml +=
                    '<div class="article-item">' +
                        '<span class="article-time">' + time + '</span>' +
                        '<span class="article-name ellipsis">' + title + '</span>' +
                        '<span class="article-category ellipsis">' + category_name + '</span>' +
                        '<span class="article-keyword ellipsis">' + keyword_name + '</span>' +
                        '<span class="article-browse">' + visit_count + '</span>' +
                        '<span class="article-comment">' + comment_count + '</span>' +
                        '<span class="article-author">' + admin_name + '</span>' +
                        '<span class="article-option">' +
                            '<span class="text-btn text-btn-yellow article-modify" aid="'+id+'">修改</span>' +
                            '<span class="text-btn text-btn-red article-delete" aid="'+id+'">删除</span>' +
                            '<span class="text-btn text-btn-green article-draft">存为草稿</span>' +
                        '</span>' +
                    '</div>';
            }
            document.getElementById('articleItems').innerHTML = pageDateHtml;

            document.getElementById('articleItems').onmousedown = function (e) {
                var e = window.event || e;
                var t = e.target || e.srcElement;
                if (t.className.indexOf('article-modify') > -1) {
                    var iid = t.getAttribute('aid');
                    window.location.href = 'article_modify-'+iid+'.xhtml';
                } else if (t.className.indexOf('article-delete') > -1) {
                    if (confirm('确实要删除该内容吗?')) {
                        var aid = t.getAttribute('aid');
                        ajax.post({
                            async: true,
                            url: 'article.act.php',
                            data: {
                                act: 'deleteArticleById',
                                id: aid
                            },
                            success: function (response) {
                                if (response == 'success') {
                                    window.location.href = window.location.href;
                                }
                            }
                        })
                    }
                }else if (t.className.indexOf('article-draft') > -1){
                    var iid = t.getAttribute('aid');
                    alert('开发中！');
                }
            }
        }
    });
}