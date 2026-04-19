<?php
/*
Template Name: Country Page
*/
?>

<?php get_header(); ?>

<?php if( get_field('feedurl') ): ?>

 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

    google.load("feeds", "1");

    function initialize() {
      var feed = new google.feeds.Feed("<?php echo the_field('feedurl'); ?>");
      feed.load(function(result) {
        if (!result.error) {
          var container = document.getElementById("feed");
          var html = "";
          for (var i = 0; i < result.feed.entries.length; i++) {
            var entry = result.feed.entries[i];
            html += '<div class="the_posts"><h4><a href="' + entry.link + '" target="_blank">' + entry.title + '</a></h4><p>' + entry.contentSnippet + '</p><a class="more" href="' + entry.link + '" target="_blank">Read more</a></div>'
          }
          container.innerHTML = html;
        }
      });
    }
    google.setOnLoadCallback(initialize);

    </script>
<?php endif; ?>

<?php 

 $url = $_SERVER['REQUEST_URI'];
 $countryName = str_replace("cheap-phone-calls-","", $url); 
 $countryName = str_replace("/","", $countryName);
 $countryName = str_replace("-"," ", $countryName);
 $countryName = ucwords($countryName);
 
 if ($countryName == "Usa"){
 	$countryName = "USA";
 }
 
 //get the rates

 $landlineToLandlineTelephone;
 $landlineToLandlineRate;
 $MobileToLandlineRate;
 $landlineToMobileRate;

 
 
 $MobileToLandlineConnectionCharge;
 $MobileToMobileRate;
 $MobileToMobileConnectionCharge;
 
 //Find the filename for each client by finding their ID in the filename
 $filename = "xml/justdial-landline.xml";
 
 //If the file above exists then do the following code
 if (file_exists($filename)){
 
 	//load that xml file
 	$xml = simplexml_load_file($filename);
 
 	$previousFirstLetter = "";
 
 	// set the tablerow tag inside the group tag of the xml to the variable $row and for each then for each tablerow tag the following code will be executed
 	foreach ($xml->Access_Dest_Rates_Comm as $row) {
 
 		// the keyword is found in the name tag and set to the variable $word
 		$destination = $row->Destination;
 
 		// the current position is found in the position tag in the tablecell tag. It is set to the variable $position
 		$access = $row->Access_Number;
 		// the position at the beginning of the month is found in the previous tag in the tablecell tag. It is set to the variable $previous
 		$rate = $row->Rate;
 
 		
 		$destination = str_replace(" (Landline)","", $destination);

 		$countryNameCopy = $countryName;
 		
 		if ($countryName == "Bosnia And Herzegovina"){
 		
 			$countryNameCopy = "Bosnia & Herz.";
 		
 		} 	

 		
 		
 		if ($destination == $countryNameCopy) {
 			
 				
			
				$access = str_replace(" ", "", $access);
				$a = substr($access,0,4);
				$b = substr($access,4,3);
				$c = substr($access,7,4);
				$accessFormatted = $a.' '.$b.' '.$c;			
 			
 				$landlineToLandlineTelephone = $accessFormatted;
 				
 				$rateFormatted = number_format(floatval($rate), 1);		
 				$rateFormatted = $rateFormatted.'';
 				$rateFormatted = str_replace(".0", "", $rateFormatted);
 				
 				$landlineToLandlineRate = $rateFormatted;
 			
 			
			
 
 		}
 		
 		$destination = str_replace(" (Mobile)","", $destination);
 		
 		if ($destination == $countryNameCopy) {
 		
 				
 			$access = str_replace(" ", "", $access);
 			$a = substr($access,0,4);
 			$b = substr($access,4,3);
 			$c = substr($access,7,4);
 			$accessFormatted = $a.' '.$b.' '.$c;
 		
 			$landlineToMobileTelephone = $accessFormatted;
 				
			$rateFormatted = number_format(floatval($rate), 1);
			$rateFormatted = $rateFormatted.'';
			$rateFormatted = str_replace(".0", "", $rateFormatted);
 				
 			$landlineToMobileRate = $rateFormatted;
 		
 		
 				
 		
 		} 		
 
 	}
 
 }else{
 
 	echo 'Does Not Exist';
 
 }
 
 
 //Find the filename for each client by finding their ID in the filename
 $filename = "xml/topup-mobile.xml";
 
 //If the file above exists then do the following code
 if (file_exists($filename)){
 
 	//load that xml file
 	$xml = simplexml_load_file($filename);
 
 	// set the tablerow tag inside the group tag of the xml to the variable $row and for each then for each tablerow tag the following code will be executed
 	foreach ($xml->T2TRates as $row) {
 
 		// the keyword is found in the name tag and set to the variable $word
 		$destination = $row->Destination;
 
 		// the current position is found in the position tag in the tablecell tag. It is set to the variable $position
 		$connection = $row->Conn_Chg;
 		// the position at the beginning of the month is found in the previous tag in the tablecell tag. It is set to the variable $previous
 		$rate = $row->Rate;
 

 		$countryNameCopy = $countryName;
 		
 
 		
 		if ($countryName == "Bosnia And Herzegovina"){
 			
 			$countryNameCopy = "Bosnia & Herz.";
 			
 		}
 		
 		
 		
 		if ($destination == $countryNameCopy) { 		
 		
 			$MobileToLandlineRate = $rate;
 			$MobileToLandlineConnectionCharge = $connection;
 		
 		}		
 		
 		if ($destination == $countryNameCopy.' (Mobile)') {
 			
 			$MobileToMobileRate = $rate;
 			$MobileToMobileConnectionCharge = $connection;
 			 			
 		} 

 			
 		

 		
 		
 	}
 
 
 }else{
 
 	echo 'Does Not Exist';
 
 } 
 
 ?>
        <div id="primary">
            <div id="content" role="main">


