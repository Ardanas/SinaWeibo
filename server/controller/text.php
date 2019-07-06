<?php
header('Content-Type:application/json');//这个类型声明非常关键
session_start();
require_once 'conn/functions/conn.php';
$link = $conn;
//虚拟
$u_name=$_SESSION['username'];
$create_at=time();
$content=$_POST['content'];
$filePicture=$_FILES['filesPicture'];
$fileVideo =$_FILES['filesVideo'];
//var_dump($name);
$upload_path = "./images/picture/";


if ($filePicture){
    $name =$filePicture['name'];
    foreach ($name as $k=>$item){
      $type = strtolower(substr($item,strrpos($item,'.')+1));//得到文件类型，并且都转化成小写
      //move_uploaded_file()第一参数是file，第二参数是路径
      if (move_uploaded_file($filePicture['tmp_name'][$k],$upload_path.time().$name[$k])){
    //         array_push($str, $upload_path.time().$name[$k]);
        $str .= $upload_path.time().$name[$k].',';
      }else{
          $response = array(
              'code'  => 0,
              'status'=> 500,
              'message' => '图片保存失败！',
              'datas'  => []
          );
          $back=json_encode($response,JSON_UNESCAPED_UNICODE);
          echo $back;
      }
    }
    $at_type='图片';
}elseif ($fileVideo){
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
        }
    }
    echo upload_file($fileVideo);
    $at_type='视频';

}else{
    $at_type='文章';
}

if ($content){
    $query="insert into udata(u_name,content,picture,video,at_type,create_at)values('{$u_name}','{$content}','{$str}','{$destName}','{$at_type}','{$create_at}')";
    $res=mysqli_query($link,$query);
    if($res){
        $response = array(
            'sign'  => 1,
            'status'=> 200,
            'message' => '发表成功！',
            'datas'  => []
        );
        $back=json_encode($response,JSON_UNESCAPED_UNICODE);
        echo $back;
    }else{
        $response = array(
            'sign'  => 0,
            'status'=> 500,
            'message' => '发布失败！',
            'datas'  => []
        );
        $back=json_encode($response,JSON_UNESCAPED_UNICODE);
        echo $back;
    }
}else{
    $response = array(
        'sign'  => 0,
        'status'=> 400,
        'message' => '请输入数据！',
        'datas'  => []
    );
    $back=json_encode($response,JSON_UNESCAPED_UNICODE);
    echo $back;
}
