<?php include_once("officialListOfCountries.php") ?>
<?php
/*
Template Name: Calling From A Landline
*/
?>
<?php include_once("rateObject.php") ?>

<?php get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php //comments_template( '', false ); ?>

				<?php endwhile; // end of the loop. ?>

	
    
 
          <div id="country-alphabet-nav" class="listNav">
            <a class="activeCountry" href="javascript:changeCountryStartsWith('A')">A</a>
			<a href="javascript:changeCountryStartsWith('B')">B</a>
			<a href="javascript:changeCountryStartsWith('C')">C</a>
			<a href="javascript:changeCountryStartsWith('D')">D</a>
			<a href="javascript:changeCountryStartsWith('E')">E</a>
			<a href="javascript:changeCountryStartsWith('F')">F</a>
			<a href="javascript:changeCountryStartsWith('G')">G</a>
			<a href="javascript:changeCountryStartsWith('H')">H</a>
			<a href="javascript:changeCountryStartsWith('I')">I</a>
			<a href="javascript:changeCountryStartsWith('J')">J</a>
			<a href="javascript:changeCountryStartsWith('K')">K</a>
			<a href="javascript:changeCountryStartsWith('L')">L</a>
			<a href="javascript:changeCountryStartsWith('M')">M</a>
			<a href="javascript:changeCountryStartsWith('N')">N</a>
			<a href="javascript:changeCountryStartsWith('O')">O</a>
			<a href="javascript:changeCountryStartsWith('P')">P</a>
			<a href="javascript:changeCountryStartsWith('Q')">Q</a>
			<a href="javascript:changeCountryStartsWith('R')">R</a>
			<a href="javascript:changeCountryStartsWith('S')">S</a>
			<a href="javascript:changeCountryStartsWith('T')">T</a>
			<a href="javascript:changeCountryStartsWith('U')">U</a>
			<a href="javascript:changeCountryStartsWith('V')">V</a>
			<a href="javascript:changeCountryStartsWith('W')">W</a>
			<a href="javascript:changeCountryStartsWith('X')">X</a>
			<a href="javascript:changeCountryStartsWith('Y')">Y</a>
			<a href="javascript:changeCountryStartsWith('Z')">Z</a>
            </div>
            <div class="setHeight group">
         <div id="destinationTitles" class="group"><div class="destination">Country</div><div class="rate">Rate</div><div class="access_number">Access Number</div></div>
		 <div id="noCountriesFound" style="display:none">No countries found.</div>
    <?php 

//Find the filename for each client by finding their ID in the filename 
$filename = "xml/justdial-landline.xml";

//If the file above exists then do the following code 
if (file_exists($filename)){

//load that xml file
$xml = simplexml_load_file($filename);

$printValue = '';

$ratesList = new ArrayObject();



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
			//PRINT MOST EXPENSIVE RATE
			
			$mostExpensiveRate->setDestination(str_replace("Bosnia & Herz.","Bosnia and Herzegovina", $mostExpensiveRate->getDestination()));
			
			
			$destOnly = str_replace(" Mobile  Orange","", $mostExpensiveRate->getDestination());
			$destOnly = str_replace(" Mobile  T-Mobile","", $destOnly);
			$destOnly = str_replace(" Mobile  O2","", $destOnly);
			$destOnly = str_replace(" Mobile  Vodafone","", $destOnly);
			$destOnly = str_replace(" National","", $destOnly);				
			$destOnly = str_replace(" (Landline)","", $destOnly);
			$destOnly = str_replace(" (Mobile)","", $destOnly);
			
			

			$displayLink = false;
			foreach($arrayOfCountries as $country) {
				
				if (strtolower($country) == strtolower($destOnly)){
					$displayLink = true;
				}

			}	

			
			$destOnly = str_replace(" ","-", $destOnly);
			
			
			if ($displayLink == true){
				$printValue = $printValue.'<li class="group"><div class="destination"><a href="/cheap-phone-calls-'.strtolower($destOnly).'/">'.$mostExpensiveRate->getDestination().'</a></div><div class="rate">'.$mostExpensiveRate->getRate().'p</div><div class="access_number">'.$mostExpensiveRate->getAccessNumber().'</div></li>';
				
			}else {
				$printValue = $printValue.'<li class="group"><div class="destination">'.$mostExpensiveRate->getDestination().'</div><div class="rate">'.$mostExpensiveRate->getRate().'p</div><div class="access_number">'.$mostExpensiveRate->getAccessNumber().'</div></li>';
			}
		}
		
		//CLEAR DOWN COUNTRIES PRINTED
		$ratesList = new ArrayObject();		

		$printValue = $printValue.'</ul></div><div style="display:none" id="'.$firstLetter.'_Countries"><ul class="country-alphabet"> ';
	}else{
		$printValue = $printValue.'<div id="'.$firstLetter.'_Countries"><ul class="country-alphabet"> ';
	}
	
	
}

