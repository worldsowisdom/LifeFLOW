<?php


		include 'index.php';

		//check URL for default area to load
		//if filexists w/ name "creatures/$(GET).svg" then set that as active_area...

		//set up the file path from the URL "area" parameter
		//e.g. "/index.php?area=eagle5" opens "creatures/eagle5.svg"
		$area = 'creatures/';
		$area .= $_GET['area'];
		$area .= '.svg';
			
		//check if $area exists, and if so set it as active_area
		if (file_exists($area)) {
			echo 'active_area = "'.$area.'";';
			echo 'var active_area2 = "'.$area.'";';
		}
		
?>
