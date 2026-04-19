<div class="sidebar">
    <div class="sidebar_popular" style="display:none;">
        <p class="sidebar_heading">Popular Destinations</p>
        <ul class="randomise_list group">
            <?php include('popular-countries.php'); ?>
        </ul>
    </div>
    
    <div class="sidebar_newsletter" style="display:none;">
        <p class="sidebar_heading">Sign up for free money saving tips</p>
       
        <!-- Begin MailChimp Signup Form -->
<div id="mc_embed_signup" class="mailchimp">
<form action="http://pocketdialuk.us2.list-manage.com/subscribe/post?u=a8bcf32dc629902da90c7c04b&amp;id=320f5e1056" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate form clear" target="_blank" novalidate>
	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Address" required>
	<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
</form>
</div>

<!--End mc_embed_signup-->
    </div>
    
     <div class="sidebar_unlimited group" style="display:none;">
        <ul class="ticks">
        	<li>Call abroad using your <span>mobile</span></li>
            <li>Rates from <span>1p/min</span></li>
            <li>Buy &pound;5 credit and get <span>&pound;3 extra free!</span> *</li>
        </ul>
        <a href="/cheap-international-calls-from-mobile/"><img src="/images/buttons/moreinfo.png"/></a>
        <p>* First topup only</p>
    </div>
    
</div> <!-- /.sidebar -->
<script>
//Detect  how height the container div is and show sidebar elements dependent on this

var primaryHeight = jQuery('#primary').outerHeight(true);
if(primaryHeight > 350){
jQuery('.sidebar_popular').css('display','block');	
}
if(primaryHeight > 480){
jQuery('.sidebar_popular').css('display','block');	
jQuery('.sidebar_newsletter').css('display','block');
}
if(primaryHeight > 900){
jQuery('.sidebar_popular').css('display','block');	
jQuery('.sidebar_newsletter').css('display','block');
jQuery('.sidebar_unlimited').css('display','block');
}



//Detect  how height the container div is and show sidebar elements dependent on this

var maincontainer = jQuery('#main').outerHeight(true);
if(maincontainer > 350){
jQuery('.sidebar_popular').css('display','block');	
}
if(maincontainer > 480){
jQuery('.sidebar_popular').css('display','block');	
jQuery('.sidebar_newsletter').css('display','block');
}
if(maincontainer > 900){
jQuery('.sidebar_popular').css('display','block');	
jQuery('.sidebar_newsletter').css('display','block');
jQuery('.sidebar_unlimited').css('display','block');
}

</script>

