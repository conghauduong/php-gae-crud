<?php 
//READING CURRENT DATA FROM FILE INTO ARRAY
$lines = file('gs://cloud-a1-hau/lecturers.csv',FILE_IGNORE_NEW_LINES);

// GET 'lineNum'FROM THE QUERY STRING
$lineNum = $_GET['lineNum'];
$band = explode(',',$lines[$_GET['lineNum']]);

///CREATING CUSTOM ACTION URL FOR EDIT SUBMIT ACTION
$currentUrl = "./?p=action_edit_lecturer&lineNum=";
$intentedUrl = $currentUrl.$lineNum;
?>

<form action="<?php echo $intentedUrl ?>"  method="post">

	<input type="hidden" name="linenum" value="<?php echo $_GET['lineNum'] ?>" />

	<div class="container rounded mt-5 pt-3 pb-3" style="border:1px solid black" >

  <div class="alert alert-success" role="alert">
    <h4 class="alert-heading">Edit lecturer information</h4>
  </div>  

	<div class="form-group">
    <label for="lecturer_id">Lecturer ID</label>
    <input type="number" step="1" maxlength="7" max="9999999" class="form-control" id="lecturer_id" name="lecturer_id" value="<?php echo $band[0] ?>" required="true">
	</div>

	<div class="form-group">
    <label for="first_name">First Name</label>
    <input required type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $band[1] ?>" required="true">
  </div>

  <div class="form-group">
    <label for="last_name">Last Name</label>
    <input required type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $band[2] ?>" required="true">
  </div>

  <div class="form-group">
    <label for="gender">Gender</label>
    <select class="form-control" id="gender" name="gender" required='true' >
		  <option value="" selected disabled hidden>Please select</option>
		    <option>M</option>
        <option>F</option>
    </select>
  </div>


  <div class="form-group">
    <label for="age">Age</label>
    <input required type="number" step="1" maxlength="3" max="120" class="form-control" id="age" name="age" value="<?php echo $band[4] ?>" required="true">
  </div>   

	<div class="form-actions">
		<button type="submit" class="btn btn-warning"><i class="icon-edit icon-white"></i>Edit</button>
		<a href="javascript:history.go(-1)" id="cancel" name="cancel" class="btn btn-secondary">Cancel</a>
	</div>

</form>
