<?php
	include('config.php');

	require __DIR__ . '/SourceQuery/SourceQuery.class.php';

	$Timer = MicroTime( true );
	
	//foreach($servers as &$s){
	for ($i = 0; $i < count($servers); $i++) {
		$Query = new SourceQuery( );
		$Query->Connect( $servers[$i]['ip'], $servers[$i]['port'], 1, SourceQuery :: SOURCE );
		$servers[$i]['info'] = $Query->GetInfo( );
		$Query->Disconnect( );
	}
	
	$Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Source-Web</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<style type="text/css">
		.jumbotron {
			margin-top: 30px;
			border-radius: 0;
		}
		.table td {
		   text-align: center;   
		}
		.table th {
		   text-align: center;   
		}
	</style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="container">
	    <div class="jumbotron">
	    	<h1>Source Game Servers</h1>
	    </div>

		<table class="table table-striped">
			<thead>
			  <tr>
			    <th>Server Link</th>
			    <th>Map</th>
			    <th>Players</th>
			    <th></th>
			  </tr>
			</thead>
			<tbody>
<?php foreach($servers as $s): ?>

			  <tr>
			    <td> 
			    	<a href="steam://connect/<?php echo $s['ip']; echo ":"; echo $s['port']; ?>"><?php echo $s['info']['HostName']; ?></a>
			    </td>
 				<td> 
			    	<?php echo $s['info']['Map']; ?>
			    </td>
				<td> 
			    	<?php echo $s['info']['Players']; echo "/"; echo $s['info']['MaxPlayers']; ?>
			    </td>
				<td> 
					<a class="btn btn-sm btn-primary" type="button" href="view.php<?php echo "?ip="; echo $s['ip']; echo "&port="; echo $s['port'];?>">Details</a>
			    </td>
			  </tr>

<?php endforeach; ?>
			</tbody>
		</table>
	
	</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script>
		$(function () {
		    $(document).ready(function () {
		        //refresh 60 s
		        setTimeout(function () { 
		            location.reload();
		        }, 60 * 1000);

		   });
		});
	</script>
  </body>
</html>
