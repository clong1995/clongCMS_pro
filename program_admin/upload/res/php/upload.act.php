<?php
$imageArr = array();
$imgError = 4;
$uploadFlag = true;
foreach ($_FILES as $key => $value) {
    if (is_array($value['name'])) {
        //验证类型
        if ($uploadFlag) {
            foreach ($value['type'] as $type) {
                if (($type == "image/gif") || ($type == "image/jpeg") || ($type == "image/pjpeg") || ($type == "image/png") || ($type == "image/x-icon")) {

                } else {
                    $imgError = 10;//超过大小
                    $uploadFlag = false;
                    break;
                }
            }
        }

        //验证大小
        if ($uploadFlag) {
            foreach ($value['size'] as $size) {
                if ($size > 500 * 1000) {
                    $imgError = 11;//类型不服
                    $uploadFlag = false;
                    break;
                }
            }
        }

        //验证错误
        if ($uploadFlag) {
            foreach ($value['error'] as $error) {
                if ($error != 0) {
                    $imgError = $error;
                    $uploadFlag = false;
                    break;
                }
            }
        }

        //上传
        if ($uploadFlag) {
            for ($tn = 0; $tn < count($value['tmp_name']); ++$tn) {
                if ($value['type'][$tn] == "image/gif") $type = 'gif';
                if ($value['type'][$tn] == "image/jpeg" || $value['type'][$tn] == "image/pjpeg") $type = 'jpg';
                if ($value['type'][$tn] == "image/png") $type = 'png';
                if ($value['type'][$tn] == "image/x-icon") $type = 'ico';

                $file=file_get_contents($value['tmp_name'][$tn]);
                $md5 =  md5($file);

                $newName = $md5 . '.' . $type;
                if(!is_file(ROOT_PATH . '/storage/' . $newName)){
                    move_uploaded_file($value['tmp_name'][$tn], ROOT_PATH . '/storage/' . $newName);
                }

                $imageArr[] = 'storage/' . $newName;
            }
            $imgError = 0;
        }

    } else {
        if (($value['type'] == "image/gif") || ($value['type'] == "image/jpeg") || ($value['type'] == "image/pjpeg") || ($value['type'] == "image/png") || ($type == "image/x-icon")) {
            if ($value['size'] > 500 * 1000) {
                $imgError = 10;//超过大小
            } else {
                if ($value['error'] == 0) {
                    if ($value['type'] == "image/gif") $type = 'gif';
                    if ($value['type'] == "image/jpeg" || $value['type'] == "image/pjpeg") $type = 'jpg';
                    if ($value['type'] == "image/png") $type = 'png';
                    if ($value['type'] == "image/x-icon") $type = 'ico';

                    $file=file_get_contents($value['tmp_name']);
                    $md5 =  md5($file);
                    $newName = $md5 . '.' . $type;
                    if(!is_file(ROOT_PATH . '/storage/' . $newName)) {
                        move_uploaded_file($value['tmp_name'], ROOT_PATH . '/storage/' . $newName);
                    }
                    $imageArr[] = 'storage/' . $newName;
                    $imgError = $value['error'];
                } else {
                    $imgError = $error;
                }
            }
        } else {
            $imgError = 11;//类型不服
        }
    }

}


echo json_encode(array(
    'errno' => $imgError,
    'data' => $imageArr
));