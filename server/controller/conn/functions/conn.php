<?php
$conn=mysqli_connect("localhost", "root", "root", "vp_db")or die("连接数据库失败！".mysqli_errno());
mysqli_query($conn, "set names utf8");
?>
