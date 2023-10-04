<?php 
	session_start();

	$ret = [];		

	if($_POST['id'] == 1){
		$ret += ['xatolik'=> 0,'xabar'=>'Global date unset Successfully!!!'];
		unset($_SESSION['globaldate']);

	}

	echo json_encode($ret);

?>