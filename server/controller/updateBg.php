<?php
require_once 'conn/functions/conn.php';
session_start();
$link = $conn;
$u_name = $_SESSION['username'];

if(isset($_FILES['file'])&&$_FILES['file']['error']===UPLOAD_ERR_OK){
    $a=time();
    $name= "$a.dat";
    $location ="images/background/$name";
    if (move_uploaded_file($_FILES['file']['tmp_name'], "$location")){
        $username = $_SESSION['username'];
        $id=$_SESSION['id'];
        $create_time=time();
        $query="UPDATE `user`  SET `u_bg`='{$location}'  WHERE  `u_name` = '{$username}' ";
        $result = mysqli_query($link,$query);
        if ($result){
            $response = array(
                'status' => 200,
                'sign'=> 1,
                'message' => '修改主题成功！',
                'datas' => []
            );
            $back = json_encode($response, JSON_UNESCAPED_UNICODE);
            echo $back;
        }else{
            $response = array(
                'status' => 500,
                'sign'=> 0,
                'message' => '修改背景主题失败！',
                'datas' => []
            );
            $back = json_encode($response, JSON_UNESCAPED_UNICODE);
            echo $back;
        }
    }
}