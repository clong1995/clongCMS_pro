<?php
switch (req('act')){
    case 'add':
        $name =  req('name');
        echo $F->set_category($name);
        break;

    case 'getCategoryById':
        $id =  req('id');
        $rs = $F->get_category_by_id($id);
        echo $rs[0]['name'];
        break;

    case 'modifyCategoryById':
        $id =  req('id');
        $name =  req('name');
        echo $F->update_category_by_id($id,$name);
        break;

    case 'delCategoryById':
        $id =  req('id');
        echo $F->delete_category_by_id($id);
        break;
}