<?php 
	session_start();
	require_once 'php/google-api-php-client/vendor/autoload.php';
?>

<div class="container mt-5">

	<table class="table table-striped table-hover">

		<div class="container">

        	<div class="table-wrapper">

            	<div class="table-title">
                    <div class="float-left">
						<h2><b>Lecturers</b> List With Frequency</h2>
					</div>
				</div>
			
				<thead class='text-center' >
					<tr>
                        <th>Number</th>	
				        <th>ID</th>
				        <th>First Name</th>
				        <th>Last Name</th>
				        <th>Gender</th>
				        <th>Age</th>
				        <th>Frequency</th>
					</tr>
				</thead>

				<tbody class='text-center'>
					<?php 
						///READ BUCKET STORAGE FILE DATA INTO ARRAY
                        $lines = file('gs://cloud-a1-hau/lecturers.csv',FILE_IGNORE_NEW_LINES);
						
						///INITIALIZING COMPOSER, GOOGLE SERVICES
            			$client = new Google_Client();
            			$client->useApplicationDefaultCredentials();
            			$client->addScope(Google_Service_Bigquery::BIGQUERY);
            			$bigquery = new Google_Service_Bigquery($client);
            			$projectId = 'cloud3594990';


						///REQUEST & ITEM LINE VARIABLES
                        $request = new Google_Service_Bigquery_QueryRequest();
            			$i = 0;
						$num = $i+1;
						
						///ITERATE THE ARRAY FROM GOOGLE BUCKET & BIG QUERY
            			foreach($lines as $line) {
                            $parts = explode(',',$line);
                            $id = $parts[0];
                            $first_name = $parts[1];
                            $last_name = $parts[2];
                            $gender = $parts[3];
                            $age = $parts[4];

							///STRING OPTIMIZATION TO DISPLAY THE RESULT
                            $upper_char = ucfirst(strtolower($first_name));

							///CREATE REQUEST FROM BIG QUERY TO DISPLAY INTO HTML TABLE
                            $request->setQuery("SELECT Frequency FROM [baby_names.baby_names] WHERE Name='$upper_char' LIMIT 1");
                            $response = $bigquery->jobs->query($projectId, $request);
                            $rows = $response->getRows();

							////GET THE ROW FIELD COMMENSURATE WITH THE LIST ITEM AND DISPLAY
                            foreach ($rows as $row)
                            {   foreach ($row['f'] as $field)
                                {
                                    $str= $field['v'];
                                }
                            }
                            echo '<tr>';
                            echo "<td>$num</td>";
                            echo 	"<td>$id</td>";
                            echo 	"<td>$first_name</td>";
                            echo 	"<td>$last_name</td>";
                            echo 	"<td>$gender</td>";
                            echo 	"<td>$age</td>";
                            echo 	"<td>$str</td>";
							echo '</tr>';
							
							///LINE NUM INCREMENT
                            $i++; 
                            $num++;
                        }
					?>
				</tbody>

			</div>

		</div>	

	</table>
	
</div>
   

	