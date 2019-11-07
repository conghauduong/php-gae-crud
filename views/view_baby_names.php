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
						<h2><b>Baby</b> Names</h2>
					</div>
				</div>
			
				<thead class='text-center' >
					<tr>
						<th>Name</th>	
						<th>Gender</th>
						<th>Frequency</th>
						<th>Year</th>
					</tr>
				</thead>

				<tbody class='text-center'>
					<?php 
						///INITIALIZING COMPOSER, GOOGLE SERVICES
            			$client = new Google_Client();
            			$client->useApplicationDefaultCredentials();
            			$client->addScope(Google_Service_Bigquery::BIGQUERY);
            			$bigquery = new Google_Service_Bigquery($client);
            			$projectId = 'cloud3594990';

						///CREATE NEW REQUEST TO GET TABLE QUERY & GET ALL ROWS ITEM FROM QUERY
            			$request = new Google_Service_Bigquery_QueryRequest();
            			$str = '';
            			$request->setQuery("SELECT * FROM [baby_names.baby_names] LIMIT 10");
            			$response = $bigquery->jobs->query($projectId, $request);
						$rows = $response->getRows();
			
						///ITERATE THE ARRAY FROM TABLE ROW RETRIEVE DATA AND DISPLAY INTO HTML TABLE
						foreach ($rows as $row)
						{	echo '<tr>';
							foreach ($row['f'] as $field)
							{
                   				$str= $field['v'];
                   				echo "<td>$str</td>";
							}
							echo '</tr>';
						}	
					?>
				</tbody>

			</div>

		</div>	

	</table>
	
</div>
   

	