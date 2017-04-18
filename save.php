<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>LifeFLOW</title>
</head>
<body>

		<p>Save LifeFLOW tub! :)</p>
		
		<?php //echo $_POST['creaturez']; ?>
		
		<?php $creaturezmeta = 'creatures/creaturez-meta.svg'; //get meta info for creaturez svg
		$current = file_get_contents($creaturezmeta); // make $current contain the meta info
		$current .= $_POST['creaturez']; // add creaturez data from js to $current
		$current .= '</svg>'; // close creaturez svg
		$area = $_POST['area'];
//		echo "$area: ".$area."<br>";
//		echo "$current: ".$current."<br>";
		file_put_contents($area, $current); // creaturez-5.svg',
//		file_put_contents('creatures/avril3.svg', $current); // creaturez-5.svg',
//		<?php file_put_contents('creatures/'.$_GET['tub'].'.svg', $_GET['creaturez']); // creaturez-5.svg',
		//'blah'); // $_GET['creaturez'];); // running php locally w/o php breaks tub viewer
		?>

		<p>Save LifeFLOW tub 2!!!! :)</p>
		<?php //echo "test"; ?>
		
		<?php echo $_POST['creaturez']; ?>

</body>
</html>

