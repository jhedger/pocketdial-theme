if (typeof RC == 'undefined') RC = {};
RC.Badge = {
	baseUrl: null,
	itemId:  null,

	/**
	 * Initializes the badge.
	 *
	 * This method takes a base URL and an item ID, and registers the onload handler, which will perform the actual
	 * initialization using these parameters.
	 */
	initialize: function(baseUrl, itemId) {
		RC.Badge.baseUrl = baseUrl;
		RC.Badge.itemId  = itemId;
		jQuery(document).ready(RC.Badge.onLoad);
	},

	/**
	 * Initializes the badge (for real).
	 *
	 * An onload handler registered by initialize() which performs the actual initialization of the badge. The method will
	 * shoot off a JSON request.
	 */
	 onLoad: function() {

		var style = document.getElementById('rc-badge-wrapper').className.replace(/^.*(style-([^ ]+)).*$/,'$2');
		var color = document.getElementById('rc-badge-wrapper').className.replace(/^.*(color-([^ ]+)).*$/,'$2');

		jQuery.getJSON(
			RC.Badge.baseUrl + "/services/badges/v2?item_id=" + RC.Badge.itemId + "&format=json&style=" + style + "&color=" + color + "&url=" + encodeURIComponent(decodeURIComponent(document.URL)) + "&jsoncallback=?", '',

			function(data){
				var dom = (RC.SeoBadge && RC.SeoBadge.generator) ? RC.SeoBadge.generator.ifr : document;
				// The score of the item, 1-5 range, rounded to one decimal digit (i.e as displayed on the site).
				var score  = Math.round((data[0].itemAvgRating) * 10) / 10;

				// The score of the item, 0-50 range, rounded to closest multiply of 5. This is used for the stars image.
				var score5 = Math.round((data[0].itemAvgRating) * 2) * 5;

				jQuery('div#rc-badge-wrapper div.rc-content p.rc-rating', dom).html(score+'/5');
				if (data[0].reviewExtract.length >= 155) {
					jQuery('div#rc-badge-wrapper div.rc-content p.rc-extract', dom).prepend(data[0].reviewExtract+'...');
				} else {
					jQuery('div#rc-badge-wrapper div.rc-content p.rc-extract', dom).prepend(data[0].reviewExtract);
				}
				var itemName = jQuery(jQuery('div#rc-badge-wrapper p.rc-item a').html().split(/ +/)).map(function(){
					return this.replace(/((&[a-z0-9A-Z]+;)|(a|e(?!$)|i(?!ng$)|o|u|y){1,3}|le$|ing$)/g,'$&&shy;');
					// return this.replace(/((a|e(?!$)|i(?!ng$)|o|u|y){1,3}|le$|ing$)/g,'$&&zwnj;');
					// return this.replace(/((a|e(?!$)|i(?!ng$)|o|u|y){1,3}|le$|ing$)/g,'$&&#8204;');
				}).get().join(' ');
				jQuery('div#rc-badge-wrapper p.rc-item a').html(itemName);

				var categoryName = jQuery(jQuery('div#rc-badge-wrapper p.rc-category a').html().split(/ +/)).map(function(){
					return this.replace(/((&[a-z0-9A-Z]+;)|(a|e(?!$)|i(?!ng$)|o|u|y){1,3}|le$|ing$)/g,'$&&shy;');
				}).get().join(' ');
				jQuery('div#rc-badge-wrapper p.rc-category a').html(categoryName);


				// $('div#rc-badge-wrapper div.rc-content p.rc-item a').html(data[0].itemDesc);
				// $('div#rc-badge-wrapper div.rc-content p.rc-category a').html(data[0].catName);

				jQuery('div#rc-badge-wrapper div.rc-content p.rc-date', dom).prepend(data[0].reviewDate || '');
				if(style.match(/^(150x340|340x150)$/)) {
					jQuery('div#rc-badge-wrapper .rc-overview').append('<div style="position: absolute; height: 30px; bottom: 0px; width: 100%; background: url('+RC.Badge.baseUrl+'/images/seo_badges/v3/bg-overview-'+color+'.png) repeat-x;"></div>');
				}
				jQuery('div#rc-badge-wrapper div.rc-content div.rc-stars', dom).prepend('<img class="stars-'+score5+'" src="'+RC.Badge.baseUrl+'/images/seo_badges/v3/plot.gif" />');

				//RC.fixIe6Images();
			}
		);
	 }
};
