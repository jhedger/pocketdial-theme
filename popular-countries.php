<?php include_once("rateObject.php") ?>

<?php 

//Find the filename for each client by finding their ID in the filename 
$filename = "xml/justdial-landline.xml";

//If the file above exists then do the following code 
if (file_exists($filename)){

//load that xml file
$xml = simplexml_load_file($filename);

$printValue = '';

$ratesList = new ArrayObject();

$fullRatesList = new ArrayObject();

$previousDestination = "";
$previousFirstLetter = "";

// set the tablerow tag inside the group tag of the xml to the variable $row and for each then for each tablerow tag the following code will be executed 
foreach ($xml->Access_Dest_Rates_Comm as $row) {

// the keyword is found in the name tag and set to the variable $word 
$destination = $row->Destination; 

// the current position is found in the position tag in the tablecell tag. It is set to the variable $position 
$access = $row->Access_Number; 
// the position at the beginning of the month is found in the previous tag in the tablecell tag. It is set to the variable $previous 
$rate = $row->Rate;


$firstLetter = substr($destination, 0, 1); 

if ($firstLetter != $previousFirstLetter){
	if ($previousFirstLetter != ''){

		//SORT TO GET MOST EXPENSIVE RATE
		$mostExpensiveRate = new rate();
		
		foreach($ratesList as $rate) {
			if ($mostExpensiveRate->getRate() < $rate->getRate() ){
				$mostExpensiveRate = $rate;
			}
		}		
		
		if ($mostExpensiveRate->getDestination() != ''){
			//ADD MOST EXPENSIVE RATE
			$fullRatesList->append($mostExpensiveRate);
		}
		
		//CLEAR DOWN COUNTRIES PRINTED
		$ratesList = new ArrayObject();		

		
	}
	
	
}

$rateFormatted = number_format(floatval($rate), 1);
$rateFormatted = $rateFormatted.'';
$rateFormatted = str_replace(".0", "", $rateFormatted);

$access = str_replace(" ", "", $access);
$a = substr($access,0,4);
$b = substr($access,4,3);
$c = substr($access,7,4);
$accessFormatted = $a.' '.$b.' '.$c;

if ($previousDestination != $destination.''){

	//SORT TO GET BEST RATE
	$mostExpensiveRate = new rate();
	
	foreach($ratesList as $rate) {
		if ($mostExpensiveRate->getRate() < $rate->getRate() ){
			$mostExpensiveRate = $rate;
		}	
	
	}

	if ($mostExpensiveRate->getDestination() != ''){
		//ADD MOST EXPENSIVE RATE
		$fullRatesList->append($mostExpensiveRate);
	}
	
	
	//CLEAR DOWN COUNTRIES PRINTED
	$ratesList = new ArrayObject();
	
	//ADD NEXT COUNTRY RATE
	$rate = new rate();
	$rate->setDestination($destination);
	$rate->setAccessNumber($accessFormatted);
	$rate->setRate($rateFormatted);
	
	$ratesList->append($rate);	
	
	

	
}else{

	//ADD NEXT COUNTRY RATE
	$rate = new rate();
	$rate->setDestination($destination);
	$rate->setAccessNumber($accessFormatted);
	$rate->setRate($rateFormatted);

	$ratesList->append($rate);
	
	
	
}


$previousDestination = $destination;
$previousFirstLetter = $firstLetter;

}



}else{

echo 'Does Not Exist';

}


$arrayOfPopularCountries = array("India", "Philippines", "Brazil", "Australia", "Saudi Arabia", "Pakistan", "Poland", "USA");
for ($i = 0; $i <= count($arrayOfPopularCountries); $i++) {
		
	foreach($fullRatesList as $rate) {
		
		
		$destination = $rate->getDestination();
		$destination = str_replace(" (Landline)","", $destination);
		
		if ($arrayOfPopularCountries[$i] == $destination){

			$destination = str_replace(" ","-", $destination);
			
			echo '<li itemscope itemtype="http://schema.org/Product"><span class="off-screen" itemprop="name">Cheap calls to '.$destination.'</span><a itemprop="offers" itemscope itemtype="http://schema.org/Offer" href="/cheap-phone-calls-'.strtolower($destination).'/"><img itemprop="image" src="/images/flags/'.strtolower($destination).'.jpg" alt="Cheap calls to '.$destination.'"/>Call '.$destination.' <br/><span class="charge" itemprop="price">'.$rate->getRate().'p</span> per minute</a></li>';
		}
	}
}


echo $printValue;

?>			
			


