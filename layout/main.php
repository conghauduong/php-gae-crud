<?php

// STORE PARAMETER 'p' FROM QUERY STRING TO VARIABLES
if(isset($_GET['p'])) {
	$p = $_GET['p'];
} else {
	$p = 'lecturers_list';
}

include("views/$p.php");
include("actions/$p.php");
