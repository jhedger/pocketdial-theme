<?php
/*
Template Name: Home Page v2
*/

// SEO
$seoYear  = date('Y');
$seoTitle = "Cheapest Way to Call Abroad from the UK ({$seoYear}) — PocketDial";
$seoDesc  = "Compare every way to make cheap international calls from the UK — access numbers, WhatsApp, Rebtel, eSIMs and money transfer. PocketDial has been helping UK callers since 2003.";

add_filter('wpseo_title', function($t) use ($seoTitle) { return $seoTitle; });
add_filter('wpseo_metadesc', function($d) use ($seoDesc) { return $seoDesc; });
if (!defined('WPSEO_VERSION')) {
    add_action('wp_head', function() use ($seoTitle, $seoDesc) {
        echo '<title>' . esc_html($seoTitle) . '</title>' . "\n";
        echo '<meta name="description" content="' . esc_attr($seoDesc) . '">' . "\n";
    }, 1);
}

// Top countries for the quick-pick grid
$topCountries = [
    'India'        => ['flag' => 'india',        'slug' => 'india'],
    'Pakistan'     => ['flag' => 'pakistan',      'slug' => 'pakistan'],
    'Nigeria'      => ['flag' => 'nigeria',       'slug' => 'nigeria'],
    'Poland'       => ['flag' => 'poland',        'slug' => 'poland'],
    'Bangladesh'   => ['flag' => 'bangladesh',    'slug' => 'bangladesh'],
    'USA'          => ['flag' => 'usa',           'slug' => 'usa'],
    'Australia'    => ['flag' => 'australia',     'slug' => 'australia'],
    'China'        => ['flag' => 'china',         'slug' => 'china'],
    'Turkey'       => ['flag' => 'turkey',        'slug' => 'turkey'],
    'Zimbabwe'     => ['flag' => 'zimbabwe',      'slug' => 'zimbabwe'],
    'Ghana'        => ['flag' => 'ghana',         'slug' => 'ghana'],
    'Spain'        => ['flag' => 'spain',         'slug' => 'spain'],
    'France'       => ['flag' => 'france',        'slug' => 'france'],
    'UAE'          => ['flag' => 'united-arab-emirates', 'slug' => 'united-arab-emirates'],
    'Iran'         => ['flag' => 'iran',          'slug' => 'iran'],
    'Jamaica'      => ['flag' => 'jamaica',       'slug' => 'jamaica'],
    'Kenya'        => ['flag' => 'kenya',         'slug' => 'kenya'],
    'Sri Lanka'    => ['flag' => 'sri-lanka',     'slug' => 'sri-lanka'],
    'Philippines'  => ['flag' => 'philippines',   'slug' => 'philippines'],
    'Canada'       => ['flag' => 'canada',        'slug' => 'canada'],
];

get_header();
?>
<style>
/* ============================================================
   POCKETDIAL — Home Page v2
   Brand: white, red (#e8383e), clean, functional
   ============================================================ */

* { box-sizing:border-box; margin:0; padding:0; }

/* Full width escape */
body.page-template-home_page #page,
body.page-template-home_page-php #page { max-width:100% !important; width:100% !important; }
body.page-template-home_page #main,
body.page-template-home_page-php #main,
body.page-template-home_page .site-content,
body.page-template-home_page-php .site-content,
body.page-template-home_page #content,
body.page-template-home_page-php #content,
body.two-column.page-template-home_page #content,
body.right-sidebar.page-template-home_page #content { 
    width:100% !important; max-width:100% !important; 
    margin:0 !important; padding:0 !important; float:none !important; 
}
body.page-template-home_page #secondary,
body.page-template-home_page-php #secondary,
body.two-column.page-template-home_page #secondary,
body.right-sidebar.page-template-home_page #secondary { 
    display:none !important; width:0 !important; float:none !important;
}
body.page-template-home_page .entry-header,
body.page-template-home_page-php .entry-header,
body.page-template-home_page .entry-content > *:not(.pd-home),
body.page-template-home_page-php .entry-content > *:not(.pd-home) { display:none !important; }
body.page-template-home_page .entry-content,
body.page-template-home_page-php .entry-content { 
    padding:0 !important; margin:0 !important; max-width:100% !important; width:100% !important;
}

