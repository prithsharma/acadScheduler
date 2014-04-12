<?php
if(isset($_POST) and $_POST['submitForm'] == "Add" ){
	$student_name = "rahul";
	$course = $_POST['course_num'];
	//echo $course;
	$con = new MongoClient();
	//	echo "Connection to database successfully";
		if($con){
		// Select Database
		$db = $con->acadSchedular;
		$student = [];
		// Select Collection
		
		$collection = $db->courses;
		$collection->update(array("course_name"=>$course), array('$push' => array("students" => $student_name )));
		echo "student added to list";
		$cursor = $collection->find(array("course_name"=>$course), array("_id" => 0, "timing" => 1, "days" => 1));
		if($a = $cursor->getNext()){
			//echo $a['timing'];
/*			print_r($a['days']);
			echo "size of array is ";
			echo count($a['days']);
			echo "first days is ";
			echo $a['days'][0];
			echo "second day is ";
			echo $a['days'][1];*/
			$collection = $db->schedule;

			for($i=0 ; $i < count($a['days']); $i++)
			{	echo "inserting for ";
				echo $a['days'][$i];
 				$collection->update(array("name"=>$student_name), array('$push' => array($a['days'][$i] => array($a['timing'], $course))));
				//print_r($d);
			}
			print_r($a);
		}

		/*echo $cursor['timing'];
		echo "is timing";
		echo $cursor['days'];
		echo "are days";*/

	echo "registered";
	}
}

?>