<?php
session_start();
$quit=session_destroy();
if ($quit){
    $response = array(
        'status'  => 200,
        'sign'=>'1',
        'message' => 't退出成功！',
        'datas'=>[]
    );
    $back=json_encode($response,JSON_UNESCAPED_UNICODE);
    echo $back;
}
