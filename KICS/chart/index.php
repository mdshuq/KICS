<?php
$connect = new PDO('mysql:host=localhost;dbname=testing', 'root', '');
$query = "SELECT * FROM tbl_admission ORDER BY id ASC";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Make Chart from Table by using Ajax with PHP HighchartTable</title>
		<script src="jquery.min.js"></script>
		<link rel="stylesheet" href="bootstrap.min.css" />
		<link rel="stylesheet" href="jquery-ui.css">
		<script src="bootstrap.min.js"></script>
		<script src="jquery.highchartTable.js"></script>
		<script src="highcharts.js"></script>
		<script src="jquery-ui.js"></script>
	</head>
	<body>
		<br />
		<div class="container">
			<h3 align="center">Display HTML Table Data on Chart in PHP using HighChartTable Plugin</h3>
			<br />
			
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="for_chart">
					<thead>
						<tr>
							<th width="20%">Year</th>
							<th width="40%">No. of Student Admission</th>
							<th width="40%">No. of Student Passout</th>
						</tr>
					</thead>
					<?php
					foreach($result as $row)
					{
						echo '
						<tr>
							<td>'.$row["year"].'</td>
							<td>'.$row["no_of_admission"].'</td>
							<td>'.$row["no_of_passout"].'</td>
						</tr>
						';
					}
					?>
				</table>
			</div>
			<br />
			<div id="chart_area" title="Student Admission & Passout Details">
				
			</div>
			<br />
			<div align="center">
				<button type="button" name="view_chart" id="view_chart" class="btn btn-info btn-lg">View Data in Chart</button>
			</div>
			<br />
			<br />
		</div>
	</body>
</html>

<script>
$(document).ready(function(){
		
	$('#view_chart').click(function(){
		$('#for_chart').data('graph-container', '#chart_area');
		$('#for_chart').data('graph-type', 'column');
		$("#chart_area").dialog('open');
		$('#for_chart').highchartTable();
		
		$('#remove_chart').attr('disabled', false);
	});
	
	$('#remove_chart').click(function(){
		$('#chart_area').html('');
	});
	
	$("#chart_area").dialog({
		autoOpen:false,
		width: 1000,
		height:500
	});
});
</script>



