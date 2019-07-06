<?php
require_once 'conn/functions/conn.php';
session_start();
$link = $conn;
if($_SESSION['username']){
  //个人信息
  $query="select * from user where  u_name='{$_SESSION['username']}'";
  $select=mysqli_query($link, $query);
  $result=array();
  while ($re=mysqli_fetch_array($select)){
    $person=array(
      "id" => $re['u_id'],
      "u_name" => $re['u_name'],
      "u_sex" => $re['u_sex'],
      "u_age" => $re['u_age'],
      "u_phone" => $re['u_phone'],
      "u_email" => $re['u_email'],
      "u_motto" => $re['u_motto'],
      'u_birth'=>$re['u_birth'],
      "u_intro"=>$re['u_intro'],
      "u_city"=>$re['u_city'],
      "u_cover" => $re['u_cover']
    );
    array_push($result, $person);
  }

  //个人已发表内容
  $query1="select user.u_cover,udata.u_name,udata.id,content,at_type,picture,video,udata.create_at from user,udata where udata.u_name=user.u_name and user.u_name='{$_SESSION['username']}' order by udata.create_at desc;";
  $select1=mysqli_query($link, $query1);
  $result1=array();

  while ($re1=mysqli_fetch_array($select1)){
      if ($re1['picture']!=='') {
          $pic = explode(',', $re1['picture']);
          $time = date("m-d h:i", $re1['create_at']);
          $pic = array(
              "id" => $re1['id'],
              "u_name" => $re1['u_name'],
              "at_type" => $re1['at_type'],
              "created_at" => $time,
              "content" => $re1['content'],
              "picture" => $pic,
              "video" => $re1['video'],
              "u_cover" => $re1['u_cover']

          );
          array_push($result1, $pic);
      }else{
          $time = date("m-d h:i", $re1['create_at']);
          $pic = array(
              "id" => $re1['id'],
              "u_name" => $re1['u_name'],
              "at_type" => $re1['at_type'],
              "created_at" => $time,
              "content" => $re1['content'],
              "picture" =>[],
              "video" => $re1['video'],
              "u_cover" => $re1['u_cover']

          );
          array_push($result1, $pic);
      }
  }

  $data=array(
      'personMessage' =>$result,
      'personPublish' => $result1
  );
  $response = array(
      'status'  => 200,
      'sign'=>'1',
      'message' => '请求成功！',
      'datas'=>$data
  );
  $back=json_encode($response,JSON_UNESCAPED_UNICODE);
  if($select){
      echo $back;
  }
}else{
  $response = array(
      'status'  => 500,
      'sign'=>'0',
      'message' => '还未登录，请登录！',
      'datas'=>[]
  );
  $back=json_encode($response,JSON_UNESCAPED_UNICODE);
  echo $back;
}
