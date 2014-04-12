<?php
// Configuration
$dbhost = 'localhost';
$dbname = 'scheduler';

// Connect to test database
$m = new Mongo("mongodb://$dbhost");
$db = $m->$dbname;

// Get the users collection
$regular = $db->regular;

date_default_timezone_set('Asia/Calcutta');
$sch = $regular->findOne();
$dateToday = getdate();
$dayToday = $dateToday['wday'];

//var_dump($sch);
$eventSource = array();
foreach ($sch as $key => $value) {
	if($key != '_id')
	{
	/*var_dump($value);
	echo '<br>';*/
	foreach ($value as $course => $slot) {
		//$start = $slot.explode('-')[0];
		//$end = $slot.explode('-')[1];
		/*var_dump($key);
		echo '--';
		var_dump($course);
		echo '-----';
		echo $slot;
		echo '<br>';*/
		
		$slot = intval($slot);
		//echo $slot."<br>";
		$eventDate = date("d")-( $dayToday-date('N', strtotime($key)) );
		//echo $eventDate."<br>";
		$startDate = mktime($slot, 0, 0, date("m")  ,$eventDate , date("Y"));
		$startDate = date("Y-m-d\TH:i:sO",$startDate);
		//echo $startDate."<br>";
		$endDate = mktime($slot+1, 0, 0, date("m")  ,$eventDate , date("Y"));
		$endDate = date("Y-m-d\TH:i:sO",$endDate);
		//echo "startDate: ".$startDate."<br>"."endDate: ".$endDate."<br><br>";
		$eventSource[] = array(
			'title' => $course,
			'start' => $startDate,
			'end' => $endDate,
			'allDay' => false
		);
	}
	}
}
//var_dump($eventSource);
//$eventSource = json_encode($eventSource);
//print_r($eventSource);
//echo json_encode($eventSource);
echo '
[{"title":"CS335","start":"2014-04-07T08:00:00+0530","end":"2014-04-07T09:00:00+0530","allDay":false},{"title":"CS345","start":"2014-04-07T09:00:00+0530","end":"2014-04-07T10:00:00+0530","allDay":false},{"title":"PHI422","start":"2014-04-07T11:00:00+0530","end":"2014-04-07T12:00:00+0530","allDay":false},{"title":"CS315","start":"2014-04-08T16:00:00+0530","end":"2014-04-08T17:00:00+0530","allDay":false},{"title":"COMM","start":"2014-04-08T17:00:00+0530","end":"2014-04-08T18:00:00+0530","allDay":false},{"title":"CS335","start":"2014-04-09T08:00:00+0530","end":"2014-04-09T09:00:00+0530","allDay":false},{"title":"CS345","start":"2014-04-09T09:00:00+0530","end":"2014-04-09T10:00:00+0530","allDay":false},{"title":"PHI422","start":"2014-04-10T10:00:00+0530","end":"2014-04-10T11:00:00+0530","allDay":false},{"title":"MBA630","start":"2014-04-10T15:00:00+0530","end":"2014-04-10T16:00:00+0530","allDay":false},{"title":"CS315","start":"2014-04-11T15:00:00+0530","end":"2014-04-11T16:00:00+0530","allDay":false},{"title":"MBA630","start":"2014-04-11T17:00:00+0530","end":"2014-04-11T18:00:00+0530","allDay":false},
{"title":"CS335 - Extra Class","start":"2014-04-08T10:00:00+0530","end":"2014-04-08T11:00:00+0530","color": "green", "allDay":false},{"title":"CS315 - Extra Class","start":"2014-04-09T15:00:00+0530","end":"2014-04-09T16:00:00+0530","color": "green", "allDay":false},{"title":"Meeting with Dentist","start":"2014-04-09T17:00:00+0530","end":"2014-04-09T18:00:00+0530","color": "#54E3C9", "allDay":false},{"title":"Project Discussion","start":"2014-04-09T13:00:00+0530","end":"2014-04-09T14:00:00+0530","color": "#54E3C9", "allDay":false}
]
';
?>