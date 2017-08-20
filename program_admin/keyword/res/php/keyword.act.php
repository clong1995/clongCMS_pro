<?php
switch (req('act')){
    case 'add':
        $name =  req('name');
        echo $F->set_keyword($name);
        break;

    case 'getKeywordById':
        $id =  req('id');
        $rs = $F->get_keyword_by_id($id);
        echo $rs[0]['name'];
        break;

    case 'modifyKeywordById':
        $id =  req('id');
        $name =  req('name');
        echo $F->update_keyword_by_id($id,$name);
        break;

    case 'delKeywordById':
        $id =  req('id');
        echo $F->delete_keyword_by_id($id);
        break;
}