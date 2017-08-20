<?php
switch (req('act')){
    case 'getImageList':
        $rs = $F->get_show_image();
        echo json_encode($rs);
        break;
    case 'deleteImageById':
        $id = req('id');
        echo $F->delete_image_by_id($id);
        break;
    case 'addImage':
        $src = req('src');
        echo $F->add_image($src);
        break;
}