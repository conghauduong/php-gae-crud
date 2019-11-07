<?php
    session_start();
    ///PATH TO FILE FROM BUCKET 
    $file = 'gs://cloud-a1-hau/lecturers.csv';
    //READING CURRENT DATA FROM FILE
    $lines = file('gs://cloud-a1-hau/lecturers.csv', FILE_IGNORE_NEW_LINES);
    $lineNum = $_GET['lineNum'];

    /// GET PAGE URL TO REDIRECT AFTER SUCCESSFULLY EDITED LECTURER 
    $page = floor($lineNum / 10);

    //GETTING DATA FROM FORM
    $lecturer_id = $_POST['lecturer_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];

    /// PREPARING FORM INPUT INTO ARRAY FOR SUBMITTING
    $data = "{$lecturer_id},{$first_name},{$last_name},{$gender},{$age}";	

    ///EDIT DATA
    // REPLACE LINE WITH NEW VALUE
    $lines[$lineNum] = $data;
    // CREATE STRING TO WRITE NEW DATA
    $new_data = implode("\n",$lines);
    // OVERWRITING CURRENT DATA
    file_put_contents($file,$new_data);

    /// REDIRECT TO PREVIOUS PAGE AFTER SUBMIT
    $url='./?p=lecturers_list&page='.$page;
    echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$url.'">';
?>