$rateFormatted = number_format(floatval($rate), 1);

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
		//PRINT MOST EXPENSIVE RATE


		$mostExpensiveRate->setDestination(str_replace("Bosnia & Herz.","Bosnia and Herzegovina", $mostExpensiveRate->getDestination()));
		
		$destOnly = str_replace(" Mobile  Orange","", $mostExpensiveRate->getDestination());
		$destOnly = str_replace(" Mobile  T-Mobile","", $destOnly);
		$destOnly = str_replace(" Mobile  O2","", $destOnly);
		$destOnly = str_replace(" Mobile  Vodafone","", $destOnly);
		$destOnly = str_replace(" National","", $destOnly);			
		$destOnly = str_replace(" Mobile","", $destOnly);	
		$destOnly = str_replace(" (Landline)","", $destOnly);
		$destOnly = str_replace(" (Mobile)","", $destOnly);		
		
		$destOnly = str_replace("Bosnia & Herz.","Bosnia and Herzegovina", $destOnly);
		
		
		
		$displayLink = false;
		foreach($arrayOfCountries as $country) {
			
			
			if (strtolower($country) == strtolower($destOnly)){
				$displayLink = true;
			}
		
		}	

	
		$destOnly = str_replace(" ","-", $destOnly);
		
		if ($displayLink){
			$printValue = $printValue.'<li class="group"><div class="destination"><a href="/cheap-phone-calls-'.strtolower($destOnly).'/">'.$mostExpensiveRate->getDestination().'</a></div><div class="rate">'.$mostExpensiveRate->getRate().'p</div><div class="access_number">'.$mostExpensiveRate->getAccessNumber().'</div></li>';
		}else {
			$printValue = $printValue.'<li class="group"><div class="destination">'.$mostExpensiveRate->getDestination().'</div><div class="rate">'.$mostExpensiveRate->getRate().'p</div><div class="access_number">'.$mostExpensiveRate->getAccessNumber().'</div></li>';
			
		}
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

echo $printValue;

?>		
</ul>

</div> <!-- /SetHeight -->

<script type="text/javascript">
function changeCountryStartsWith(id){
	var abc=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];


	for (var i=0;i<abc.length;i++){
		try{			
			document.getElementById(abc[i]+"_Countries").style.display = "none";
		}catch(Exception){
		
		}				
	}

	
	try{
		document.getElementById(id+"_Countries").style.display = "block";
		document.getElementById("noCountriesFound").style.display = "none";
		document.getElementById("destinationTitles").style.display = "block";			
		
	}catch(Exception){
	
		document.getElementById("destinationTitles").style.display = "none";
		document.getElementById("noCountriesFound").style.display = "block";
		
		
	}	
}
</script>
</div>
			</div><!-- #content -->
            <?php include('sidebarExtras.php'); ?>
		</div><!-- #primary -->

<?php get_footer(); ?>
