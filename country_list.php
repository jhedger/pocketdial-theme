
<?php include_once("officialListOfCountries.php") ?>
<?php



	
	foreach($arrayOfCountries as $country) {
		
		$countryLink = str_replace(" ","-", $country);
		
		echo '<li><a href="/cheap-phone-calls-'.strtolower($countryLink).'/">'.$country.'</a></li>';
		
	}

?>

<li><a href="cheap-international-calls/">Other</a></li>

                        
