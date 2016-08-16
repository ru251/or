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


  $daquid = $_POST['fenxiao'];
	$sql1="select user_id from ecs_users where parent_id = {$daquid} and is_fenxiao=1";
	$r = $db->fetch_all_array($sql1);

	echo "一级会员数：".count($r);
	echo "<br>";
 // if ($r) {
 	# code...
	    foreach ($r as $value) {
       
			$sql2= "select user_id from ecs_users where parent_id = {$value['user_id']}";

      $rr = $db->fetch_all_array($sql2);



	                   }

      // $re['user_id'] = $r;

       echo "二级会员数：".count($rr);
       echo "<br>";

       foreach ($rr as  $value1) {
						$sql3 = "select user_id from ecs_users where parent_id = {$value1['user_id']}";

						$rrr=$db ->fetch_all_array($sql3);
                   }

					 echo "三级会员数：".count($rrr);
					 echo "<br>";

 // }
