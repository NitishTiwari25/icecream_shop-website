<?php
session_start();

$con=mysqli_connect("localhost","root","","icecream_db");
if(!$con){
    echo "No connection";
}
// mysqli_select_db($con,"onlinevotingsystem");


function unique_id(){
    $chars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength=strlen($chars);
    $randomString='';
    for($i=0;$i<20;$i++){
        $randomString.=$chars[mt_rand(0,$charLength - 1)];
    }
    return $randomString;
}
?>