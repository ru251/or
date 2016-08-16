<?php

	require("Database.class.php");
	define('DB_SERVER', "localhost");
	//define('DB_USER', "rxshop");
	//define('DB_PASS', "edcrfvtgb");
	define('DB_USER',"root");
	define('DB_PASS',"");
	define('DB_DATABASE', "rxshop");

	$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
	$db->connect();
	$end_time      = time();
	$start_time    = time()-86400;
	$sql         = "select user_name,user_id,parent_id from ecs_users where parent_id in (9968,8661,8660,8659,8658,8657,8655) and is_fenxiao=1";  //找大区下的员工
	$rows = $db->fetch_all_array($sql);


	foreach($rows as $record)
	{
	  	$temp[$record['user_id']] = $record;
	  	$sql1   =  "select user_name,user_id,parent_id from ecs_users where parent_id = {$record['user_id']}";  //员工的下级

	  	// 员工的订单
		// $query = "select * from ecs_order_info where user_id = {$record['user_id']} and is_separate =1";

		// echo $query."<br>";

	  	$r      =  $db->fetch_all_array($sql1);
	  	foreach($r as $values)
	  	{
	  		$temp[$record['user_id']]['xiaxian'][$values['user_id']]=$values;

	  		$sql2  = "select user_name,user_id,parent_id from ecs_users where parent_id = {$values['user_id']}";  //员工的下级的下级
	  		//员工的下级的订单
	  		$query = "select order_sn,user_id from ecs_order_info where user_id = {$values['user_id']} and is_separate =1";

	  		$or =$db->fetch_all_array($query);

		             // echo $query."<br>";

	  		$rr    = $db->fetch_all_array($sql2);

	  		foreach($rr as $vv)
	  		{
	  			$temp[$record['user_id']]['xiaxian'][$values['user_id']]['xiaxian'][$vv['user_id']]=$vv;
	  		}
	  	}
	}
 //              $sql12= "select  order_sn,user_id from ecs_order_info where  is_separate =1";



 //              $order=$db ->fetch_all_array($sql12);
	echo "<pre>";
	print_r($temp);
	echo "</pre>";
              // var_dump($temp);
	// echo "一级分销商：".count($temp)."<Br>";


	// $num = 0;
	// foreach($temp as $v)
	// {
	// 	if(isset($v['xiaxian']))
	// 	{
	// 		$num +=count($v['xiaxian']);
	// 	}
	// }

	// echo "二级分销商:".$num."<br>";
