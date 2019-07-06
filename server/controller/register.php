<?php
require_once 'conn/config/config.php';
require_once 'conn/functions/common.func.php';
require_once 'conn/functions/mysql.func.php';
require_once 'conn/functions/conn.php';


//实际
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$create_time=time();
$u_cover="../images/portrait/b.jpg";//头像路径

$link = $conn;
$select="select * from user where u_name='{$username}'";
$results = mysqli_query($link,$select);
$nums=mysqli_num_rows($results);
//echo $nums;
if ($username&&$password){
    if($nums == 0){
      $insert="insert into user(u_name,u_password,u_email,u_cover,create_at) values ('{$username}','{$password}','{$email}','{$u_cover}','{$create_time}')";
      $resultI=mysqli_query($link,$insert);
      $insert2 = "insert into uhome(u_name) values ('{$username}')";
      $result2=mysqli_query($link,$insert2);
      if($resultI&&$result2){
          $response = array(
              'sign'  => 1,
              'status'=> 200,
              'message' => '注册成功！',
              'datas'  => []
          );
          $back=json_encode($response,JSON_UNESCAPED_UNICODE);
          echo $back;
      }else{
          $response = array(
              'sign'  => 0,
              'status'=> 500,
              'message' => '注册失败！',
              'datas'  => []
          );
          $back=json_encode($response,JSON_UNESCAPED_UNICODE);
          echo $back;
      }
    }else{
        $response = array(
            'sign'  => 0,
            'status'=> 500,
            'message' => '用户名已存在！',
            'datas'  => []
        );
        $back=json_encode($response,JSON_UNESCAPED_UNICODE);
        echo $back;
    }
}else{
    $response = array(
        'sign'  => 0,
        'status'=> 500,
        'message' => '用户名或密码不能为空！',
        'datas'  => $username
    );
    $back=json_encode($response,JSON_UNESCAPED_UNICODE);
    echo $back;
}