<h1 class="country_heading">




<?php




$imageName = str_replace(" ", "-", $countryName);

$array = get_headers('http://'.$_SERVER['SERVER_NAME'].'/images/flags/'.strtolower($imageName).'.jpg');

$value = $array["0"];
if ( $value == 'HTTP/1.1 404 Not Found'){
	
}else{
	
	
	echo '<img src="/images/flags/'.strtolower($imageName).'.jpg" alt="Cheap calls to '.$countryName.'"/>';
}
	
	

?>

How to make cheap calls to <?php echo $countryName;?> from a UK landline<div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false" data-font="arial"></div></h1>

<div class="group">
	<div class="landline_column">

    	<div class="phone_info_container" itemscope itemtype="http://schema.org/Product">
        	<h2 class="header" itemprop="name">Calling <?php echo $countryName;?> from a landline</h2>
            <span class="off-screen"><?php echo '<img itemprop="image" src="/images/flags/'.strtolower($imageName).'.jpg"/>' ?></span>
            <div class="calling-to" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <p class="nextstep">To a Landline</p>
            <p class="phonerate"><img src="/images/icon_phone.png" alt="Calling <?php echo $countryName;?> from a landline to a landline"/><span itemprop="price"><?php echo $landlineToLandlineRate;?>p</span> /min</p>
            <p class="nextstep">Dial Access Number:</p>
            <p class="accessNumber"><?php echo $landlineToLandlineTelephone;?></p>
            </div>
            <div class="calling-to">
            <span class="border"></span>
            <p class="nextstep">To a Mobile</p>
            <p class="phonerate"><img src="/images/icon_mobile.png"/ alt="Calling <?php echo $countryName;?> from a landline to a mobile"><span><?php echo $landlineToMobileRate;?>p</span> /min</p> <!-- Change to Landline to Mobile rate -->
            <p class="nextstep">Dial Access Number:</p>
            <p class="accessNumber"><?php echo $landlineToMobileTelephone;?></p> <!-- Change to Landline to Mobile access number -->
            </div>
            
            <span class="plus">+</span>
            
            <p class="nextstep">Dial the international dialing code<br/>followed by the destination number you&acute;re calling</p>
            
            <ul class="ticks">
            	<li>No Subscriptions to Pay</li>
                <li>No Credit Card Required</li>
                <li>No Account to Open</li>
            </ul>
<p>Remember: Calls cost the 'per minute' charge shown plus your phone company's access charge. The charges will appear on your usual phone bill...no extra bills from us!</p>

