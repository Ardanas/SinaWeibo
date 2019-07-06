<?php
require_once 'conn/functions/conn.php';
$link = $conn;
session_start();
$type =$_POST['type'];
$query ="select user.u_cover,udata.u_name,udata.id,content,at_type,picture,video,udata.create_at from user,udata where udata.u_name=user.u_name and at_type='{$type}' order by udata.create_at desc;";
$result =mysqli_query($link,$query);
$dataMes = array();
while ($res=mysqli_fetch_array($result)){
    $pic = explode(',', $res['picture']);
    $time=date("m-d h:i",$res['create_at']);
    $message = array(
        'id' => $res['id'],
        'u_cover'=>$res['u_cover'],
        'u_name' => $res['u_name'],
        'content' => $res['content'],
        'picture'=>$pic,
        'video'=>$res['video'],
        'at_type' => $res['at_type'],
        'created_at' => $time
    );
    array_push($dataMes, $message);
}
if ($result){
    $response = array(
        'status' => 200,
        'sign'=> 1,
        'message' => '请求数据成功！',
        'datas' => $dataMes
    );
    $back = json_encode($response, JSON_UNESCAPED_UNICODE);
    echo $back;
}else{
    $response = array(
        'status' => 500,
        'sign'=> 0,
        'message' => '请求数据失败！',
        'datas' => []
    );
    $back = json_encode($response, JSON_UNESCAPED_UNICODE);
    echo $back;
}
