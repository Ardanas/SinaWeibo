<?php
require_once 'conn/functions/conn.php';
session_start();
$link = $conn;
$name=$_SESSION['username'];
$query = "select picture from udata where u_name='{$name}'order by create_at desc";
$result = mysqli_query($link,$query);
$data = array();
$mothOrder = array();
while ($res = mysqli_fetch_array($result)){
    if ($res['picture']!==''){
        $pic = explode(',', $res['picture']);
        $time=date("m",$res['create_at']);

        if ($time=='01') {
            array_push($mothOrder,$pic);
            $per1 = array(
                '1月' => $mothOrder,
            );

        }
        if ($time=='02') {
            array_push($mothOrder,$pic);
            $per2 = array(
                '2月' => $mothOrder,
            );

        }

    }

}
array_push($data, $per1);
array_push($data, $per2);


$response = array(
    'status' => 200,
    'sign'=> 1,
    'message' => '请求数据成功！',
    'datas' => $data
);
$back = json_encode($response, JSON_UNESCAPED_UNICODE);
echo $back;