<p>Click the following links to go to the tariffs page for your provider:</p>
<p><a href="https://www.productsandservices.bt.com/assets/pdf/BT_PhoneTariff_Residential.pdf"target="_blank">Check BT access charges</a></p>
<p><a href="https://www.virginmedia.com/content/dam/virginmedia/dotcom/images/shop/downloads/010818_Everyday_Call_Charges_V2.pdf"target="_blank">Check Virgin access charges</a></p>
			
			
        </div> <!-- /.phone_info_container -->
        
        <div class="terms">
            <ul>
                <li>You must have the bill payer's permission before calling our service</li>
                <li>You are charged from the time of connection to our service</li>
                <li>Please hang up after a short time if your call is engaged or unanswered</li>
                <li>Calls cost the 'per minute' service charge shown plus your phone company's access charge</li>
                <li>Access charges may vary, check with your service provider before calling</li>
                <li>For customer services please call 033 3321 8705 or email <a href="mailto:care@just-dial.com?Subject=Query%20from%20Pocketdial.com"</li>
                <li>Service provided by New Call Telecom Ltd</li>
    		</ul>
            <p><a href="/terms-and-conditions/">Click here</a> for full Terms and Conditions.</p>
        </div> <!-- Terms -->
    </div> <!-- Landline Column -->
    
	<div class="mobile_column" itemscope itemtype="http://schema.org/Product">
    	<div class="phone_info_container">
        	<h2 class="header" itemprop="name">Calling <?php echo $countryName;?> from a mobile</h2>
            <span class="off-screen"><?php echo '<img itemprop="image" src="/images/flags/'.strtolower($imageName).'.jpg"/>' ?></span>
            <div class="calling-to" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <p class="nextstep">To a Landline</p>
                <p class="phonerate"><img src="/images/icon_phone.png" alt="Calling <?php echo $countryName;?> from a mobile to a landline"/><span itemprop="price"><?php echo $MobileToLandlineRate;?>p</span> /min</p>
                <p class="connectionCharge"><?php echo $MobileToLandlineConnectionCharge?>p Connection charge</p> <!-- Add connection charge -->
            </div>
            
            <div class="calling-to" <?php if ($MobileToMobileRate == ""){ echo "style='display:none'"; }?>>
                <span class="border"></span>
                <p class="nextstep">To a Mobile</p>
                <p class="phonerate"><img src="/images/icon_mobile.png" alt="Calling <?php echo $countryName;?> from a mobile to a mobile"/><span><?php echo $MobileToMobileRate;?>p</span> /min</p><!-- Change to Mobile to Mobile rate -->
                <p class="connectionCharge"><?php echo $MobileToMobileConnectionCharge?>p Connection Charge</p> <!-- Add connection charge -->
            </div>
            
            <p class="nextstep">Topup your mobile phone</p>
            <p class="creditMe"><span>&pound;3</span> Credit - Text <span class="red">CREDITME</span> to <span class="red">80041</span></p>
            <p class="creditMe"><span>&pound;5</span> Credit - Text <span class="red">CREDITME</span> to <span class="red">80550</span></p>
            <p class="nextstep">We will text you confirmation, then call</p>
          
          <div class="mobileAccessNumbers group">  
            <ul class="mobile_numbers">            
                <li class="tooltip" alt="Calls to 0207 access numbers will be charged at service provider's standard rate.">0207 124 6666</li>
                <li class="tooltip" alt="Calls to 0845 access numbers will be charged at service provider's standard rate.">0845 451 6666</li>
                <li class="tooltip" alt="Calls to 0800 access numbers will be charged at your service provider's standard rate plus a 2p/minute (20p/minute from a payphone) surcharge to the pence per minute rate for the country you are calling.">0800 594 6666</li>
                <li class="tooltip" alt="Calls to 0333 numbers cost no more than a national rate call to an 01 or 02 number and count towards any inclusive minutes in the same way as 01 and 02 calls.This includes calls from any type of line including mobile, BT, other fixed line or payphone. If in doubt, please check with your phone provider.">0333 321 8747</li>
            </ul>
			<span class="plus">+</span>
			<p class="infoRight">Dial the international dialing code followed by the destination number you&acute;re calling</p>
          </div> <!-- mobileAccessNumbers --> 
          <p>Please scroll over the above numbers for additional information</p>
        </div> <!-- /phone_info_container -->
        
         <div class="terms">
            <p>Before you use our service, please make sure you fully understand how our service works and how you will be charged:</p>
            <ul>
                <li>You must have the bill payer's permission before using our service</li>
                <li>Text to 80550 costs &pound;5 plus your standard mobile network rates for the request message and is charged by your service provider</li>
                <li>Text to 80041 costs &pound;3 plus your standard mobile network rates for the request message and is charged by your service provider</li>
                <li>Our service can be used from the mobile number used for the subscription to our service or from another phone using a PIN</li>
                <li>Calls to our 0207 & 0333 access number will be charged by your service provider at their standard rate or included in your call package</li>
                <li>If you don't use our service to make a call or send a top up request within 90 days any unused Calling Credit will expire</li>
                <li>For customer services please call 0844 552 8575</li>
                <li>Service provided by New Call Telecom Ltd</li>
            </ul>
            <p><a href="#" class="mobile_show_more">Click here</a> for full Terms and Conditions.</p>
        </div> <!-- Terms -->
    </div> <!-- Mobile Column -->

        </div> <!-- Group -->

        <div class="country_page_content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', 'page' ); ?>
            <?php endwhile; // end of the loop. ?>

            <?php if( get_field('feedurl') ): ?>
                <h2>Travel Information (provided by the FCO)</h2>      
                <div id="feed"></div>
            <?php endif; ?>

        </div><!-- /.country_page_content -->

       
    </div><!-- #content -->
    <?php include('sidebarExtras.php'); ?>
</div><!-- #primary -->			


<?php get_footer(); ?>
