<?php
require_once 'conn/functions/conn.php';
$link = $conn;


//实际
$u_name = $_SESSION['username'];

$content=$_POST['content'];
$create_at=time();
$u_name="qualsn";
$file = $_FILES['file'];  //得到传输的数据,以数组的形式
$name = $file['name'];      //得到文件名称，以数组的形式
$upload_path = "/images/picture/"; //上传文件的存放路径
echo $file;
print_r($file);
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
    $str .= ','.$upload_path.time().$name[$k];
  }else{
    echo 'failed';
  }
}

$query="insert into udata(u_name,content,picture,create_at)values('{$u_name}','{$content}','{$str}','{$create_at}')";
$res=mysqli_query($link,$query);
if($res){
  $response = array(
    'code'  => 200,
    'message' => 'success for request',
    'content'  => '发表成功！'
  );
  $back=json_encode($response,JSON_UNESCAPED_UNICODE);
  return $back;
}else{
  $response = array(
    'code'  => 110,
    'message' => 'fail for request',
    'content'  => '发表失败'
  );
  $back=json_encode($response,JSON_UNESCAPED_UNICODE);
  return $back;
}

