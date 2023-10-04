<?php 
	session_start();
	include '../config.php';

	 $ret = [];

     if ($_POST['object_name'] == "Choose object") {
	 	$ret += ['xatolik'=>1,'xabar'=>'Choose object please!!!'];
	 }
	 else{
	 	 $object_name = trim($_POST['object_name']);
	 }

	 if ($_POST['room'] == "Choose flat") {
	 	$ret += ['xatolik'=>1,'xabar'=>'Choose room please!!!'];
	 }
	 else{
	 	$flat = trim($_POST['room']);
	 }

 	 $workers = $_POST['worker'];
	  
 	 $section = $_POST['section'];

	 if($_SESSION['globaldate']){
	 	$time = strtotime($_SESSION['globaldate']);
	 	echo $time;
	 }
	 else {
		$time = time();
	 }

	 $comment = trim($_POST['comment']);
	 
	 $master = "";

	foreach($workers as $worker){
		$master .= $worker.",";
	}

	$sections = "";

	foreach ($section as $key => $value) {
		$sections .= $value.",";
	}


	$old = mysqli_query($link,"SELECT * FROM extra_object WHERE flat = '$flat'");
	$exists = mysqli_fetch_assoc($old);


	if(!$exists){
		$sql = mysqli_query($link,"INSERT INTO extra_object(object_name,floor,flat,section,surface,workers,created_date,updated_date,comment)
		 	   VALUES('$object_name','','$flat','','$sections','$master','$time','','$comment')");

		 if($sql){
		 	$ret += ['xatolik'=>0, 'xabar'=>'Section added successfully!!!'];
		 }
		 else {
		 	$ret += ['xatolik'=>1,'xabar'=>'Something went wrong!!!'];
		 }

		 if ($status == "Finished") {
		 	 $update = mysqli_query($link,"UPDATE extra_object SET status = '$status' WHERE object_id = '$id' AND 
		 	 	section = '$section' AND status = 'In proccess'");
		 }
	}
	else {
		 $ret += ['xatolik'=>0, 'xabar'=>'Flat alraedy exists!!!'];
	}

	 echo json_encode($ret);
?>