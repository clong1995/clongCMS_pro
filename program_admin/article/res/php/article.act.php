<?php
switch (req('act')) {
    case 'getCategoryList':
        $rs = $F->get_category_list();
        echo json_encode($rs);
        break;

    case 'getKeywordList':
        $rs = $F->get_keyword_list();
        echo json_encode($rs);
        break;

    case 'addArticle':
        $title = req('title');
        $intro = req('intro');
        $article = req('article');
        $category = req('category');
        $keyword = req('keyword');
        $feature = req('feature');
        echo $F->add_article($title, $intro, $article, $category, $keyword, $feature);
        break;

    case 'getArticlePages':
        $page = req('page');
        $count = req('count');
        $category = req('category');
        $keyword = req('keyword');
        $rs =  $F->get_article_pages($page, $count, $category, $keyword);
        echo json_encode($rs);
        break;

    case 'deleteArticleById':
        $aid = req('id');
        echo $F->delete_article_by_id($aid);
        break;

    case 'getArticleById':
        $aid = req('id');
        $rs =  $F->get_article_by_id($aid);
        echo json_encode($rs);
        break;
}