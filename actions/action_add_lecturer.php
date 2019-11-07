<?php 
  session_start();

  ///PATH TO FILE FROM BUCKET 
  $file = 'gs://cloud-a1-hau/lecturers.csv';

  //READING OLD DATA INTO ARRAY
  $old_data = file_get_contents('gs://cloud-a1-hau/lecturers.csv');

	//GETTING DATA FROM FORM
  $lecturer_id = $_POST['lecturer_id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];

  //DATA POST CONDITION != NULL - CHECK IF DATA IS AVAILABLE TO PERFORM ACTION
  if( $lecturer_id != '' &&
  $first_name!= '' &&
  $last_name != '' &&
  $gender != '' &&
  $age != '') {

  /// GET PAGE URL TO REDIRECT AFTER SUCCESSFULLY ADDED WITH LOGICAL CONDITIONS
  if(trim(file_get_contents($file)) == false) {
	  $page=0;
  } else {
    $counter = new SplFileObject($file, 'r');
    $counter->seek(PHP_INT_MAX);
    $total_lecturer = $counter->key()+1;
    $page = floor($total_lecturer / 10);
  }
   
  /// PREPARING DATA INTO ARRAY FOR ADDING
  $data = "{$lecturer_id},{$first_name},{$last_name},{$gender},{$age}";	
  /// CHECKING IF FILE IS EMPTY -> ADD NEW DATA. IF DATA EXIST, OVERWRITTEN WITH NEW LINE.
  if (trim(file_get_contents($file)) == false) {
	  file_put_contents($file,$data);
  } else {
    file_put_contents($file,$old_data.PHP_EOL.$data);
  }  
  
  /// REDIRECT TO PREVIOUS PAGE AFTER SUBMIT
  $url='./?p=lecturers_list&page='.$page;
  echo '<META HTTP-EQUIV=REFRESH CONTENT="0.1; '.$url.'">';
	} 
?>