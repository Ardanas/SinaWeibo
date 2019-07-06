<?php
require_once 'conn/functions/conn.php';
$link = $conn;

//$u_name = $_SESSION['username'];
$u_name = '黄金叶';
$content=$_POST['content'];
$create_at=time();
$spin=$_FILES['files'];
$destName="";
function upload_file($files, $path = "images/video/",$imagesExt=['jpg','png','jpeg','gif','mp4'])
{
  // 判断错误号
  if (@$files['error'] == 00) {
    // 判断文件类型
    //@$files['name']是路径，strtolower() 函数把字符串转换为小写。
    $ext = strtolower(pathinfo(@$files['name'],PATHINFO_EXTENSION));
    if (!in_array($ext,$imagesExt)){
      return "非法文件类型";
    }
    // 判断是否存在上传到的目录
    if (!is_dir($path)){
      mkdir($path,0777,true);
    }
    // 生成唯一的文件名
    global $destName;
    $fileName = md5(uniqid(microtime(true),true)).'.'.$ext;
    // 将文件名拼接到指定的目录下
    $destName = $path."/".$fileName;
    // 进行文件移动
    if (!move_uploaded_file($files['tmp_name'],$destName)){
      return "文件上传失败！";
    }
    return "文件上传成功！";
  } else {
    // 根据错误号返回提示信息
    switch (@$files['error']) {
      case 1:
        echo "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";
        break;
      case 2:
        echo "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
        break;
      case 3:
        echo "文件只有部分被上传";
        break;
      case 4:
        echo "没有文件被上传";
        break;
      case 6:
      case 7:
        echo "系统错误";
        break;
    }
  }
}
echo upload_file($spin);

$query="insert into udata(u_name,content,video,create_at)values('{$u_name}','{$content}','{$destName}','{$create_at}')";
$result=mysqli_query($link, $query);

if ($result){
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
