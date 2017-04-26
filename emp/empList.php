<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=uft-8">
</head>
<title>雇员信息列表</title>


<?php
/**
 * Created by PhpStorm.
 * User: zycct
 * Date: 17.4.15
 * Time: 17:09
 */
    //显示所有用户的信息
    //查询数据库
    $conn=mysql_connect("localhost","root","root") or die(mysql_error());

    mysql_query("set names utf8");
    mysql_select_db("test",$conn);

    $pageSize=3;
    $rowCount=0;//这个额变量值，要从数据库的表获取
    $pageNow=1;//显示第几页，这是一个变量；
    //这是我们需要判断是否有这个pageNow发送，有就使用，没有就给默认值
    if(!empty($_GET['pageNow'])){
        $pageNow=$_GET['pageNow'];
    }
    $pageCount=0;//这个表示共有多少页
    //统计页面多少条
    $sqlCount="select count(id) from emp";
    $res1=mysql_query($sqlCount);

    if($row=mysql_fetch_row($res1)){
        $rowCount=$row[0];
    }
    //计算出共有多少页
    $pageCount=ceil($rowCount/$pageSize);



    $sql="select * from emp limit ".($pageNow-1)*$pageSize.",$pageSize";


    $res=mysql_query($sql,$conn);

    echo "<table width='700px' border='1'>";

    echo "<tr><th>id</th><th>name</th><th>grade</th><th>email</th><th>salary</th><th>删除用户</th><th>修改用户</th></tr>";
    //这里我们需要循环地显示用户的信息
    while($row=mysql_fetch_assoc($res)){

        echo "<tr><td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['grade']}</td><td>{$row['email']}</td><td>{$row['salary']}</td><td><a href='#'>修改用户</a></td><td><a href='#'>删除用户</a></td></tr>";

    }
    echo"<h1>雇员信息列表</h1>";
    echo"</table>";

    //打印出页面的超链接
    for($i=1;$i<=$pageCount;$i++){
        echo "<a href='empList.php?pageNow=$i'>$i</a>&nbsp;";
    }

    mysql_free_result($res);

    mysql_close($conn);

?>


</html>
