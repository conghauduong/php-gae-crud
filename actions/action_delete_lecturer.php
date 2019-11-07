<?php
  session_start();
  ///PATH TO FILE FROM BUCKET 
  $file = 'gs://cloud-a1-hau/lecturers.csv';
  //READING CURRENT DATA FROM FILE
  $lines = file('gs://cloud-a1-hau/lecturers.csv', FILE_IGNORE_NEW_LINES);

  ///GETTING ITEM NUMBER FOR DELETE ACTION
  $lineNum = $_GET['lineNum'];

  /// GET PAGE URL TO REDIRECT AFTER SUCCESSFULLY DELETED LECTURER 
  /// GETTING THE NUMBER OF LECTURERS IN FILE
  $counter = new SplFileObject($file, 'r');
  $counter->seek(PHP_INT_MAX);
  $total_lecturer = $counter->key()+1;
  /// IMPLEMENTING CONDITIONS TO GET THE RIGHT URL
  $page = floor($lineNum/10);
  if ($total_lecturer - 1 == $lineNum && $lineNum/10 - floor($lineNum/10) == 0 && $lineNum!= 0) {
    $page = floor($lineNum/10)-1;
  } elseif ($lineNum==0) {
    $page = 0;
  } else {
    $page = floor($lineNum/10);
  }

  /// DELETE ACTION  
  ///REMOVE THE SELECTED LECTURER FROM LIST
  unset($lines[$lineNum]);
  ///PREPARING NEW DATA FOR OVERWRITING TO FILE
  $new_data = implode("\n",$lines);
  file_put_contents($file,$new_data);

  /// REDIRECT TO PREVIOUS PAGE AFTER SUBMIT
  $url='./?p=lecturers_list&page='.$page;
  echo '<META HTTP-EQUIV=REFRESH CONTENT="0.1; '.$url.'">';
?>
