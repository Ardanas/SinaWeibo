<?php
require_once 'conn/functions/conn.php';
session_start();
$link = $conn;
$type = $_POST['type'];

if($_SESSION['username']&&$_POST['type']!=='all'){
    $query="select * from udata where  u_name='{$_POST['type']}'";
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
            "u_intro"=>$re['u_intro'],
            "u_city"=>$re['u_city'],
            "u_cover" => $re['u_cover']
        );
        array_push($result, $person);
    }
}else{

}