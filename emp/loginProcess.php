<?php
/**
 * Created by PhpStorm.
 * User: zycct
 * Date: 17.4.15
 * Time: 9:58
 */
    //接收用户的数据
    //id
    $id=$_POST['adminId'];
    //mima
    $password=$_POST['password'];

    //简单验证（先不到数据库)
    /*if($id=="100"&&$password=="123"){
        //合法
        header("Location:empManage.php");
        //如果要跳转，则最好带上exit()
        exit();
    }else{
        //非法
        header("Location:login.php?error=1");
        exit();
    }*/

    //到数据库去验证.mysqli扩展库

    //链接数据库
    $conn=mysql_connect("localhost","root","root");
    if(!$conn){
        die("链接失败".mysql_error());
    }

    mysql_query("set names utf8",$conn) or die(mysql_error());

    //选择数据库
    mysql_select_db("test",$conn) or die(mysql_error());

    //放置sql注入攻击，变化验证逻辑
    $sql="select password,name from admin where id = $id";

    //1。通过输入的id来获取数据库的密码，然后再和输入的密码比对

    $res= mysql_query($sql,$conn);

    if($row=mysql_fetch_assoc($res)){

        //取出数据库密码
        if($row['password']==md5($password)){
            //说明合法
            //取出name
            $name=$row['name'];
            header("Location:empManage.php?name=$name");
            exit();
        }
    }
    header("Location:login.php?error=1");
    exit();

    mysql_free_result($res);
    mysql_close($conn);
