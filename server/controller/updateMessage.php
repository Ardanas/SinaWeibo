<?php
require_once 'conn/functions/conn.php';

session_start();
$link = $conn;

$sex=$_POST['sex'];
$birth=$_POST['birth'];
$phone=$_POST['phone'];
$city=$_POST['city'];
$motto=$_POST['motto'];
$introduce=$_POST['introduce'];
$updateTime=time();
$file = $_FILES['u_cover'];
$name = $file['name'];      //得到文件名称，以数组的形式
$upload_path = "images/portrait/"; //上传文件的存放路径
if ($file){
    foreach ($name as $k=>$names){
      $type = strtolower(substr($names,strrpos($names,'.')+1));//得到文件类型，并且都转化成小写
      $allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
      //把非法格式的图片去除
      if (!in_array($type,$allow_type)){
        unset($name[$k]);
      }
    }
    // $str = array();
    foreach ($name as $k=>$item){
      $type = strtolower(substr($item,strrpos($item,'.')+1));//得到文件类型，并且都转化成小写
      //move_uploaded_file()第一参数是file，第二参数是路径
      if (move_uploaded_file($file['tmp_name'][$k],$upload_path.time().$name[$k])){
    //         array_push($str, $upload_path.time().$name[$k]);
        $str = $upload_path.time().$name[$k];
      }else{
        echo 'failed';
      }
    }
}

if($_SESSION['username']){
      $query="update user set u_sex='{$sex}',u_birth='{$birth}',u_phone='{$phone}',u_motto='{$motto}',u_intro='{$introduce}',u_city='{$city}',u_cover='{$str}',create_update= '{$updateTime}'WHERE u_name='{$_SESSION['username']}'";
//    $query ="update user set u_sex='{$sex}',u_birth='{$birth}',u_phone='{$phone}' where u_name='{$_SESSION['username']}'";
    $result=mysqli_query($link,$query);
      if ($result){
        $response = array(
            'status'  => 200,
            'sign'=>'1',
            'message' => '修改成功！',
            'datas'=>[]
        );
        $back=json_encode($response,JSON_UNESCAPED_UNICODE);
        echo $back;
      }

}
