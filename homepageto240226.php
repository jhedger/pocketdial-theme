<?php
/*
Template Name: Home Page
*/
?>
<?php include_once("rateObject.php") ?>

<?php get_header(); ?>

		
         <div class="homepage_container group">
         	
            <div class="country_container">
         	<div class="choose_country">
            	<h2>See how little it costs to call with PocketDial <div class="fb-like" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false" data-font="arial"></div></h2>
                <div class="country_dropdown group">
                	
            		<label>Choose Country:</label>
               	
            		<ul id="coolMenu">
                        <li>
                            <a href="#" class="cool_menu_first">Click here...</a>
                            <ul class="noJS showMenu">
                            <!-- Pull in Cuntry List Template -->
                                <?php include('country_list.php'); ?>
                            </ul>
                        </li>
					</ul>
                </div> <!-- /.country_dropdown -->
            </div> <!-- /.choose_country -->
            <div class="popular_destinations group">
            <h2>Popular destinations :</h2>
            <ul class="homepage_popular randomise_list">
                <?php include('popular-countries.php'); ?>
			</ul>
            </div> <!-- /.popular_destinations -->
            <div class="other_popular_destinations">
            <h3>Other popular destinations :</h3>
			
			<p>
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


$arrayOfPopularCountries = array("France", "Italy", "Spain");
for ($i = 0; $i <= count($arrayOfPopularCountries); $i++) {
		
	foreach($fullRatesList as $rate) {
		
		
		$destination = $rate->getDestination();
		$destination = str_replace(" (Landline)","", $destination);
		
		if ($arrayOfPopularCountries[$i] == $destination){

			if ($i != 0){
				echo ', ';
			}
			
			$destination = str_replace(" ","-", $destination);
			
			echo 'Call <strong><a href="/cheap-phone-calls-'.strtolower($destination).'/">'.$destination.'</a></strong>'.$rate->getRate().'p/min';
		}
	}
}


echo $printValue;

?>			
			
			
			
       
            </div> <!-- /.other_popular_destinations -->
           </div> <!-- /. country_container -->
			<div class="sliding-banner group">
				<ul class="calling-info">
					<li><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/calling-from-a-landline.jpg"/></a></li>
					<li><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/calling-from-a-mobile.jpg"/></a></li>
				</ul> <!-- /.sliding_banner -->
			</div>

         </div> <!-- /. homepage_container -->
        
    <div class="simple_steps_slider group">
        	<h2>Simple Steps to Save on International Calls</h2>

    	<div id="bx-pager" class="thumbs group">
			<a data-slide-index="0" href=""><img src="/images/icon_phone.png"/>How to Call from a Landline</a>
			<a data-slide-index="1" href=""><img src="/images/icon_mobile.png"/>How to Call from a Mobile</a>
		</div>
			
       	<ul id="simple-steps" class="steps-slider">
			<li>
			
			  	<div>
			        <span class="arrow"></span>
			        <h3><span class="number">1</span> Choose your Country</h3>
					<p>Decide which country it is you wish to call and use our <a href="#" class="ratefindertool">ratefinder tool</a> to find the cheapest international calls rate for that country.</p>
				</div>
				<div>
			        <span class="arrow"></span>
			        <h3><span class="number">2</span> Dial your access number</h3>
					<p>Our cheap access numbers enable you to make international calls at a fraction of the usual cost. Dial the access number.</p>
				</div>
				<div>
			        <span class="arrow"></span>
			        <h3><span class="number">3</span> Dial the foreign number</h3>
					<p>Dial the international number you wish to call (including the international code).</p>
				</div>
				<div>
			        <h3><span class="number">4</span> Enjoy Chatting!</h3>
					<p>Once you have dialed the access number, followed by the international number we will connect you. All you pay for is the cost of the access number!</p>
				</div>
			</li> 
			<li>
				<div class="credit">
			        <span class="arrow"></span>
			        <h3><span class="number">1</span> Topup your mobile</h3>
					<p>For<span class="blue bold"> &pound;3</span> Credit Text <span class="red bold">CREDITME</span> to <span class="red bold">80041</span></p>
			       	<p>For<span class="blue bold"> &pound;5</span> Credit Text <span class="red bold">CREDITME</span> to <span class="red bold">80550</span></p>
				</div>
				<div>
			        <span class="arrow"></span>
			        <h3><span class="number">2</span> Dial your access number</h3>
					<p>Make the call using one of our topup2talk access numbers: <span class="info tooltip" alt="Scroll over the below numbers for additional information">i</span></p>
					
					<p class="tooltip" alt="Calls to 0207 access numbers will be charged at service provider's standard rate."><a href="tel:02071246666">0207 124 6666</a></p>
					<p class="tooltip" alt="Calls to 0845 access numbers will be charged at service provider's standard rate."><a href="tel:08454516666">0845 451 6666</a></p>
					<p class="tooltip" alt="Calls to 0800 access numbers will be charged at your service provider's standard rate plus a 2p/minute (20p/minute from a payphone) surcharge to the pence per minute rate for the country you are calling."><a href="tel:08005946666">0800 594 6666</a></p>
					<p class="tooltip" alt="Calls to 0333 numbers cost no more than a national rate call to an 01 or 02 number and count towards any inclusive minutes in the same way as 01 and 02 calls.This includes calls from any type of line including mobile, BT, other fixed line or payphone. If in doubt, please check with your phone provider."><a href="tel:03333218784">0333 321 8784</a></p>
				</div>
				<div>
			        <span class="arrow"></span>
			        <h3><span class="number">3</span> Dial the foreign number</h3>
					<p>Dial the international number you wish to call (including the international code)</p>
				</div>
				<div>
			        <h3><span class="number">4</span>Start saving now</h3>
					<p>Remember you get our great international call rates without having to open an account or give out your credit card details.</p>
				</div>
			</li>
	  	</ul> 
              
     </div> <!-- /.simple_steps_slider -->
         
     <div class="group">  

          <div class="recent_posts group"> 
            <h2>Recent News</h2>
            <ul class="the_posts">
            <!-- Remember to set a featured image in the post for it to show up -->
                <?php echo recentPosts(); ?>
            </ul>
          </div>
      
          <div class="homepage_newsletter">
           <h4>Sign up for free money saving tips</h4>

	        <!-- Begin MailChimp Signup Form -->
			<div id="mc_embed_signup" class="mailchimp">
				<form action="http://pocketdialuk.us2.list-manage.com/subscribe/post?u=a8bcf32dc629902da90c7c04b&amp;id=320f5e1056" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate form clear" target="_blank" novalidate>
					<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Address" required>
					<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
				</form>
			</div> <!--End mc_embed_signup-->
          </div> <!-- /.homepage_newsletter -->
	</div> <!-- /group -->


	<div id="content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>
		<?php endwhile; // end of the loop. ?>
       
	</div><!-- #content -->
            


<?php get_footer(); ?>
