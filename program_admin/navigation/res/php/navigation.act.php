<?php
switch (req('act')) {
    case 'getCategoryList':
        $rs = $F->get_category_list();
        echo json_encode($rs);
        break;
    case 'getArticleList':
        $rs = $F->get_all_article_list();
        echo json_encode($rs);
        break;
    case 'addNavigation':
        $name = req('name');
        $type = req('type');
        $value = req('val');
        $sort = req('sort');
        echo $F->set_navigation($name, $type, $value, $sort);
        break;

    case 'getNavigationList':
        $rs = $F->get_nav_list();
        echo json_encode($rs);
        break;

    case 'delNavigationList':
        $navigation_id = req('id');
        echo $F->delete_nav_list($navigation_id);
        break;

    case 'getNavigationById':
        $navigation_id = req('id');
        $rs = $F->get_navigation_by_id($navigation_id);
        echo json_encode($rs);
        break;
}