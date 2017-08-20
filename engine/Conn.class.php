<?php

/**
 * Class Conn
 * 链接数据库的函数，可以继承，但方法不能覆盖
 */
class Conn
{
    //获取链接
    final private function get_conn()
    {
        $db_conf = array(
            'ip' => '127.0.0.1',
            'post' => '3306',
            'db' => 'company',
            'user' => 'root',
            'password' => '123456',
        );
        $mysqli = new mysqli($db_conf['ip'] . ':' . $db_conf['post'], $db_conf['user'], $db_conf['password']);
        if ($mysqli->connect_errno) {
            die($mysqli->connect_error);//诊断连接错误
        }
        $mysqli->query("set names 'utf8';");//编码转化
        $select_db = $mysqli->select_db($db_conf['db']);//链接数据库
        if (!$select_db) {
            die($mysqli->error);//诊断数据库错误
        }
        return $mysqli;
    }

    //查询函数
    final public function query_stmt($sql, $paramArr)
    {
        $mysqli = $this->get_conn();
        $rsArr = array();

        if (count($paramArr) < 2) {
            if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $rsArr[] = $row;
                }
            } else {
                $rsArr[] = 'failure:' . $mysqli->error;
            }
            $result->close();
        } else {
            if ($stmt = $mysqli->prepare($sql)) {
                $method = new ReflectionMethod('mysqli_stmt', 'bind_param');
                $ret = array();
                foreach ($paramArr as $key => $val) {
                    $ret[$key] = &$paramArr[$key]; //坑爹啊，bind_param必须要索引，难道bind_param怕在内存中把参数给偷梁换柱？
                }
                $method->invokeArgs($stmt, $ret);
                $stmt_rs = $stmt->execute();
                if (!$stmt_rs) {
                    $rsArr[] = 'failure:' . $stmt->error;
                } else {
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        $rsArr[] = $row;
                    }
                    $result->close();
                    $stmt->close();
                }
            }
        }
        $mysqli->close();
        return $rsArr;
    }


    //更新函数
    final public function update_stmt($sql, $paramArr)
    {
        $rs = 'failure';
        $mysqli = $this->get_conn();
        if (count($paramArr) < 2) {
            if ($result = $mysqli->query($sql)){
                $rs = 'success';
            }
            $result->close();
        } else {
            if ($stmt = $mysqli->prepare($sql)) {

                $method = new ReflectionMethod('mysqli_stmt', 'bind_param');
                $ret = array();
                foreach ($paramArr as $key => $val) {
                    $ret[$key] = &$paramArr[$key];
                }
                $method->invokeArgs($stmt, $ret);
                $stmt_rs = $stmt->execute();
                if (!$stmt_rs) {
                    $rs = 'failure:' . $stmt->error;
                } else {
                    $rs = 'success';
                }
                $stmt->close();
            }
        }
        $mysqli->close();
        return $rs;
    }

    //更新函数事物支持
    final public function update_stmt_tx($txSqlStmtArr)
    {
        $rs = 'failure';
        $mysqli = $this->get_conn();
        //关闭 auto-commit
        $mysqli->autocommit(false);

        $commitFlag = false;
        foreach ($txSqlStmtArr as $value){
            if (count($value[1]) < 2) {
                $result = $mysqli->query($value[0]);
                if (!$result){
                    $commitFlag = false;
                    break;
                }else{
                    $commitFlag = true;
                }
                $result->close();
            }else{
                $stmt = $mysqli->prepare($value[0]);
                if(!$stmt){
                    $commitFlag = false;
                    $stmt->close();
                    break;
                }else{
                    $method = new ReflectionMethod('mysqli_stmt', 'bind_param');
                    $ret = array();
                    foreach ($value[1] as $key => $val) {
                        $ret[$key] = &$value[1][$key];
                    }

                    $method->invokeArgs($stmt, $ret);
                    $stmt_rs = $stmt->execute();

                    if (!$stmt_rs) {
                        $commitFlag = false;
                        $stmt->close();
                        break;
                    }else{
                        $commitFlag = true;
                    }
                }
                $stmt->close();
            }
        }

        if($commitFlag){
            $mysqli->commit();
            $rs = 'success';
        }else{
            $mysqli->rollback();
        }

        $mysqli->close();

        return $rs;
    }
}