/* Base */
.pd-home {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    background:#fff;
    color:#333;
    font-size:16px;
    line-height:1.5;
}
.pd-container { max-width:1000px; margin:0 auto; padding:0 24px; }

/* ── Hero ── */
.pd-home-hero {
    background:#c0272d;
    background:linear-gradient(135deg,#b02028 0%,#e8383e 100%);
    padding:44px 0 48px;
    border-bottom:3px solid #9a1c22;
}
.pd-home-hero h1 {
    font-size:2.2em;
    font-weight:800;
    color:#fff;
    line-height:1.15;
    margin-bottom:12px;
    max-width:700px;
}
.pd-home-hero h1 em { font-style:normal; color:#ffe0e0; }
.pd-home-hero-sub {
    font-size:1em;
    color:rgba(255,255,255,.88);
    line-height:1.65;
    max-width:620px;
    margin-bottom:28px;
}
.pd-home-hero-btns {
    display:flex; gap:12px; flex-wrap:wrap;
}
.pd-hero-btn {
    display:inline-block;
    padding:13px 26px;
    border-radius:4px;
    font-weight:700;
    font-size:.95em;
    text-decoration:none;
    transition:all .15s;
}
.pd-hero-btn-white {
    background:#fff;
    color:#c0272d;
}
.pd-hero-btn-white:hover { background:#ffe0e0; color:#9a1c22; }
.pd-hero-btn-outline {
    background:transparent;
    color:#fff;
    border:2px solid rgba(255,255,255,.6);
}
.pd-hero-btn-outline:hover { border-color:#fff; background:rgba(255,255,255,.1); }

/* ── Trust strip ── */
.pd-trust {
    background:#f9f9f9;
    border-bottom:1px solid #e0e0e0;
    padding:20px 0;
}
.pd-trust-inner {
    display:flex; gap:0; flex-wrap:wrap;
}
.pd-trust-item {
    display:flex; align-items:flex-start; gap:12px;
    flex:1; min-width:200px;
    padding:4px 24px 4px 0;
    border-right:1px solid #e0e0e0;
    margin-right:24px;
}
.pd-trust-item:last-child { border-right:none; margin-right:0; }
.pd-trust-icon { font-size:1.5em; flex-shrink:0; margin-top:1px; }
.pd-trust-item strong { display:block; font-size:.85em; font-weight:700; color:#222; margin-bottom:2px; }
.pd-trust-item span { font-size:.8em; color:#555; line-height:1.5; }

/* ── Section chrome ── */
.pd-home-section { padding:36px 0; border-bottom:1px solid #eee; }
.pd-home-section:last-of-type { border-bottom:none; }
.pd-section-title {
    font-size:1.3em; font-weight:800; color:#222;
    margin-bottom:6px;
    padding-left:12px;
    border-left:4px solid #e8383e;
}
.pd-section-sub { font-size:.88em; color:#666; margin-bottom:22px; padding-left:16px; line-height:1.6; }

/* ── Country search ── */
.pd-search-wrap {
    background:#fff5f5;
    border:1px solid #f5c6c8;
    border-radius:6px;
    padding:22px 24px;
    margin-bottom:24px;
}
.pd-search-label { font-size:.85em; font-weight:700; color:#444; margin-bottom:8px; display:block; }
.pd-search-row { display:flex; gap:10px; flex-wrap:wrap; }
.pd-search-select {
    flex:1; min-width:200px;
    padding:11px 14px;
    border:1px solid #ccc; border-radius:4px;
    font-size:.95em; font-family:inherit; color:#333;
    background:#fff; cursor:pointer;
    appearance:none;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23666' d='M6 8L0 0h12z'/%3E%3C/svg%3E");
    background-repeat:no-repeat;
    background-position:right 14px center;
    padding-right:36px;
}
.pd-search-select:focus { outline:none; border-color:#e8383e; }
.pd-search-btn {
    background:#e8383e; color:#fff; border:none;
    padding:11px 24px; border-radius:4px;
    font-weight:700; font-size:.95em; cursor:pointer;
    font-family:inherit; white-space:nowrap;
    text-decoration:none; display:inline-flex; align-items:center;
}
.pd-search-btn:hover { background:#c4262b; }

/* ── Country grid ── */
.pd-country-grid {
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(140px, 1fr));
    gap:10px;
}
.pd-country-tile {
    display:flex; align-items:center; gap:10px;
    background:#fff; border:1px solid #e0e0e0; border-radius:4px;
    padding:10px 12px; text-decoration:none; color:#333;
    font-size:.85em; font-weight:600;
    transition:all .15s;
}
.pd-country-tile:hover {
    border-color:#e8383e; color:#e8383e;
    box-shadow:0 2px 6px rgba(232,56,62,.12);
}
.pd-country-tile img {
    width:24px; height:16px; object-fit:cover;
    border:1px solid #ddd; flex-shrink:0;
}
.pd-view-all {
    margin-top:16px; text-align:center;
}
.pd-view-all a {
    display:inline-block;
    padding:10px 24px; border-radius:4px;
    border:1px solid #ccc; color:#333;
    font-size:.88em; font-weight:600; text-decoration:none;
    transition:all .15s;
}
.pd-view-all a:hover { border-color:#e8383e; color:#e8383e; }

/* ── Services cards ── */
.pd-services { display:grid; grid-template-columns:repeat(auto-fit, minmax(260px,1fr)); gap:16px; }
.pd-service-card {
    background:#fff; border:1px solid #ddd; border-radius:6px;
    padding:24px; border-top:3px solid #e8383e;
    display:flex; flex-direction:column;
}
.pd-service-icon { font-size:2em; margin-bottom:12px; }
.pd-service-card h3 { font-size:1.05em; font-weight:700; color:#222; margin-bottom:8px; }
.pd-service-card p { font-size:.87em; color:#555; line-height:1.65; margin-bottom:16px; flex:1; }
.pd-service-features { margin-bottom:18px; }
.pd-service-features span {
    display:block; font-size:.8em; color:#2a7a45;
    font-weight:600; line-height:1.9;
}
.pd-service-features span::before { content:'✓  '; }
.pd-service-link {
    display:block; text-align:center;
    padding:10px 18px; border-radius:4px;
    font-weight:700; font-size:.86em; text-decoration:none;
    background:#e8383e; color:#fff;
    transition:background .15s; margin-top:auto;
}
.pd-service-link:hover { background:#c4262b; color:#fff; }
.pd-service-link-ghost {
    background:#fff; color:#333; border:1px solid #ccc;
}
.pd-service-link-ghost:hover { border-color:#e8383e; color:#e8383e; background:#fff; }

/* ── How it works ── */
.pd-steps-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:20px; }
.pd-step-item { display:flex; flex-direction:column; align-items:flex-start; gap:10px; }
.pd-step-num {
    background:#e8383e; color:#fff;
    width:36px; height:36px; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-weight:800; font-size:1em; flex-shrink:0;
}
.pd-step-item h4 { font-size:.92em; font-weight:700; color:#222; margin-bottom:3px; }
.pd-step-item p { font-size:.83em; color:#666; line-height:1.6; }

/* ── About strip ── */
.pd-about-strip {
    background:#f9f9f9;
    border:1px solid #e0e0e0;
    border-radius:6px;
    padding:28px 32px;
}
.pd-about-strip h3 { font-size:1.1em; font-weight:700; color:#222; margin-bottom:10px; }
.pd-about-strip p { font-size:.88em; color:#555; line-height:1.7; max-width:780px; }

/* ── Responsive ── */
@media(max-width:768px) {
    .pd-home-hero { padding:28px 0 32px; }
    .pd-home-hero h1 { font-size:1.55em; }
    .pd-trust-inner { flex-direction:column; gap:12px; }
    .pd-trust-item { border-right:none; margin-right:0; border-bottom:1px solid #e0e0e0; padding-bottom:12px; }
    .pd-trust-item:last-child { border-bottom:none; }
    .pd-services { grid-template-columns:1fr; }
    .pd-country-grid { grid-template-columns:repeat(auto-fill,minmax(120px,1fr)); }
}
@media(max-width:480px) {
    .pd-container { padding:0 14px; }
    .pd-home-hero h1 { font-size:1.3em; }
    .pd-search-row { flex-direction:column; }
    .pd-search-btn { width:100%; text-align:center; justify-content:center; }
}
</style>

<div class="pd-home">

    <!-- ── HERO ── -->
    <div class="pd-home-hero">
        <div class="pd-container">
            <h1>The <em>Cheapest Way</em> to Call Abroad from the UK</h1>
            <p class="pd-home-hero-sub">We compare every option honestly — access numbers, WhatsApp, VoIP apps, eSIMs and money transfer services. PocketDial has been helping UK residents call abroad for over 20 years.</p>
            <div class="pd-home-hero-btns">
                <a href="/pick-a-country/" class="pd-hero-btn pd-hero-btn-white">Pick a Country →</a>
                <a href="#pd-services" class="pd-hero-btn pd-hero-btn-outline">See All Services</a>
            </div>
        </div>
    </div>

    <!-- ── TRUST STRIP ── -->
    <div class="pd-trust">
        <div class="pd-container">
            <div class="pd-trust-inner">
                <div class="pd-trust-item">
                    <span class="pd-trust-icon">📅</span>
                    <div>
                        <strong>Established 2003</strong>
                        <span>Over 20 years helping UK residents make affordable international calls.</span>
                    </div>
                </div>
                <div class="pd-trust-item">
                    <span class="pd-trust-icon">⚖️</span>
                    <div>
                        <strong>Honest Comparisons</strong>
                        <span>We include free options like WhatsApp because the right answer depends on your situation.</span>
                    </div>
                </div>
                <div class="pd-trust-item">
                    <span class="pd-trust-icon">🌍</span>
                    <div>
                        <strong>268 Countries Covered</strong>
                        <span>Detailed guides for every destination — calls, money transfer and travel data.</span>
                    </div>
                </div>
                <div class="pd-trust-item">
                    <span class="pd-trust-icon">💷</span>
                    <div>
                        <strong>No Account Needed</strong>
                        <span>Our dial-around service works from any UK landline — no registration, no credit card.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── COUNTRY SEARCH ── -->
    <div class="pd-home-section">
        <div class="pd-container">
            <h2 class="pd-section-title">Find Your Country</h2>
            <p class="pd-section-sub">Select a country below for a full comparison of every calling option, money transfer services and travel eSIMs.</p>

            <div class="pd-search-wrap">
                <label class="pd-search-label" for="pd-country-select">Choose a country to call from the UK:</label>
                <div class="pd-search-row">
                    <select class="pd-search-select" id="pd-country-select">
                        <option value="">— Select a country —</option>
                        <?php
                        // Full country list
                        $countries = [
                            'Afghanistan','Albania','Algeria','American Samoa','Andorra','Angola','Anguilla',
                            'Antarctica','Antigua','Argentina','Armenia','Aruba','Ascension Island','Australia',
                            'Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus',
                            'Belgium','Belize','Benin','Bermuda','Bhutan','Bolivia','Bosnia and Herzegovina',
                            'Botswana','Brazil','British Virgin Island','Brunei','Bulgaria','Burkina Faso',
                            'Burma Myanmar','Burundi','Cambodia','Cameroon','Canada','Cape Verde Island',
                            'Cayman Islands','Central African Rep','Chad Republic','Chile','China',
                            'Christmas Island','Cocos Island','Colombia','Comoros','Congo','Cook Islands',
                            'Costa Rica','Croatia','Cuba','Cyprus','Czech Republic','Dem Rep of Congo',
                            'Denmark','Diego Garcia','Djibouti','Dominica','Dominican Republic','East Timor',
                            'Ecuador','Egypt','El Salvador','Equatorial Guinea','Estonia','Ethiopia',
                            'Faroe Islands','Falkland Islands','Fiji Islands','Finland','France',
                            'French Antilles','French Guiana','French Polynesia','Gabon Republic','Gambia',
                            'Georgia','Germany','Ghana','Gibraltar','Greece','Greenland','Grenada',
                            'Guadeloupe','Guam','Guatemala','Guinea','Guinea Bissau','Guyana','Haiti',
                            'Honduras','Hong Kong','Hungary','Iceland','India','Indonesia','Iran','Iraq',
                            'Ireland','Israel','Italy','Ivory Coast','Jamaica','Japan','Jordan','Kazakhstan',
                            'Kenya','Kiribati','Korea North','Korea South','Kuwait','Kyrgyzstan','Laos',
                            'Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania',
                            'Luxembourg','Macao','Macedonia','Madagascar','Malawi','Malaysia','Maldives',
                            'Mali Republic','Malta','Mariana Islands','Marshall Island','Mauritania',
                            'Mauritius','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro',
                            'Montserrat','Morocco','Mozambique','Namibia','Nauru','Nepal','Netherlands',
                            'Netherlands Antilles','New Caledonia','New Zealand','Nicaragua','Niger Republic',
                            'Nigeria','Niue','Norway','Oman','Pakistan','Palau','Palestine','Panama',
                            'Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal',
                            'Puerto Rico','Qatar','Romania','Russia','Rwanda','Samoa','Sao Tome & Principe',
                            'Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore',
                            'Slovakia','Slovenia','Solomon Island','Somalia','South Africa','Spain',
                            'Sri Lanka','St Helena','St Kitts & Nevis','St Lucia','St Pierre & Miquelon',
                            'St Vincent & Grenadines','Sudan','Suriname','Swaziland','Sweden','Switzerland',
                            'Syria','Taiwan','Tajikistan','Tanzania','Thailand','Togo','Tonga','Trinidad',
                            'Tunisia','Turkey','Turkmenistan','Turks & Caicos','Tuvalu','Uganda','Ukraine',
                            'United Arab Emirates','Uruguay','USA','Uzbekistan','Vanuatu','Vatican',
                            'Venezuela','Vietnam','Virgin Islands US','Yemen','Zambia','Zimbabwe'
                        ];
                        foreach ($countries as $c) {
                            $slug = strtolower(str_replace([' ', '&', "'"], ['-', 'and', ''], $c));
                            $slug = preg_replace('/-+/', '-', $slug);
                            echo '<option value="/cheap-phone-calls-' . esc_attr($slug) . '/">' . esc_html($c) . '</option>';
                        }
                        ?>
                    </select>
                    <button class="pd-search-btn" onclick="var s=document.getElementById('pd-country-select');if(s.value){window.location=s.value;}">Go →</button>
                </div>
            </div>

            <!-- Popular countries grid -->
            <div class="pd-country-grid">
                <?php foreach ($topCountries as $name => $data): ?>
                <a href="/cheap-phone-calls-<?php echo esc_attr($data['slug']); ?>/" class="pd-country-tile">
                    <img src="/images/flags/<?php echo esc_attr($data['flag']); ?>.jpg" alt="<?php echo esc_attr($name); ?> flag" loading="lazy">
                    <?php echo esc_html($name); ?>
                </a>
                <?php endforeach; ?>
            </div>
            <div class="pd-view-all">
                <a href="/pick-a-country/">View all 268 countries →</a>
            </div>
        </div>
    </div>

    <!-- ── SERVICES ── -->
    <div class="pd-home-section" id="pd-services">
        <div class="pd-container">
            <h2 class="pd-section-title">Everything You Need to Stay Connected</h2>
            <p class="pd-section-sub">We cover more than just phone calls. Here is everything we can help you with.</p>

            <div class="pd-services">

                <div class="pd-service-card">
                    <div class="pd-service-icon">📞</div>
                    <h3>Cheap International Calls</h3>
                    <p>Whether you're calling from a UK landline or mobile, we compare every option — our own access numbers, WhatsApp, Rebtel and other VoIP apps. The right choice depends on your situation and the person you're calling.</p>
                    <div class="pd-service-features">
                        <span>From a landline — no internet, no account</span>
                        <span>From a mobile — WhatsApp or Rebtel</span>
                        <span>No app needed at the other end with Rebtel</span>
                    </div>
                    <a href="/cheap-international-calls/" class="pd-service-link">Calling from a landline →</a>
                    <a href="/cheap-international-calls-from-mobile/" class="pd-service-link pd-service-link-ghost" style="margin-top:8px;">Calling from a mobile →</a>
                </div>

                <div class="pd-service-card">
                    <div class="pd-service-icon">💸</div>
                    <h3>International Money Transfer</h3>
                    <p>If you're sending money home, your bank is almost certainly the most expensive option. Services like Wise and Remitly use the real mid-market exchange rate with transparent fees — typically saving you 3–5% versus a bank transfer.</p>
                    <div class="pd-service-features">
                        <span>Wise — mid-market rate, no hidden fees</span>
                        <span>Remitly — on-time delivery guarantee</span>
                        <span>Both support the UK–to–world corridor</span>
                    </div>
                    <a href="https://wise.com" class="pd-service-link" rel="nofollow sponsored" target="_blank">Send money with Wise →</a>
                    <a href="https://remitly.com" class="pd-service-link pd-service-link-ghost" rel="nofollow sponsored" target="_blank" style="margin-top:8px;">Send money with Remitly →</a>
                </div>

                <div class="pd-service-card">
                    <div class="pd-service-icon">📱</div>
                    <h3>Travel eSIMs</h3>
                    <p>Travelling abroad? Your UK SIM will charge you significantly for data roaming. An eSIM gives you local data rates from the moment you land — no physical SIM swap, no airport queues, no bill shock.</p>
                    <div class="pd-service-features">
                        <span>Airalo — plans from £3, instant activation</span>
                        <span>Holafly — unlimited data for longer stays</span>
                        <span>Keep your UK number active alongside</span>
                    </div>
                    <a href="https://airalo.com" class="pd-service-link" rel="nofollow sponsored" target="_blank">Get a travel eSIM on Airalo →</a>
                    <a href="https://holafly.com" class="pd-service-link pd-service-link-ghost" rel="nofollow sponsored" target="_blank" style="margin-top:8px;">Unlimited data on Holafly →</a>
                </div>

            </div>
        </div>
    </div>

    <!-- ── HOW IT WORKS ── -->
    <div class="pd-home-section" style="background:#f9f9f9;">
        <div class="pd-container">
            <h2 class="pd-section-title">How to Find the Cheapest Option</h2>
            <p class="pd-section-sub">The right way to call abroad depends on a few simple factors. Here is how to decide.</p>
            <div class="pd-steps-grid">
                <div class="pd-step-item">
                    <div class="pd-step-num">1</div>
                    <div>
                        <h4>Pick your country</h4>
                        <p>Search or browse to find the page for the country you want to call. Each page compares all options side by side.</p>
                    </div>
                </div>
                <div class="pd-step-item">
                    <div class="pd-step-num">2</div>
                    <div>
                        <h4>Does the other person have internet?</h4>
                        <p>If yes, WhatsApp or FaceTime is free. If no — or unreliable — you need a paid option like Rebtel or our access numbers.</p>
                    </div>
                </div>
                <div class="pd-step-item">
                    <div class="pd-step-num">3</div>
                    <div>
                        <h4>Landline or mobile?</h4>
                        <p>UK landline callers get the best rates with dial-around access numbers. UK mobile callers are best served by Rebtel or WhatsApp.</p>
                    </div>
                </div>
                <div class="pd-step-item">
                    <div class="pd-step-num">4</div>
                    <div>
                        <h4>Also sending money?</h4>
                        <p>If you regularly send money home, Wise or Remitly will save you significantly more than any calling service.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── ABOUT STRIP ── -->
    <div class="pd-home-section">
        <div class="pd-container">
            <div class="pd-about-strip">
                <h3>About PocketDial</h3>
                <p>PocketDial has been helping people in the UK make affordable international calls since 2003. We started as a dial-around access number service and have grown into a comprehensive comparison resource — covering every way to call abroad, send money internationally, and stay connected when you travel. We are independent and include free options in our comparisons because giving you the right answer matters more than earning a commission. Our guides cover 268 countries and are updated regularly to reflect the latest rates and services.</p>
            </div>
        </div>
    </div>

</div><!-- .pd-home -->

<script>
// Allow pressing Enter in the select to navigate
document.getElementById('pd-country-select').addEventListener('change', function() {
    if (this.value) window.location = this.value;
});
</script>

<?php get_footer(); ?>
