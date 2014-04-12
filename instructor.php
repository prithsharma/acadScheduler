<?php
include('includes/dashboard.php');

// Configuration
/*$dbhost = 'localhost';
$dbname = 'test';

// Connect to test database
$m = new Mongo("mongodb://$dbhost");
$db = $m->$dbname;

// Get the users collection
$c_users = $db->users;*/
echo '
<form action="addcourse.php" method="POST">
Course Number:
<input type="text" id="course_num" name="course_num"  />
</br>
Timing
<select name="timing">
  <option value="8-9">8-9</option>	
  <option value="9-10">9-10</option>
  <option value="10-11">10-11</option>
  <option value="11-12">11-12</option>
</select>
</br>
<input type="checkbox" name="days[]" value="M">M
<input type="checkbox" name="days[]" value="T">T
<input type="checkbox" name="days[]" value="W">W
<input type="checkbox" name="days[]" value="Th">Th
<input type="checkbox" name="days[]" value="F">F
</br>
<input  name="submitForm" id="submitForm" type="submit" value="Add" />
</form>
';

echo '
<form action="extraclass.php" method="POST">
Course Number:
<input type="text" id="course_num" name="course_num"  />
<input type="text" id="course_num" name="date[]">DD</input>
<input type="text" id="course_num" name="date[]">MM</input>
<input type="text" id="course_num" name="date[]">YY</input>
Timing
<select name="timing">
  <option value="8-9">8-9</option>	
  <option value="9-10">9-10</option>
  <option value="10-11">10-11</option>
  <option value="11-12">11-12</option>
</select>
<input  name="submitForm" id="submitForm" type="submit" value="ExtraClass" />
</form>
';


?>