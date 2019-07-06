<?php
require_once 'conn/functions/conn.php';
session_start();
$link = $conn;

//实际
$username=$_POST['username'];
$password=$_POST['password'];


$select="select * from user where u_name='{$username}'and u_password='{$password}'";
$results = mysqli_query($link,$select);
$nums=mysqli_num_rows($results);
//用户信息
$res=mysqli_fetch_array($results);
//echo $res['u_id'];

if($nums == '1'){
    $_SESSION['username']=$username;
    $_SESSION['id'] = $res['u_id'];
    $_SESSION['time']=time();
    $data=array(
        'id'=>$_SESSION['id'],
        'username'=>$_SESSION['username']
    );
    $response = array(
      'status'  => 200,
      'sign'=>'1',
      'message' => '登录成功！',
      'datas'=>$data
    );
    $back=json_encode($response,JSON_UNESCAPED_UNICODE);
    echo $back;
}else{
  $response = array(
      'status'  => 500,
      'sign'=>'0',
      'message' => '密码或用户名错误！',
      'datas'=>[]
  );
  $back=json_encode($response,JSON_UNESCAPED_UNICODE);
  echo $back;
}
