<?php include_once("officialListOfCountries.php") ?>
<?php
/*
Template Name: Calling From A Mobile
*/
?>

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
     <div id="destinationTitles" class="group"><div class="destination">Country</div><div class="rate">Rate per minute</div><div class="connection_charge">Connection Charge</div></div>
    
	 <div id="noCountriesFound" style="display:none">No countries found.</div>
 <?php 

//Find the filename for each client by finding their ID in the filename 
$filename = "xml/topup-mobile.xml";

//If the file above exists then do the following code 
if (file_exists($filename)){

//load that xml file
$xml = simplexml_load_file($filename);

$countryListA = "";
$countryListB = "";
$countryListC = "";
$countryListD = "";
$countryListE = "";
$countryListF = "";
$countryListG = "";
$countryListH = "";
$countryListI = "";
$countryListJ = "";
$countryListK = "";
$countryListL = "";
$countryListM = "";
$countryListN = "";
$countryListO = "";
$countryListP = "";
$countryListQ = "";
$countryListR = "";
$countryListS = "";
$countryListT = "";
$countryListU = "";
$countryListV = "";
$countryListW = "";
$countryListX = "";
$countryListY = "";
$countryListZ = "";


// set the tablerow tag inside the group tag of the xml to the variable $row and for each then for each tablerow tag the following code will be executed 
foreach ($xml->T2TRates as $row) {

// the keyword is found in the name tag and set to the variable $word 
$destination = $row->Destination; 

// the current position is found in the position tag in the tablecell tag. It is set to the variable $position 
$connection = $row->Conn_Chg; 
// the position at the beginning of the month is found in the previous tag in the tablecell tag. It is set to the variable $previous 
$rate = $row->Rate;

$firstLetter = substr($destination, 0, 1); 

$rateFormatted = number_format(floatval($rate), 1);
$rateFormatted = $rateFormatted.'';
$rateFormatted = str_replace(".0", "", $rateFormatted);

$displayLink = false;
foreach($arrayOfCountries as $country) {

	if ($country == $destination){
		$displayLink = true;
	}

}

foreach($arrayOfCountries as $country) {

	if ($country.' (Mobile)' == $destination){
		$displayLink = true;
	}

}




$countryLink = str_replace(" (Mobile)","", $destination);
$countryLink = str_replace(" ","-", $countryLink);

if ($displayLink){
	$countryText = '<a href="/cheap-phone-calls-'.strtolower($countryLink).'/">'.$destination.'</a>';
}else{
	$countryText = ''.$destination;
}



if ($firstLetter == 'A'){
	$countryListA = $countryListA.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'B'){
	$countryListB = $countryListB.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'C'){
	$countryListC = $countryListC.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'D'){
	$countryListD = $countryListD.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'E'){
	$countryListE = $countryListE.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'F'){
	$countryListF = $countryListF.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'G'){
	$countryListG = $countryListG.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'H'){
	$countryListH = $countryListH.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'I'){
	$countryListI = $countryListI.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'J'){
	$countryListJ = $countryListJ.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'K'){
	$countryListK = $countryListK.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'L'){
	$countryListL = $countryListL.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'M'){
	$countryListM = $countryListM.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'N'){
	$countryListN = $countryListN.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'O'){
	$countryListO = $countryListO.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'p'){
	$countryListP = $countryListP.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'Q'){
	$countryListQ = $countryListQ.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'R'){
	$countryListR = $countryListR.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'S'){
	$countryListS = $countryListS.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'T'){
	$countryListT = $countryListT.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'U'){
	$countryListU = $countryListU.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'V'){
	$countryListV = $countryListV.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'W'){
	$countryListW = $countryListW.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'X'){
	$countryListX = $countryListX.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'Y'){
	$countryListY = $countryListY.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}else if ($firstLetter == 'Z'){
	$countryListZ = $countryListZ.'<li class="group"><div class="destination">'.$countryText.'</div><div class="rate">'.$rateFormatted.'p</div><div class="connection_charge">'.$connection.'p</div></li>';
}

}


}else{

echo 'Does Not Exist';

}



