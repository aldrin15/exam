<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Robo Simulator</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="<?php echo base_url('assets/css/normalize.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css')?>">
</head>
<body>
<div class="robot-movement">
	<form action="" method="POST">
		<?php echo validation_errors(); ?>
		<ul>
			<li>
				<small><strong>PLACE X,Y,F</strong></small><br />
				<label>Enter Robot Location:</label>
				<input type="text" name="position" value="" />
			</li>
			<li>
				<small><strong>Example movement: Move / Left / Right</strong></small><br />
				<label>Enter Robot Movement:</label>
				<input type="text" name="movement" value="" />
			</li>
			<li><input type="submit" name="submit" value="Submit"/></li>
		</ul>
	</form>
</div>
<div class="table">
	<h3>North</h3>
	<h3 class="direction-west">West</h3>
	<h3 class="direction-east">East</h3>
	<?php
	for($x=4;$x>= -0;$x--):
		echo '<div class="unitsX">0,'.$x.'</div> ';
		for ($y=1;$y < 5;$y++):
			echo '<div class="unitsY">'.$y.','.$x.'</div>';
		endfor;
		echo '<div class="clearfix"></div>';
	endfor;
	?>
	<h3>South</h3>
</div>
<div class="output">
<?php 
if($output !== NULL):
	echo $output;
endif;
if($validation !== NULL):
	echo $validation;
endif;
?>
</div>
</body>
</html>