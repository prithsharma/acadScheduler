<?php
if(isset($_POST) and $_POST['submitForm'] == "Add" ){
	$instructor = "test instructor";
	$course = $_POST['course_num'];
	$timing = $_POST['timing'];
	$days = $_POST['days'];
	$n = count($days);

	echo $course . "on ". $timing. " days ";
	for($i=0; $i < $n; $i++){
		echo $days[$i]. " " ;
	}
	$con = new MongoClient();
	//	echo "Connection to database successfully";
		if($con){
		// Select Database
		$db = $con->acadSchedular;
		$student = [];
		// Select Collection
		$collection = $db->courses;
		$insert = array("instructor_name" => $instructor, "course_name" => $course, "timing" => $timing, "days" => $days, "	students" => $student);
		$collection	->insert($insert);
		echo "course created";

		$collection = $db->schedule;
		echo "schedule of instructor is updating";
		for($i=0 ; $i < count($days); $i++)
		{
		//	echo $a['days'][$i];
				$collection->update(array("name"=>$instructor), array('$push' => array($days[$i] => array($timing, $course))));
			//print_r($d);
		}
//			print_r($a);
		echo "       schedule of instructor has updated     ";

	/*$qry = array("user" => $usr_email,"password" => md5($usr_password));

	$result = $people->findOne($qry);
	if($result){
	$success = "You are successully loggedIn";
	// Rest of code up to you....
	}*/
	} else {
		echo "error";
	die("Mongo DB not installed");
	}

}


?>