if ($countryListA != ''){
	echo '<div id="A_Countries"><ul class="country-alphabet"> '.$countryListA.'</ul></div>';	
}
if ($countryListB != ''){
	echo '<div style="display:none" id="B_Countries"><ul class="country-alphabet"> '.$countryListB.'</ul></div>';
}
if ($countryListC != ''){
	echo '<div style="display:none" id="C_Countries"><ul class="country-alphabet"> '.$countryListC.'</ul></div>';
}
if ($countryListD != ''){
	echo '<div style="display:none" id="D_Countries"><ul class="country-alphabet"> '.$countryListD.'</ul></div>';
}
if ($countryListE != ''){
	echo '<div style="display:none" id="E_Countries"><ul class="country-alphabet"> '.$countryListE.'</ul></div>';
}
if ($countryListF != ''){
	echo '<div style="display:none" id="F_Countries"><ul class="country-alphabet"> '.$countryListF.'</ul></div>';
}
if ($countryListG != ''){
	echo '<div style="display:none" id="G_Countries"><ul class="country-alphabet"> '.$countryListG.'</ul></div>';
}
if ($countryListH != ''){
	echo '<div style="display:none" id="H_Countries"><ul class="country-alphabet"> '.$countryListH.'</ul></div>';
}
if ($countryListI != ''){
	echo '<div style="display:none" id="I_Countries"><ul class="country-alphabet"> '.$countryListI.'</ul></div>';
}
if ($countryListJ != ''){
	echo '<div style="display:none" id="J_Countries"><ul class="country-alphabet"> '.$countryListJ.'</ul></div>';
}
if ($countryListK != ''){
	echo '<div style="display:none" id="K_Countries"><ul class="country-alphabet"> '.$countryListK.'</ul></div>';
}
if ($countryListL != ''){
	echo '<div style="display:none" id="L_Countries"><ul class="country-alphabet"> '.$countryListL.'</ul></div>';
}
if ($countryListM != ''){
	echo '<div style="display:none" id="M_Countries"><ul class="country-alphabet"> '.$countryListM.'</ul></div>';
}
if ($countryListN != ''){
	echo '<div style="display:none" id="N_Countries"><ul class="country-alphabet"> '.$countryListN.'</ul></div>';
}
if ($countryListO != ''){
	echo '<div style="display:none" id="O_Countries"><ul class="country-alphabet"> '.$countryListO.'</ul></div>';
}
if ($countryListP != ''){
	echo '<div style="display:none" id="P_Countries"><ul class="country-alphabet"> '.$countryListP.'</ul></div>';
}
if ($countryListQ != ''){
	echo '<div style="display:none" id="Q_Countries"><ul class="country-alphabet"> '.$countryListQ.'</ul></div>';
}
if ($countryListU != ''){
	echo '<div style="display:none" id="U_Countries"><ul class="country-alphabet"> '.$countryListU.'</ul></div>';
}
if ($countryListR != ''){
	echo '<div style="display:none" id="R_Countries"><ul class="country-alphabet"> '.$countryListR.'</ul></div>';
}
if ($countryListS != ''){
	echo '<div style="display:none" id="S_Countries"><ul class="country-alphabet"> '.$countryListS.'</ul></div>';
}
if ($countryListT != ''){
	echo '<div style="display:none" id="T_Countries"><ul class="country-alphabet"> '.$countryListT.'</ul></div>';
}
if ($countryListU != ''){
	echo '<div style="display:none" id="U_Countries"><ul class="country-alphabet"> '.$countryListU.'</ul></div>';
}
if ($countryListV != ''){
	echo '<div style="display:none" id="V_Countries"><ul class="country-alphabet"> '.$countryListV.'</ul></div>';
}
if ($countryListW != ''){
	echo '<div style="display:none" id="W_Countries"><ul class="country-alphabet"> '.$countryListW.'</ul></div>';
}
if ($countryListX != ''){
	echo '<div style="display:none" id="X_Countries"><ul class="country-alphabet"> '.$countryListX.'</ul></div>';
}
if ($countryListY != ''){
	echo '<div style="display:none" id="Y_Countries"><ul class="country-alphabet"> '.$countryListY.'</ul></div>';
}
if ($countryListZ != ''){
	echo '<div style="display:none" id="Z_Countries"><ul class="country-alphabet"> '.$countryListZ.'</ul></div>';
}



?>		



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
