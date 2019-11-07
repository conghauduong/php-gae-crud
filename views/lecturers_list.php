<div class="container mt-5">

	<table class="table table-striped table-hover">

	<div class="container">

        <div class="table-wrapper">
            <div class="table-title">
                    <div class="float-left">
						<h2><b>Lecturer</b> Details</h2>
					</div>

					<div class= "float-right ">
						<a href="https://storage.cloud.google.com/cloud-a1-hau/lecturers.csv" class="btn btn-info"></i> <span>Export CSV</span></a>
						<a href="./?p=form_add_lecturer" class="btn btn-success"></i> <span>Add New Lecturer</span></a>
					</div>
            </div>

		<thead class='text-center'>
			<tr>
				<th>Number</th>	
				<th>ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Gender</th>
				<th>Age</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody class='text-center'>
			<?php 

			///PATH TO FILE FROM BUCKET 
			$file = 'gs://cloud-a1-hau/lecturers.csv';

			///READING CURRENT DATA FROM FILE
			$lines = file('gs://cloud-a1-hau/lecturers.csv',FILE_IGNORE_NEW_LINES);
			
			///PAGE VARIABLES FOR PAGINATION
			$first_page = 0;
			///CURRENT PAGE
			$get_page = 0 + $_GET['page'];
			///NEXT PAGE
			$next_page = $get_page+1;
			///PREVIOUS PAGE
			if ($get_page>0){
				$prev_page = $get_page-1;
			} else {
				$prev_page = 0;
			}

			///GET CURRENT NUMBER OF LECTURERS FROM FILE
			$counter = new SplFileObject($file, 'r');
    		$counter->seek(PHP_INT_MAX);
			$total_lecturer = $counter->key()+1;
			///LOGICAL CONDITIONS FOR LAST PAGE
			if ($total_lecturer/10 - floor($total_lecturer/10) > 0) {
				$last_page = floor($total_lecturer / 10);
			} else {
				$last_page = floor($total_lecturer / 10) - 1;
			}
			 
			///CREATING PAGE URL TO REDIRECT FOR PAGINATION
			$currentUrl = "./?p=lecturers_list&page=";
			$nextUrl = $currentUrl.$next_page;
			$prevUrl = $currentUrl.$prev_page;

			// COUNTER VARIABLES FOR LINE NUMBER
			$num = $get_page*10 + 1;
			$i = $get_page*10;
			$arr = array_slice($lines,$i,10);
			
			//ITERATING LINES ARRAY
			foreach($arr as $line) {
				$parts = explode(',',$line);
				$id = $parts[0];
				$first_name = $parts[1];
				$last_name = $parts[2];
				$gender = $parts[3];
				$age = $parts[4];
				echo '<tr>';
				echo "<td>$num</td>";
				echo 	"<td>$id</td>";
				echo 	"<td>$first_name</td>";
				echo 	"<td>$last_name</td>";
				echo 	"<td>$gender</td>";
				echo 	"<td>$age</td>";
				echo 	"<td>
				<a class=\"btn btn-warning\" href=\"./?p=form_edit_lecturer&lineNum=$i\">Edit</a> 
				<a class=\"btn btn-danger\" href=\"./?p=action_delete_lecturer&lineNum=$i\">Delete</a>
				</td>";
				echo '</tr>';

				// LINE NUM INCREMENT
				$i++; 
				$num++;
				$page++;
			}

			?>
		</tbody>

	</table>
	



	<div class="clearfix">

		<?php if($total_lecturer ==1) { ?> 
			<div class="hint-text">Showing <b><?php echo $total_lecturer ?></b> entry</div>
		<?php } ?> 
		<?php if( $total_lecturer > 1 && $total_lecturer < 10 ) { ?> 
			<div class="hint-text">Showing <b><?php echo $total_lecturer ?></b> entries</div>
		<?php } ?> 
		<?php if($total_lecturer >= 10) { ?> 
			<div class="hint-text">Showing <b>10</b> out of <b><?php echo $total_lecturer ?></b> entries</div>
		<?php } ?> 
                
		<ul class="pagination d-flex justify-content-center">

            <?php if($get_page == $first_page && $total_lecturer < 10 || $total_lecturer == 10 ) { ?>
				<li class="page-item text-center disabled" style="width:80px"><a href="<?php echo $prevUrl ?>" class="page-link">Previous</a></li>
                <li class="page-item text-center active " style="width:40px"><a href="./?p=lecturers_list&page=0" class="page-link">1</a></li>
                <li class="page-item text-center disabled" style="width:80px"><a href="<?php echo $nextUrl ?>" class="page-link">Next</a></li>
			<?php } ?> 

			<?php if($get_page == $first_page && $total_lecturer > 10) { ?>
				<li class="page-item text-center disabled" style="width:80px"><a href="<?php echo $prevUrl ?>" class="page-link">Previous</a></li>
                <li class="page-item text-center active " style="width:40px"><a href="./?p=lecturers_list&page=0" class="page-link">1</a></li>
                <li class="page-item text-center" style="width:40px"><a href="./?p=lecturers_list&page=1" class="page-link">2</a></li>
                <li class="page-item text-center" style="width:80px"><a href="<?php echo $nextUrl ?>" class="page-link">Next</a></li>
			<?php } ?> 

			<?php if($get_page != $first_page && $get_page < $last_page) { ?>
				<li class="page-item text-center " style="width:80px"><a href="<?php echo $prevUrl ?>" class="page-link">Previous</a></li>
                <li class="page-item text-center " style="width:40px"><a href="./?p=lecturers_list&page=<?php echo $prev_page ?>" class="page-link"><?php echo $get_page ?></a></li>
                <li class="page-item text-center active " style="width:40px"><a href="./?p=lecturers_list&page=<?php echo $get_page ?>" class="page-link"><?php echo $next_page ?></a></li>
                <li class="page-item text-center" style="width:80px"><a href="<?php echo $nextUrl ?>" class="page-link">Next</a></li>
			<?php } ?> 	

			<?php if($get_page == $last_page && $total_lecturer > 10) { ?>
				<li class="page-item text-center " style="width:80px"><a href="<?php echo $prevUrl ?>" class="page-link">Previous</a></li>
                <li class="page-item text-center " style="width:40px"><a href="./?p=lecturers_list&page=<?php echo $prev_page ?>" class="page-link"><?php echo $get_page ?></a></li>
                <li class="page-item text-center active " style="width:40px"><a href="./?p=lecturers_list&page=<?php echo $get_page ?>" class="page-link"><?php echo $next_page ?></a></li>
                <li class="page-item text-center disabled" style="width:80px"><a href="<?php echo $nextUrl ?>" class="page-link">Next</a></li>
			<?php } ?> 	

		</ul>
	
	</div>

</div>


	