<?php
require_once 'conn/functions/conn.php';
$link = $conn;
session_start();

//获取用户数据
if ($_SESSION['username']) {
        $query3 = "select * from user where  u_name='{$_SESSION['username']}'";
        $select3 = mysqli_query($link, $query3);
        $showNum="select * from udata where u_name='{$_SESSION['username']}'";
        $resultNum =mysqli_query($link,$showNum);
        $resultNums = mysqli_num_rows($resultNum);
        $dataUser = array();
        while ($re3 = mysqli_fetch_array($select3)) {
            $person = array(
                "id" => $re3['u_id'],
                "u_name" => $re3['u_name'],
                "u_cover" => $re3['u_cover'],
                'fabulous'=> $re3['fabulous'],
                'collection'=> $re3['collection'],
                'showNum' =>$resultNums
            );
            array_push($dataUser, $person);
        }
}else {
        $person = array(
            'status' => 403,
            "message" => '请登录！',
            'username'=>'',
            'id'=>'',
            "sign" => '0',
            "datas" => []
        );
        array_push($dataUser, $person);
    }

//获取show数据
    $querys = "select user.u_cover,udata.u_name,udata.id,content,at_type,picture,video,udata.create_at from user,udata where udata.u_name=user.u_name order by udata.create_at desc;";
    $selects = mysqli_query($link, $querys);
    $dataArticle = array();
    while ($res = mysqli_fetch_array($selects)) {
        if ($res['picture']!==''){
        $pic = explode(',', $res['picture']);
        $time=date("m-d h:i",$res['create_at']);
            $content = array(
                'id' => $res['id'],
                'u_cover'=>$res['u_cover'],
                'at_type' => $res['at_type'],
                'u_name' => $res['u_name'],
                'content' => $res['content'],
                'picture'=>$pic,
                'video'=>$res['video'],
                'created_at' => $time
            );
            array_push($dataArticle, $content);
        }else{
            $time=date("m-d h:i",$res['create_at']);
            $content = array(
                'id' => $res['id'],
                'u_cover'=>$res['u_cover'],
                'at_type' => $res['at_type'],
                'u_name' => $res['u_name'],
                'content' => $res['content'],
                'picture'=>[],
                'video'=>$res['video'],
                'created_at' => $time
            );
            array_push($dataArticle, $content);
        }

    }
    $data2 = array(
        'mainMessage' => $dataArticle,
        'user' => $dataUser
    );
    $response = array(
        'status' => 200,
        'sign'=> 1,
        'message' => '请求数据成功！',
        'datas' => $data2
    );
    $back2 = json_encode($response, JSON_UNESCAPED_UNICODE);

//session判断
if (!isset($_SESSION['time'])){
    echo $back2;
}elseif ((time()-$_SESSION['time'])<3600) {
    $_SESSION['time'] = time();
    echo $back2;

}else{
    session_destroy();
    $dataUser3 = array();
    $person = array(
        'status' => 403,
        "message" => '请登录！',
        "sign" => '0',
        "datas" => []
    );
    array_push($dataUser3, $person);

    $data3 = array(
        'mainMessage' => $dataArticle,
        'user' => $dataUser3
    );
    $response = array(
        'status' => 403,
        'sign'=> 0,
        'message' => '请求数据失败！',
        'username'=>'',
        'id'=>'',
        'datas' => $data3
    );
    $back3 = json_encode($response, JSON_UNESCAPED_UNICODE);
    echo $back3;
}
    mysqli_close($link);
