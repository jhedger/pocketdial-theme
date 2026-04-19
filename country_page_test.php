<?php
/*
Template Name: Country Page TEST
*/

// ============================================================
// 1. COUNTRY NAME — derived from URL
// ============================================================
$url = $_SERVER['REQUEST_URI'];
$countryName = str_replace("cheap-phone-calls-", "", $url);
$countryName = str_replace("/", "", $countryName);
$countryName = str_replace("-", " ", $countryName);
$countryName = ucwords($countryName);

$specialNames = [
    'Usa'                    => 'USA',
    'Uae'                    => 'UAE',
    'Bosnia And Herzegovina' => 'Bosnia & Herzegovina',
];
if (isset($specialNames[$countryName])) {
    $countryName = $specialNames[$countryName];
}

$countryNameCopy = $countryName;
if ($countryName == 'Bosnia & Herzegovina') {
    $countryNameCopy = 'Bosnia & Herz.';
}

$imageName = strtolower(str_replace(' ', '-', $countryName));
$flagPath  = '/images/flags/' . $imageName . '.jpg';

// ============================================================
// 2. RATES — read from XML files
// ============================================================
$landlineToLandlineTelephone = '';
$landlineToLandlineRate      = '';
$landlineToMobileTelephone   = '';
$landlineToMobileRate        = '';
$MobileToLandlineRate        = '';
$MobileToLandlineConnectionCharge = '';
$MobileToMobileRate          = '';
$MobileToMobileConnectionCharge   = '';

function formatAccessNumber($raw) {
    $access = str_replace(' ', '', $raw);
    return substr($access,0,4).' '.substr($access,4,3).' '.substr($access,7,4);
}

function formatRate($rate) {
    $f = number_format(floatval($rate), 1);
    return str_replace('.0', '', $f);
}

$filename = 'xml/justdial-landline.xml';
if (file_exists($filename)) {
    $xml = simplexml_load_file($filename);
    foreach ($xml->Access_Dest_Rates_Comm as $row) {
        $dest = (string)$row->Destination;
        $destClean = str_replace([' (Landline)', ' (Mobile)'], '', $dest);
        if ($destClean == $countryNameCopy) {
            if (strpos($dest, '(Mobile)') !== false) {
                $landlineToMobileTelephone = formatAccessNumber((string)$row->Access_Number);
                $landlineToMobileRate      = formatRate((string)$row->Rate);
            } else {
                $landlineToLandlineTelephone = formatAccessNumber((string)$row->Access_Number);
                $landlineToLandlineRate      = formatRate((string)$row->Rate);
            }
        }
    }
}

$filename = 'xml/topup-mobile.xml';
if (file_exists($filename)) {
    $xml = simplexml_load_file($filename);
    foreach ($xml->T2TRates as $row) {
        $dest = (string)$row->Destination;
        if ($dest == $countryNameCopy) {
            $MobileToLandlineRate             = (string)$row->Rate;
            $MobileToLandlineConnectionCharge = (string)$row->Conn_Chg;
        }
        if ($dest == $countryNameCopy . ' (Mobile)') {
            $MobileToMobileRate             = (string)$row->Rate;
            $MobileToMobileConnectionCharge = (string)$row->Conn_Chg;
        }
    }
}

$bestRate    = $landlineToLandlineRate ?: $MobileToLandlineRate ?: '—';
$dialAvailable = !empty($landlineToLandlineTelephone) || !empty($landlineToMobileTelephone);

// ============================================================
// 3. COUNTRY DATA
// ============================================================
$countryData = [

    // ── SOUTH ASIA ──────────────────────────────────────────────
    'India' => [
        'code'=>'+91','dialPrefix'=>'0091','timezone'=>'IST (UTC+5:30)',
        'timeAhead'=>'+5.5 hrs ahead','bestTime'=>'8am–4pm UK time',
        'timezoneNote'=>'India does not observe daylight saving time. During UK BST (Mar–Oct) the gap narrows to +4.5 hours.',
        'dialNote'=>'Dial 0091 + area code + local number for landlines. For mobiles dial 0091 + the full 10-digit number (starting 6, 7, 8 or 9). Drop any leading zero.',
        'networks'=>'Jio, Airtel, Vi (Vodafone Idea)',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Pakistan','Bangladesh','Sri Lanka','Nepal','UAE','Nigeria','USA'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call India from the UK?','a'=>'If both ends have reliable internet, WhatsApp and FaceTime Audio are free. For UK mobile callers, Rebtel offers rates from around 1–2p/min with no app needed at the India end. For UK landline callers, PocketDial access numbers provide competitive per-minute rates with no account needed.'],
            ['q'=>'How do I dial India from the UK?','a'=>'Dial 0091 then the full number without a leading zero. For a Delhi landline: 0091 11 + the 8-digit local number. For a mobile: 0091 + the 10-digit number (starting 6, 7, 8 or 9).'],
            ['q'=>'What time is it in India when it is noon in the UK?','a'=>'At noon GMT in the UK it is 5:30pm IST in India. During UK BST (March–October) the gap narrows to 4 hours 30 minutes. India does not observe daylight saving time.'],
            ['q'=>'How can I send money to India cheaply from the UK?','a'=>'Wise and Remitly consistently offer the best exchange rates for GBP to INR transfers. Both are significantly cheaper than banks — most UK banks add a 3–5% margin on top of the exchange rate before charging a fee. Wise uses the mid-market rate; Remitly focuses on fast delivery with an on-time guarantee.'],
        ],
    ],
    'Pakistan' => [
        'code'=>'+92','dialPrefix'=>'0092','timezone'=>'PKT (UTC+5)',
        'timeAhead'=>'+5 hrs ahead','bestTime'=>'8am–3pm UK time',
        'timezoneNote'=>'Pakistan Standard Time is UTC+5 and does not observe daylight saving. During UK BST (March–October) the gap narrows to 4 hours.',
        'dialNote'=>'Dial 0092 + area code + local number for landlines. For mobiles dial 0092 + the 10-digit number. Remove any leading zero. Example: Lahore landline 0092 42 + 7-digit number; mobile 0092 300 + 7-digit number.',
        'networks'=>'Jazz, Telenor PK, Zong, Ufone',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['India','Bangladesh','UAE','Saudi Arabia','Afghanistan'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Pakistan from the UK?','a'=>'WhatsApp is free if both ends have internet. For calling people without smartphones or reliable data — which is common in rural Pakistan — Rebtel or PocketDial access numbers work well and arrive as a normal call at the Pakistan end.'],
            ['q'=>'How do I dial Pakistan from the UK?','a'=>'Dial 0092 followed by the area code and local number, removing any leading zero. For mobiles starting with 03xx, dial 0092 3xx followed by the 7-digit number.'],
            ['q'=>'What time is it in Pakistan when it is noon in the UK?','a'=>'At noon GMT it is 5pm PKT in Pakistan. During UK BST (March–October) the gap narrows to 4 hours.'],
            ['q'=>'How can I send money to Pakistan cheaply from the UK?','a'=>'Remitly is particularly strong for UK–Pakistan transfers with competitive rates and fast delivery. Wise is also excellent. Both are far cheaper than using a high street bank. The UK–Pakistan corridor is one of the cheapest globally, with fees sometimes below 1%.'],
        ],
    ],
    'Bangladesh' => [
        'code'=>'+880','dialPrefix'=>'00880','timezone'=>'BST (UTC+6)',
        'timeAhead'=>'+6 hrs ahead','bestTime'=>'7am–2pm UK time',
        'timezoneNote'=>'Bangladesh Standard Time is UTC+6. Bangladesh does not observe daylight saving. During UK BST (March–October) the gap narrows to 5 hours.',
        'dialNote'=>'Dial 00880 + area code + local number for landlines, dropping the leading zero. For mobiles dial 00880 + the 10-digit number (starting 01).',
        'networks'=>'Grameenphone, Robi, Banglalink, Teletalk',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['India','Pakistan','UAE','Saudi Arabia'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Bangladesh from the UK?','a'=>'WhatsApp is free where internet is available on both ends. For calling rural areas or landlines, Rebtel and PocketDial access numbers both offer good per-minute rates. The UK–Bangladesh corridor has slightly higher fees than India or Pakistan, so comparing is worthwhile.'],
            ['q'=>'How do I dial Bangladesh from the UK?','a'=>'Dial 00880 then the number without a leading zero. For a Dhaka landline: 00880 2 + 8-digit number. For a mobile starting with 01: 00880 1 + remaining 9 digits.'],
            ['q'=>'What time is it in Bangladesh when it is noon in the UK?','a'=>'At noon GMT it is 6pm in Bangladesh. During UK BST (March–October) it is 5pm.'],
            ['q'=>'How do I send money to Bangladesh from the UK?','a'=>'Wise and Remitly are the most cost-effective options. Note that Bangladesh has slightly higher average transfer fees than some corridors — comparing both services for your specific amount is worthwhile before sending.'],
        ],
    ],

    // ── AFRICA ──────────────────────────────────────────────────
    'Nigeria' => [
        'code'=>'+234','dialPrefix'=>'00234','timezone'=>'WAT (UTC+1)',
        'timeAhead'=>'+1 hr ahead','bestTime'=>'9am–7pm UK time',
        'timezoneNote'=>'West Africa Time is UTC+1 year-round. Nigeria does not observe daylight saving. During UK BST the gap reduces to zero.',
        'dialNote'=>'Dial 00234 + area code + local number for landlines, dropping the leading zero. For mobiles dial 00234 + the 10-digit number (starting 07, 08 or 09 — drop the leading 0).',
        'networks'=>'MTN Nigeria, Airtel Nigeria, Glo, 9mobile',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Ghana','Kenya','Zimbabwe','USA','India'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Nigeria from the UK?','a'=>'WhatsApp is widely used in Nigeria and free where both ends have internet. For calling to landlines or areas with unreliable internet, Rebtel and PocketDial access numbers both provide competitive rates. Nigeria is one of the top three UK remittance destinations, so coverage is excellent.'],
            ['q'=>'How do I dial Nigeria from the UK?','a'=>'Dial 00234 then the number without the leading zero. For Lagos: 00234 1 + 7-digit number. For a mobile starting 0803: dial 00234 803 + remaining digits.'],
            ['q'=>'What time is it in Nigeria when it is noon in the UK?','a'=>'Nigeria is 1 hour ahead of GMT, so 1pm in Nigeria when it is noon in the UK. During UK BST (March–October) the times are the same.'],
            ['q'=>'How do I send money to Nigeria from the UK?','a'=>'Wise and Remitly are both strong for UK–Nigeria transfers. Remitly has focused heavily on the Nigerian corridor with competitive rates. Nigeria has strict capital controls which can occasionally affect transfer speeds — using a specialist service rather than a bank avoids most delays.'],
        ],
    ],
    'Zimbabwe' => [
        'code'=>'+263','dialPrefix'=>'00263','timezone'=>'CAT (UTC+2)',
        'timeAhead'=>'+2 hrs ahead','bestTime'=>'9am–6pm UK time',
        'timezoneNote'=>'Central Africa Time is UTC+2 year-round. Zimbabwe does not observe daylight saving. During UK BST (March–October) the gap narrows to 1 hour.',
        'dialNote'=>'Dial 00263 + area code + local number for landlines, dropping any leading zero. For mobiles starting with 07: dial 00263 7 + remaining digits.',
        'networks'=>'NetOne, Econet, Telecel',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Nigeria','South Africa','Kenya','UAE'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Zimbabwe from the UK?','a'=>'WhatsApp is widely used in Zimbabwe and free over internet. For landlines or areas with poor connectivity, PocketDial access numbers and Rebtel both offer good rates. The UK–Zimbabwe corridor is smaller than India or Pakistan, so access number availability may vary.'],
            ['q'=>'How do I dial Zimbabwe from the UK?','a'=>'Dial 00263 + the number without a leading zero. For Harare: 00263 4 + 6 or 7-digit number. For a mobile starting 077: dial 00263 77 + remaining digits.'],
            ['q'=>'How do I send money to Zimbabwe from the UK?','a'=>'Zimbabwe received £592 million in remittances from the UK in 2024, making it a well-served corridor. Wise and Remitly are both options. Note that Zimbabwe has used multiple currencies — confirm the delivery currency with your provider before sending.'],
        ],
    ],

    // ── MIDDLE EAST ─────────────────────────────────────────────
    'UAE' => [
        'code'=>'+971','dialPrefix'=>'00971','timezone'=>'GST (UTC+4)',
        'timeAhead'=>'+4 hrs ahead','bestTime'=>'8am–5pm UK time',
        'timezoneNote'=>'Gulf Standard Time is UTC+4 year-round. UAE does not observe daylight saving. During UK BST (March–October) the gap narrows to 3 hours.',
        'dialNote'=>'Dial 00971 + emirate code + local number for landlines, dropping the leading zero. Dubai: 00971 4 + 7-digit number. Abu Dhabi: 00971 2 + 7-digit number. Mobiles: 00971 5x + 7-digit number.',
        'networks'=>'Etisalat (e&), du',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['India','Pakistan','Saudi Arabia','Egypt','Bangladesh'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call UAE from the UK?','a'=>'WhatsApp is extremely widely used in the UAE and free over WiFi. For business calls to UAE landlines, Rebtel offers competitive rates. Note that calling costs from UK to UAE are generally higher than South Asian destinations.'],
            ['q'=>'How do I dial UAE from the UK?','a'=>'Dial 00971 then the local number without the leading zero. Dubai landlines: 00971 4 + 7-digit number. Abu Dhabi: 00971 2 + 7-digit number. Mobiles start 050, 052, 055 or 056.'],
            ['q'=>'What time is it in UAE when it is noon in the UK?','a'=>'The UAE is 4 hours ahead of GMT, so 4pm in Dubai when it is noon in the UK. During UK BST (March–October) the gap narrows to 3 hours.'],
        ],
    ],
    'Iran' => [
        'code'=>'+98','dialPrefix'=>'0098','timezone'=>'IRST (UTC+3:30)',
        'timeAhead'=>'+3.5 hrs ahead','bestTime'=>'9am–5pm UK time',
        'timezoneNote'=>'Iran Standard Time is UTC+3:30 in winter and UTC+4:30 during Iranian daylight saving (March–September). This can create unusual time differences with the UK.',
        'dialNote'=>'Dial 0098 + area code + local number for landlines, dropping the leading zero. Tehran: 0098 21 + 8-digit number. Mobiles start with 09 — dial 0098 9 + remaining digits.',
        'networks'=>'MCI (Hamrahe Aval), Irancell (MCI Rightel)',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['UAE','Turkey','Afghanistan'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Iran from the UK?','a'=>'WhatsApp works in Iran though speeds can be unreliable due to network restrictions. For reliable connections to Iranian landlines and mobiles, Rebtel and PocketDial access numbers both offer per-minute rates significantly cheaper than calling direct.'],
            ['q'=>'How do I dial Iran from the UK?','a'=>'Dial 0098 then the number without the leading zero. Tehran: 0098 21 + 8-digit number. Mobile: 0098 9xx + remaining digits.'],
        ],
    ],

    // ── EUROPE ──────────────────────────────────────────────────
    'Spain' => [
        'code'=>'+34','dialPrefix'=>'0034','timezone'=>'CET (UTC+1) / CEST (UTC+2)',
        'timeAhead'=>'+1 hr ahead','bestTime'=>'9am–8pm UK time',
        'timezoneNote'=>'Spain is 1 hour ahead of UK in winter (CET) and 2 hours ahead in summer when both are on summer time. Clocks change on the same day, so the difference stays 1 hour year-round.',
        'dialNote'=>'Spain has no area codes. Dial 0034 + the 9-digit number directly. Landlines start with 9; mobiles start with 6 or 7.',
        'networks'=>'Movistar, Orange, Vodafone ES, MásMóvil',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['France','Poland','Germany','Portugal'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Spain from the UK?','a'=>'WhatsApp is very widely used in Spain. For calling Spanish landlines or mobiles from a UK landline, PocketDial access numbers and Rebtel both offer good rates — far cheaper than dialling direct on a UK mobile.'],
            ['q'=>'How do I dial Spain from the UK?','a'=>'Dial 0034 + the full 9-digit Spanish number. There are no area codes to worry about — the 9-digit number is dialled in full. Landlines start with 9; mobiles start with 6 or 7.'],
            ['q'=>'What time is it in Spain when it is noon in the UK?','a'=>'Spain is 1 hour ahead year-round (both countries move their clocks on the same weekend). So 1pm in Spain when it is noon in the UK.'],
        ],
    ],
    'France' => [
        'code'=>'+33','dialPrefix'=>'0033','timezone'=>'CET (UTC+1) / CEST (UTC+2)',
        'timeAhead'=>'+1 hr ahead','bestTime'=>'9am–8pm UK time',
        'timezoneNote'=>'France is 1 hour ahead of the UK year-round. Both countries observe summer time (clocks change on the same day), so the 1-hour difference is constant.',
        'dialNote'=>'Dial 0033 + the 9-digit number without the leading zero. French numbers are 10 digits starting with 0 — remove the 0 and dial the remaining 9. Paris: 0033 1 + 8-digit number.',
        'networks'=>'Orange, SFR, Bouygues Telecom, Free Mobile',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Spain','Germany','Belgium','Switzerland'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call France from the UK?','a'=>'For calls to French mobiles or landlines from a UK landline, PocketDial access numbers and Rebtel offer good rates. WhatsApp is widely used in France for free calls where both ends have internet.'],
            ['q'=>'How do I dial France from the UK?','a'=>'Dial 0033 then the 9-digit number without a leading zero. All French numbers are 10 digits starting with 0 — remove the 0, then dial 0033 + the remaining 9 digits.'],
        ],
    ],
    'Poland' => [
        'code'=>'+48','dialPrefix'=>'0048','timezone'=>'CET (UTC+1) / CEST (UTC+2)',
        'timeAhead'=>'+1 hr ahead','bestTime'=>'9am–8pm UK time',
        'timezoneNote'=>'Poland is 1 hour ahead of the UK year-round. Both observe summer time on the same day.',
        'dialNote'=>'Dial 0048 + the 9-digit number without any leading zero. Polish mobile numbers start with 5, 6, 7 or 8. Landlines include the regional code within the 9-digit number.',
        'networks'=>'Orange PL, Plus, Play, T-Mobile PL',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Germany','Czech Republic','Slovakia','France'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Poland from the UK?','a'=>'With a large Polish diaspora in the UK, calls to Poland are very common. WhatsApp is widely used. For UK landline callers, PocketDial access numbers are a cost-effective option. Rebtel is popular for UK mobile callers wanting low per-minute rates.'],
            ['q'=>'How do I dial Poland from the UK?','a'=>'Dial 0048 + the 9-digit Polish number (no leading zero to remove). Polish mobile numbers start with 5, 6, 7 or 8.'],
            ['q'=>'Can I send money to Poland from the UK?','a'=>'Yes — Wise is particularly strong for GBP to PLN transfers, using the mid-market rate. Wise also has a local Polish bank account which speeds up delivery significantly.'],
        ],
    ],
    'Greece' => [
        'code'=>'+30','dialPrefix'=>'0030','timezone'=>'EET (UTC+2) / EEST (UTC+3)',
        'timeAhead'=>'+2 hrs ahead','bestTime'=>'9am–7pm UK time',
        'timezoneNote'=>'Greece is 2 hours ahead of UK in winter and 3 hours ahead in summer (UK BST period). Both countries change clocks on the same weekend in spring and autumn.',
        'dialNote'=>'Dial 0030 + the 10-digit Greek number. Greek numbers are 10 digits with no separate area code to remove. Mobiles start with 69; Athens landlines start with 21.',
        'networks'=>'Cosmote, Vodafone GR, WIND Hellas',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Cyprus','Turkey','Italy','Spain'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Greece from the UK?','a'=>'WhatsApp is very widely used in Greece. For UK landline callers, PocketDial access numbers offer competitive rates to Greek landlines and mobiles. Rebtel is a good option for UK mobile callers.'],
            ['q'=>'How do I dial Greece from the UK?','a'=>'Dial 0030 + the full 10-digit Greek number. Athens landlines start with 21; Thessaloniki with 231; mobiles start with 69.'],
            ['q'=>'What time is it in Greece when it is noon in the UK?','a'=>'Greece is 2 hours ahead in winter (2pm in Athens at UK noon) and 3 hours ahead during UK BST — though Greek clocks also move forward at the same time, so it stays at 2 hours ahead throughout.'],
        ],
    ],
    'Turkey' => [
        'code'=>'+90','dialPrefix'=>'0090','timezone'=>'TRT (UTC+3)',
        'timeAhead'=>'+3 hrs ahead','bestTime'=>'8am–5pm UK time',
        'timezoneNote'=>'Turkey uses UTC+3 year-round and no longer observes daylight saving. During UK BST (March–October) the gap narrows to 2 hours.',
        'dialNote'=>'Dial 0090 + area code + local number for landlines, dropping the leading zero. Istanbul: 0090 212 or 0090 216 + 7-digit number. Mobiles start with 05xx — dial 0090 5 + remaining digits.',
        'networks'=>'Turkcell, Vodafone TR, Türk Telekom',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Greece','Cyprus','Iran','UAE','Germany'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Turkey from the UK?','a'=>'WhatsApp is very widely used in Turkey. For UK landline callers, PocketDial access numbers and Rebtel are both cost-effective. Turkey is currently one of PocketDial\'s pages with the highest growth potential — ranking near page 1 for several key queries.'],
            ['q'=>'How do I dial Turkey from the UK?','a'=>'Dial 0090 + area code + local number without leading zero. Istanbul landlines: 0090 212 or 216 + 7-digit number. Mobiles: 0090 5xx + 7-digit number.'],
            ['q'=>'What time is it in Turkey when it is noon in the UK?','a'=>'Turkey is 3 hours ahead of GMT year-round. So 3pm in Istanbul at noon UK time (GMT). During UK BST the gap reduces to 2 hours.'],
            ['q'=>'How do I send money to Turkey from the UK?','a'=>'Wise offers GBP to TRY transfers at the mid-market rate. Given the Turkish lira has experienced significant exchange rate movements, using a service that shows fees upfront — not embedded in the rate — is particularly important.'],
        ],
    ],
    'Cyprus' => [
        'code'=>'+357','dialPrefix'=>'00357','timezone'=>'EET (UTC+2) / EEST (UTC+3)',
        'timeAhead'=>'+2 hrs ahead','bestTime'=>'9am–7pm UK time',
        'timezoneNote'=>'Cyprus is 2 hours ahead of UK in winter. Both countries observe summer time on the same weekend, so the gap stays at 2 hours in summer too.',
        'dialNote'=>'Dial 00357 + the 8-digit Cypriot number. There are no area codes — dial 00357 then the full 8-digit number directly.',
        'networks'=>'CYTA, MTN Cyprus, Epic',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Greece','Turkey','UAE','Israel'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Cyprus from the UK?','a'=>'WhatsApp is widely used in Cyprus. For UK landline callers, PocketDial access numbers are a cost-effective option. Cyprus is one of PocketDial\'s near-page-1 pages — a good CTR target.'],
            ['q'=>'How do I dial Cyprus from the UK?','a'=>'Dial 00357 + the full 8-digit number. Cyprus has no area codes — all numbers are 8 digits dialled in full after the country code.'],
        ],
    ],
    'Israel' => [
        'code'=>'+972','dialPrefix'=>'00972','timezone'=>'IST (UTC+2) / IDT (UTC+3)',
        'timeAhead'=>'+2 hrs ahead','bestTime'=>'9am–6pm UK time',
        'timezoneNote'=>'Israel Standard Time is UTC+2. Israel observes daylight saving (IDT, UTC+3) from late March to late October, which does not always align exactly with UK clock changes.',
        'dialNote'=>'Dial 00972 + area code + local number, removing the leading zero. Jerusalem/Tel Aviv landlines: 00972 2 or 3 + 7-digit number. Mobiles: 00972 5x + 8-digit number.',
        'networks'=>'Partner, Cellcom, Hot Mobile, Bezeq',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Cyprus','Turkey','UAE','Egypt'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Israel from the UK?','a'=>'WhatsApp is very widely used in Israel. For calling Israeli landlines and mobiles from a UK landline or mobile, Rebtel and PocketDial access numbers both offer competitive per-minute rates.'],
            ['q'=>'How do I dial Israel from the UK?','a'=>'Dial 00972 + number without leading zero. Tel Aviv: 00972 3 + 7 digits. Jerusalem: 00972 2 + 7 digits. Mobiles: 00972 5x + 8 digits.'],
        ],
    ],
    'Albania' => [
        'code'=>'+355','dialPrefix'=>'00355','timezone'=>'CET (UTC+1) / CEST (UTC+2)',
        'timeAhead'=>'+1 hr ahead','bestTime'=>'9am–8pm UK time',
        'timezoneNote'=>'Albania is 1 hour ahead of the UK year-round.',
        'dialNote'=>'Dial 00355 + area code + local number, removing the leading zero. Tirana: 00355 4 + 7-digit number. Mobiles start with 06 — dial 00355 6 + remaining digits.',
        'networks'=>'Vodafone AL, ONE Telecommunications, Albtelecom',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Greece','Italy','Kosovo','Turkey'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Albania from the UK?','a'=>'WhatsApp is widely used. For UK landline and mobile callers, PocketDial access numbers and Rebtel offer competitive per-minute rates. Albania is one of PocketDial\'s near-page-1 pages for SEO — currently ranking at position 11.'],
            ['q'=>'How do I dial Albania from the UK?','a'=>'Dial 00355 + number without leading zero. Tirana: 00355 4 + 7-digit number. Mobiles: 00355 6x + 8 digits.'],
        ],
    ],
    'Finland' => [
        'code'=>'+358','dialPrefix'=>'00358','timezone'=>'EET (UTC+2) / EEST (UTC+3)',
        'timeAhead'=>'+2 hrs ahead','bestTime'=>'9am–6pm UK time',
        'timezoneNote'=>'Finland is 2 hours ahead of the UK in winter and 3 hours in summer (both observe daylight saving on the same day, so it stays 2 hours apart).',
        'dialNote'=>'Dial 00358 + area code + local number, removing the leading zero. Helsinki: 00358 9 + 7 or 8-digit number. Mobiles: 00358 4x or 5x + number.',
        'networks'=>'Elisa, Telia Finland, DNA',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Sweden','Norway','Germany','Estonia'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Finland from the UK?','a'=>'WhatsApp and other VoIP apps are widely used in Finland. For UK landline callers, PocketDial access numbers and Rebtel both offer good rates. Finland is one of PocketDial\'s closest-to-page-1 pages — currently at position 9.'],
            ['q'=>'How do I dial Finland from the UK?','a'=>'Dial 00358 + number without leading zero. Helsinki: 00358 9 + number. Mobiles: 00358 40, 41, 44, 45, 50 or similar + number.'],
        ],
    ],

    // ── ASIA PACIFIC ────────────────────────────────────────────
    'Australia' => [
        'code'=>'+61','dialPrefix'=>'0061','timezone'=>'AEST/AEDT/ACST/AWST (varies by state)',
        'timeAhead'=>'+10 to +11 hrs (east) / +8 hrs (Perth)','bestTime'=>'7am–11am UK time (for east coast)',
        'timezoneNote'=>'Australia has multiple time zones. Sydney/Melbourne are UTC+10 (AEST) or UTC+11 (AEDT in summer). Perth is UTC+8 year-round. Australia\'s summer is UK\'s winter — when UK clocks go back in October, the gap to Sydney increases.',
        'dialNote'=>'Dial 0061 + area code + local number for landlines, removing the leading zero. Sydney/NSW: 0061 2 + 8-digit number. Melbourne/VIC: 0061 3 + 8-digit number. Mobiles: 0061 4xx + 8-digit number.',
        'networks'=>'Telstra, Optus, Vodafone AU',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['New Zealand','UK','South Africa','USA','Canada'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Australia from the UK?','a'=>'WhatsApp is widely used in Australia and free over WiFi. For UK landline callers, PocketDial access numbers offer competitive rates. For UK mobile callers, Rebtel routes calls cheaply without the person in Australia needing any app.'],
            ['q'=>'How do I dial Australia from the UK?','a'=>'Dial 0061 + area code + local number without leading zero. Sydney: 0061 2 + 8 digits. Melbourne: 0061 3 + 8 digits. Brisbane: 0061 7 + 8 digits. Mobiles: 0061 4xx + 8 digits.'],
            ['q'=>'What time is it in Australia when it is noon in the UK?','a'=>'It depends on the state. Sydney/Melbourne (east coast): 10pm–11pm same day in winter, 11pm–midnight in UK summer (the gap changes because Australia\'s summer months are UK winter months). Perth: 8pm same day year-round. The gap is significant — calling at breakfast UK time reaches Australian evenings.'],
            ['q'=>'How do I send money to Australia from the UK?','a'=>'Wise is strong for GBP to AUD and one of the cheapest options. Remitly also covers the corridor well. Both use mid-market rates — check both for your specific amount as the cheapest option varies.'],
        ],
    ],
    'China' => [
        'code'=>'+86','dialPrefix'=>'0086','timezone'=>'CST (UTC+8)',
        'timeAhead'=>'+8 hrs ahead','bestTime'=>'7am–12pm UK time',
        'timezoneNote'=>'China uses a single time zone (CST, UTC+8) across the entire country despite its geographic size. During UK BST (March–October) the gap narrows to 7 hours.',
        'dialNote'=>'Dial 0086 + area code + local number for landlines, dropping the leading zero. Beijing: 0086 10 + 8-digit number. Shanghai: 0086 21 + 8-digit number. Mobiles: 0086 + the full 11-digit number.',
        'networks'=>'China Mobile, China Unicom, China Telecom',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Japan','South Korea','Taiwan','Hong Kong','Australia'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call China from the UK?','a'=>'Many calling apps including WhatsApp are restricted in mainland China. WeChat is widely used there and is free for WeChat-to-WeChat calls. For calling Chinese landlines and mobiles from the UK, Rebtel and PocketDial access numbers are reliable as they do not depend on the person having internet access.'],
            ['q'=>'How do I dial China from the UK?','a'=>'Dial 0086 + area code + local number without leading zero. Beijing: 0086 10 + 8-digit number. Shanghai: 0086 21 + 8-digit number. Mobiles: 0086 + 11-digit number (starting 13x, 14x, 15x, 17x, 18x).'],
            ['q'=>'What time is it in China when it is noon in the UK?','a'=>'China is 8 hours ahead of GMT. At noon in the UK it is 8pm in Beijing. During UK BST the gap narrows to 7 hours.'],
            ['q'=>'Can I use WhatsApp to call China?','a'=>'WhatsApp is blocked in mainland China without a VPN. WeChat is the most practical free option for calling someone in mainland China. For calling landlines or people without internet access, Rebtel and PocketDial access numbers both work reliably.'],
        ],
    ],
    'Thailand' => [
        'code'=>'+66','dialPrefix'=>'0066','timezone'=>'ICT (UTC+7)',
        'timeAhead'=>'+7 hrs ahead','bestTime'=>'7am–2pm UK time',
        'timezoneNote'=>'Thailand uses Indochina Time (UTC+7) year-round. During UK BST (March–October) the gap narrows to 6 hours.',
        'dialNote'=>'Dial 0066 + area code + local number for landlines, removing the leading zero. Bangkok: 0066 2 + 7 or 8-digit number. Mobiles: 0066 + the 9-digit number (starting 06, 08 or 09 — remove the leading 0).',
        'networks'=>'AIS, DTAC (True Move H), NT',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Malaysia','Philippines','Vietnam','Singapore','Australia'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call Thailand from the UK?','a'=>'WhatsApp is widely used in Thailand and free over internet. LINE is also popular. For calling Thai landlines or mobiles from a UK landline, PocketDial access numbers are cost-effective. Note: PocketDial\'s Thailand page had 1,241 impressions with zero clicks in recent GSC data — check the page is loading correctly.'],
            ['q'=>'How do I dial Thailand from the UK?','a'=>'Dial 0066 + number without leading zero. Bangkok: 0066 2 + 7 or 8-digit number. Mobiles starting 08 or 06: dial 0066 8 or 6 + remaining digits.'],
            ['q'=>'What time is it in Thailand when it is noon in the UK?','a'=>'Thailand is 7 hours ahead of GMT, so 7pm in Bangkok at noon in the UK. During UK BST the gap reduces to 6 hours.'],
        ],
    ],

    // ── AMERICAS ─────────────────────────────────────────────────
    'USA' => [
        'code'=>'+1','dialPrefix'=>'001','timezone'=>'Multiple (EST/CST/MST/PST)',
        'timeAhead'=>'-5 to -8 hrs behind','bestTime'=>'1pm–8pm UK time (for east coast)',
        'timezoneNote'=>'The US has four main time zones. New York/East Coast: EST (UTC-5) or EDT (UTC-4 in summer). Chicago: CST/CDT. Mountain: MST/MDT. Los Angeles/West Coast: PST (UTC-8) or PDT (UTC-7 in summer). US and UK summer time changes happen on different dates, which briefly alters the gap each spring and autumn.',
        'dialNote'=>'Dial 001 + area code + 7-digit local number. US numbers are always 10 digits after the country code (3-digit area code + 7-digit number). Mobile numbers follow the same format as landlines.',
        'networks'=>'Verizon, AT&T, T-Mobile US',
        'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
        'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
        'related'=>['Canada','Australia','Mexico','Jamaica'],
        'faq'=>[
            ['q'=>'What is the cheapest way to call USA from the UK?','a'=>'WhatsApp and FaceTime are both widely used in the US and free over internet. For UK landline callers needing to reach US landlines or mobiles without internet, PocketDial access numbers and Rebtel offer competitive per-minute rates.'],
            ['q'=>'How do I dial USA from the UK?','a'=>'Dial 001 + the 10-digit US number (3-digit area code + 7-digit number). Example: New York 001 212 + 7-digit number. There is no leading zero to remove.'],
            ['q'=>'What time is it in New York when it is noon in the UK?','a'=>'New York (East Coast) is 5 hours behind GMT — 7am in New York when it is noon in the UK. During US and UK summer time the gap may briefly vary. Los Angeles is 8 hours behind — 4am in LA at UK noon.'],
        ],
    ],

]; // end $countryData

$cd = isset($countryData[$countryName]) ? $countryData[$countryName] : [
    'code'=>'','dialPrefix'=>'','timezone'=>'','timeAhead'=>'','bestTime'=>'',
    'timezoneNote'=>'','dialNote'=>'Dial 00 + the country code + the full local number (omitting any leading zero).',
    'networks'=>'',
    'wiseLink'=>'https://wise.com','remitlyLink'=>'https://remitly.com',
    'airaloLink'=>'https://airalo.com','holaLink'=>'https://holafly.com','rebtelLink'=>'https://rebtel.com',
    'related'=>[],
    'faq'=>[
        ['q'=>'What is the cheapest way to call '.$countryName.' from the UK?','a'=>'If both ends have reliable internet, WhatsApp and similar apps are free. For UK landline callers, PocketDial access numbers offer competitive per-minute rates with no account needed. For mobile callers, Rebtel is a strong option.'],
        ['q'=>'How do I dial '.$countryName.' from the UK?','a'=>'Dial 00 followed by the country code for '.$countryName.', then the full local number omitting any leading zero.'],
        ['q'=>'Can I send money to '.$countryName.' from the UK?','a'=>'Wise and Remitly both offer competitive exchange rates for international transfers, significantly better than banks. Both deliver funds quickly and have good mobile apps.'],
    ],
];

// ============================================================
// 4. SEO
// ============================================================
$metaTitle = 'Cheapest Way to Call '.$countryName.' from UK (2026) | PocketDial';
$metaDesc  = 'Compare every way to call '.$countryName.' from the UK'.($bestRate!=='—'?' — rates from '.$bestRate.'p/min':'').'. Access numbers, WhatsApp, VoIP apps & eSIMs compared honestly. No account needed.';

$faqSchema = ['@context'=>'https://schema.org','@type'=>'FAQPage','mainEntity'=>[]];
foreach ($cd['faq'] as $f) {
    $faqSchema['mainEntity'][] = ['@type'=>'Question','name'=>$f['q'],'acceptedAnswer'=>['@type'=>'Answer','text'=>$f['a']]];
}
$breadcrumbSchema = ['@context'=>'https://schema.org','@type'=>'BreadcrumbList','itemListElement'=>[
    ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>'https://www.pocketdial.com/'],
    ['@type'=>'ListItem','position'=>2,'name'=>'Pick a Country','item'=>'https://www.pocketdial.com/pick-a-country/'],
    ['@type'=>'ListItem','position'=>3,'name'=>'Call '.$countryName,'item'=>'https://www.pocketdial.com'.$_SERVER['REQUEST_URI']],
]];

$updatedDate = date('F Y');

$flagEmojis = ['India'=>'🇮🇳','Pakistan'=>'🇵🇰','Bangladesh'=>'🇧🇩','Nigeria'=>'🇳🇬','USA'=>'🇺🇸','Australia'=>'🇦🇺','China'=>'🇨🇳','Poland'=>'🇵🇱','Spain'=>'🇪🇸','France'=>'🇫🇷','Turkey'=>'🇹🇷','Iran'=>'🇮🇷','Zimbabwe'=>'🇿🇼','Israel'=>'🇮🇱','Greece'=>'🇬🇷','Cyprus'=>'🇨🇾','UAE'=>'🇦🇪','Albania'=>'🇦🇱','Finland'=>'🇫🇮','Zambia'=>'🇿🇲','Russia'=>'🇷🇺','Japan'=>'🇯🇵','Germany'=>'🇩🇪','Italy'=>'🇮🇹','Canada'=>'🇨🇦','Brazil'=>'🇧🇷','Philippines'=>'🇵🇭'];
$flagEmoji = isset($flagEmojis[$countryName]) ? $flagEmojis[$countryName] : '🌍';
?>
<?php get_header(); ?>
<script type="application/ld+json"><?php echo json_encode($faqSchema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); ?></script>
<script type="application/ld+json"><?php echo json_encode($breadcrumbSchema, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); ?></script>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<style>
/* ============================================================
   POCKETDIAL v2 — Full-width country page
   Escapes Twenty Eleven's content column entirely
   ============================================================ */

/* — Full width escape — */
body.page-template-country_page_test #page,
body.page-template-country_page #page { max-width:100% !important; }

body.page-template-country_page_test #main,
body.page-template-country_page #main,
body.page-template-country_page_test .site-content,
body.page-template-country_page .site-content,
body.page-template-country_page_test #content,
body.page-template-country_page #content { 
    width:100% !important; max-width:100% !important; 
    margin:0 !important; padding:0 !important; float:none !important; 
}

body.page-template-country_page_test #secondary,
body.page-template-country_page #secondary { display:none !important; }

body.page-template-country_page_test .entry-header,
body.page-template-country_page .entry-header,
body.page-template-country_page_test .entry-content > *:not(.pd-page),
body.page-template-country_page .entry-content > *:not(.pd-page) { display:none !important; }

body.page-template-country_page_test .entry-content,
body.page-template-country_page .entry-content { 
    padding:0 !important; margin:0 !important; max-width:100% !important; 
}

/* — Reset inside our wrapper — */
.pd-page *, .pd-page *::before, .pd-page *::after { box-sizing:border-box; margin:0; padding:0; }
.pd-page { 
    font-family:'Outfit',sans-serif; color:#1c1c2e; line-height:1.65;
    background:#f8f7f4;
}

/* — Layout container — */
.pd-container { max-width:1100px; margin:0 auto; padding:0 24px; }
.pd-container-narrow { max-width:780px; margin:0 auto; padding:0 24px; }

/* — Top bar — */
.pd-topbar {
    background:#fff; border-bottom:1px solid #eee;
    padding:12px 0;
}
.pd-topbar-inner {
    max-width:1100px; margin:0 auto; padding:0 24px;
    display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;
}
.pd-breadcrumb { font-size:.82em; color:#999; }
.pd-breadcrumb a { color:#999; text-decoration:none; }
.pd-breadcrumb a:hover { color:#e8383e; }
.pd-breadcrumb span { margin:0 5px; }
.pd-updated-badge {
    display:inline-flex; align-items:center; gap:6px;
    background:#f0faf4; border:1px solid #b7e4c7; border-radius:20px;
    padding:4px 12px; font-size:.78em; font-weight:600; color:#1a6b3a;
}
.pd-updated-badge::before { content:'✓'; }

/* — HERO — */
.pd-hero {
    background:#1c1c2e;
    padding:72px 0 60px;
    position:relative;
    overflow:hidden;
}
.pd-hero::before {
    content:'';
    position:absolute; inset:0;
    background:radial-gradient(ellipse at 80% 50%, rgba(232,56,62,.25) 0%, transparent 65%);
}
.pd-hero-flag-bg {
    position:absolute; right:5%; top:50%; transform:translateY(-50%);
    font-size:min(200px, 22vw); opacity:.07; line-height:1; pointer-events:none;
    user-select:none;
}
.pd-hero-inner { position:relative; z-index:1; }
.pd-hero-eyebrow {
    display:inline-flex; align-items:center; gap:8px;
    background:rgba(232,56,62,.15); border:1px solid rgba(232,56,62,.3);
    border-radius:20px; padding:5px 14px;
    font-size:.75em; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;
    color:rgba(255,255,255,.7); margin-bottom:20px;
}
.pd-hero h1 {
    font-family:'Playfair Display',serif;
    font-size:clamp(2em, 4.5vw, 3.2em);
    font-weight:700; line-height:1.15;
    color:#ffffff;
    max-width:700px; margin-bottom:18px;
}
.pd-hero h1 em { font-style:italic; color:#e8383e; }
.pd-hero-sub {
    font-size:1.05em; color:rgba(255,255,255,.6);
    max-width:520px; margin-bottom:36px; line-height:1.6;
}
.pd-hero-stats {
    display:flex; gap:0; flex-wrap:wrap;
    background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.1);
    border-radius:14px; overflow:hidden; width:fit-content;
}
.pd-hero-stat {
    padding:18px 28px; border-right:1px solid rgba(255,255,255,.1);
}
.pd-hero-stat:last-child { border-right:none; }
.pd-hero-stat strong { display:block; font-size:1.6em; font-weight:800; color:#fff; line-height:1; }
.pd-hero-stat span { font-size:.72em; color:rgba(255,255,255,.5); font-weight:500; margin-top:3px; display:block; }

/* — Section layout — */
.pd-body { padding:48px 0 64px; }
.pd-section { margin-bottom:56px; }
.pd-section-header { margin-bottom:20px; }
.pd-section-header h2 {
    font-family:'Playfair Display',serif;
    font-size:1.75em; font-weight:700; color:#1c1c2e; margin-bottom:6px;
}
.pd-section-header p { color:#666; font-size:.95em; line-height:1.6; }

/* — Comparison table — */
.pd-table-wrap {
    background:#fff; border-radius:16px;
    box-shadow:0 2px 24px rgba(0,0,0,.07);
    overflow:hidden;
}
.pd-table { width:100%; border-collapse:collapse; font-size:.9em; }
.pd-table thead tr { background:#1c1c2e; }
.pd-table th {
    padding:14px 18px; text-align:left; color:#fff;
    font-size:.75em; font-weight:700; letter-spacing:.8px; text-transform:uppercase;
}
.pd-table td { padding:15px 18px; border-bottom:1px solid #f2f2f2; vertical-align:middle; }
.pd-table tr:last-child td { border-bottom:none; }
.pd-table tbody tr:hover td { background:#fef9f9; }
.pd-table tbody tr:first-child td { background:#f9fff9; }
.pd-method { font-weight:600; color:#1c1c2e; }
.pd-method small { display:block; font-weight:400; color:#999; font-size:.83em; margin-top:2px; }
.pd-rate-val { font-weight:800; color:#e8383e; font-size:1.05em; }
.pd-pill {
    display:inline-block; padding:4px 12px; border-radius:20px;
    font-size:.75em; font-weight:700; white-space:nowrap;
}
.pd-pill-green  { background:#e6f9ee; color:#1a6b3a; }
.pd-pill-blue   { background:#e8f0fe; color:#1a56b0; }
.pd-pill-amber  { background:#fff8e6; color:#8a5e00; }
.pd-pill-red    { background:#feeaeb; color:#9b1c22; }

/* — Dial box — */
.pd-dialbox { border-radius:16px; padding:36px 40px; margin-bottom:56px; }
.pd-dialbox-live {
    background:linear-gradient(135deg, #1c1c2e 0%, #2d2d4e 100%);
    box-shadow:0 8px 32px rgba(28,28,46,.25);
    color:#fff;
}
.pd-dialbox-offline {
    background:#fff; border:2px dashed #d0d0d8; color:#1c1c2e;
}
.pd-dialbox h3 {
    font-family:'Playfair Display',serif;
    font-size:1.3em; font-weight:700; margin-bottom:8px;
}
.pd-dialbox-live h3 { color:#fff; }
.pd-dialbox-offline h3 { color:#1c1c2e; }
.pd-dialbox-desc { font-size:.9em; margin-bottom:24px; }
.pd-dialbox-live .pd-dialbox-desc { color:rgba(255,255,255,.55); }
.pd-dialbox-offline .pd-dialbox-desc { color:#666; }
.pd-numbers { display:flex; flex-wrap:wrap; gap:10px; margin-bottom:22px; }
.pd-number {
    background:rgba(255,255,255,.08); border:1px solid rgba(255,255,255,.15);
    border-radius:10px; padding:12px 22px;
    font-size:1.1em; font-weight:700; letter-spacing:1.5px; color:#ffd166;
    font-variant-numeric:tabular-nums;
}
.pd-steps { display:flex; flex-wrap:wrap; gap:16px; font-size:.88em; }
.pd-step { display:flex; align-items:flex-start; gap:10px; color:rgba(255,255,255,.75); }
.pd-step-n {
    background:#e8383e; color:#fff; min-width:24px; height:24px; border-radius:50%;
    display:inline-flex; align-items:center; justify-content:center;
    font-size:.76em; font-weight:800; flex-shrink:0; margin-top:1px;
}
.pd-dialbox-note {
    margin-top:20px; padding:12px 16px;
    background:rgba(255,209,102,.08); border:1px solid rgba(255,209,102,.2);
    border-radius:8px; font-size:.78em; color:rgba(255,255,255,.55); line-height:1.6;
}
/* offline box */
.pd-offline-icon { font-size:2.2em; margin-bottom:14px; }
.pd-offline-hl { font-size:1em; font-weight:700; margin-bottom:8px; color:#1c1c2e; }
.pd-offline-body { font-size:.9em; color:#555; margin-bottom:22px; line-height:1.6; }
.pd-email-row { display:flex; gap:10px; flex-wrap:wrap; max-width:480px; }
.pd-email-in {
    flex:1; min-width:200px; padding:12px 16px;
    border:2px solid #ddd; border-radius:10px;
    font-size:.9em; font-family:inherit; outline:none; color:#1c1c2e;
    transition:border-color .2s;
}
.pd-email-in:focus { border-color:#e8383e; }
.pd-email-btn {
    background:#e8383e; color:#fff; border:none;
    padding:12px 22px; border-radius:10px;
    font-weight:700; font-size:.9em; cursor:pointer;
    font-family:inherit; white-space:nowrap; transition:background .2s;
}
.pd-email-btn:hover { background:#c4262b; }
.pd-offline-alt {
    margin-top:22px; padding-top:18px; border-top:1px solid #eee;
    font-size:.88em; color:#555;
}
.pd-offline-alt a { color:#e8383e; font-weight:600; text-decoration:none; }

/* — Cards — */
.pd-cards { display:grid; grid-template-columns:repeat(auto-fit, minmax(280px,1fr)); gap:20px; }
.pd-card {
    background:#fff; border:1.5px solid #ebebeb; border-radius:16px;
    padding:28px; position:relative;
    transition:border-color .2s, box-shadow .2s, transform .2s;
}
.pd-card:hover {
    border-color:#e8383e; box-shadow:0 8px 32px rgba(232,56,62,.1);
    transform:translateY(-2px);
}
.pd-card-badge {
    position:absolute; top:-12px; left:20px;
    background:#e8383e; color:#fff;
    font-size:.7em; font-weight:800; padding:4px 12px;
    border-radius:20px; letter-spacing:.5px; text-transform:uppercase;
}
.pd-card-badge-blue { background:#1a56b0; }
.pd-card-icon { font-size:2em; margin-bottom:14px; line-height:1; }
.pd-card h3 { font-size:1.1em; font-weight:700; color:#1c1c2e; margin-bottom:8px; }
.pd-card p { font-size:.88em; color:#555; margin-bottom:14px; line-height:1.6; }
.pd-card-features { font-size:.8em; color:#1a6b3a; font-weight:600; margin-bottom:18px; line-height:1.8; }
.pd-card-features span { display:block; }
.pd-card-features span::before { content:'✓  '; }
.pd-btn {
    display:block; text-align:center; padding:12px 20px; border-radius:10px;
    font-weight:700; font-size:.88em; text-decoration:none;
    transition:all .2s; cursor:pointer;
}
.pd-btn-primary { background:#e8383e; color:#fff; }
.pd-btn-primary:hover { background:#c4262b; color:#fff; }
.pd-btn-ghost {
    background:transparent; color:#1c1c2e;
    border:2px solid #1c1c2e;
}
.pd-btn-ghost:hover { background:#1c1c2e; color:#fff; }

/* — Info boxes — */
.pd-infobox {
    background:#fff; border-left:4px solid #e8383e;
    border-radius:0 12px 12px 0;
    padding:18px 22px; margin-bottom:16px;
    box-shadow:0 2px 12px rgba(0,0,0,.05);
}
.pd-infobox h4 { font-size:.93em; font-weight:700; color:#1c1c2e; margin-bottom:6px; }
.pd-infobox p { font-size:.9em; color:#444; line-height:1.65; }

/* — Facts grid — */
.pd-facts { display:grid; grid-template-columns:repeat(auto-fit,minmax(160px,1fr)); gap:12px; margin-bottom:24px; }
.pd-fact {
    background:#fff; border-radius:12px; padding:16px 18px;
    box-shadow:0 1px 8px rgba(0,0,0,.06);
}
.pd-fact-label { font-size:.72em; font-weight:700; color:#aaa; text-transform:uppercase; letter-spacing:.6px; margin-bottom:4px; }
.pd-fact-value { font-size:.95em; font-weight:700; color:#1c1c2e; }

/* — WP content — */
.pd-wp-content { font-size:.93em; color:#444; }
.pd-wp-content h2 { font-family:'Playfair Display',serif; font-size:1.35em; color:#1c1c2e; margin:28px 0 10px; }
.pd-wp-content table { width:100%; border-collapse:collapse; font-size:.88em; }
.pd-wp-content td, .pd-wp-content th { padding:8px 12px; border:1px solid #eee; }
.pd-wp-content th { background:#f4f4f4; font-weight:700; }

/* — FAQ — */
.pd-faq-item { background:#fff; border-radius:12px; margin-bottom:8px; overflow:hidden; box-shadow:0 1px 6px rgba(0,0,0,.05); }
.pd-faq-q {
    padding:17px 22px; font-weight:600; font-size:.95em; color:#1c1c2e;
    cursor:pointer; display:flex; justify-content:space-between; align-items:center;
    user-select:none; list-style:none; gap:12px;
    transition:background .15s;
}
.pd-faq-q:hover { background:#fef9f9; }
.pd-faq-q::after { content:'＋'; color:#e8383e; font-size:1.1em; flex-shrink:0; }
.pd-faq-q.pd-open { background:#fef9f9; }
.pd-faq-q.pd-open::after { content:'－'; }
.pd-faq-a { padding:0 22px; max-height:0; overflow:hidden; transition:max-height .3s ease, padding .2s; font-size:.9em; color:#444; line-height:1.7; }
.pd-faq-a.pd-open { padding:4px 22px 18px; max-height:400px; }

/* — Related — */
.pd-related { display:flex; flex-wrap:wrap; gap:10px; margin-top:14px; }
.pd-related a {
    background:#fff; border:1.5px solid #e0e0e8; border-radius:10px;
    padding:9px 18px; font-size:.87em; color:#1c1c2e; text-decoration:none;
    font-weight:600; transition:all .2s;
}
.pd-related a:hover { background:#e8383e; border-color:#e8383e; color:#fff; }

/* — Logos — */
.pd-logo {
    display:inline-block; vertical-align:middle;
    border-radius:6px; overflow:hidden;
    background:#fff; flex-shrink:0;
    border:1px solid rgba(0,0,0,.07);
}
.pd-logo img {
    display:block; width:100%; height:100%;
    object-fit:contain;
}
/* Table method logos */
.pd-method-head { display:flex; align-items:center; gap:10px; }
.pd-method-head .pd-logo { width:28px; height:28px; }
.pd-method-head .pd-logo-multi { display:flex; gap:4px; }
.pd-method-head .pd-logo-multi .pd-logo { width:22px; height:22px; }
/* Card logos — replace emoji */
.pd-card-logo {
    width:52px; height:52px; margin-bottom:14px;
    border-radius:12px; overflow:hidden;
    border:1px solid rgba(0,0,0,.08);
    background:#fff;
}
.pd-card-logo img { width:100%; height:100%; object-fit:contain; display:block; }
/* UK carrier mini-logos in table */
.pd-carrier-logos { display:flex; align-items:center; gap:5px; margin-top:5px; flex-wrap:wrap; }
.pd-carrier-logos .pd-logo { width:20px; height:20px; border-radius:4px; }
/* Offline box Rebtel logo */
.pd-offline-rebtel-logo { width:20px; height:20px; border-radius:4px; vertical-align:middle; display:inline-block; overflow:hidden; border:1px solid rgba(0,0,0,.08); }
.pd-offline-rebtel-logo img { width:100%; height:100%; object-fit:contain; display:block; }

/* — Divider — */
.pd-divider { border:none; border-top:1px solid #eaeaef; margin:0 0 56px; }

/* — Responsive — */
@media(max-width:768px) {
    .pd-hero { padding:48px 0 40px; }
    .pd-hero h1 { font-size:1.85em; }
    .pd-hero-stats { width:100%; }
    .pd-hero-stat { padding:14px 18px; flex:1; min-width:110px; }
    .pd-hero-flag-bg { display:none; }
    .pd-dialbox { padding:24px 20px; }
    .pd-steps { flex-direction:column; gap:12px; }
    .pd-email-row { flex-direction:column; }
    .pd-email-btn { width:100%; text-align:center; }
    .pd-table th:nth-child(3), .pd-table td:nth-child(3) { display:none; }
}
@media(max-width:480px) {
    .pd-container, .pd-container-narrow { padding:0 16px; }
    .pd-hero-stats { flex-direction:column; width:fit-content; }
    .pd-hero-stat { border-right:none !important; border-bottom:1px solid rgba(255,255,255,.1); }
    .pd-hero-stat:last-child { border-bottom:none; }
    .pd-table th:nth-child(4), .pd-table td:nth-child(4) { display:none; }
}
</style>

<div class="pd-page">

    <?php // ── TOP BAR ── ?>
    <div class="pd-topbar">
        <div class="pd-topbar-inner">
            <nav class="pd-breadcrumb" aria-label="Breadcrumb">
                <a href="/">Home</a><span>›</span>
                <a href="/pick-a-country/">Pick a Country</a><span>›</span>
                <span>Call <?php echo esc_html($countryName); ?></span>
            </nav>
            <span class="pd-updated-badge">Updated <?php echo $updatedDate; ?></span>
        </div>
    </div>

    <?php // ── HERO ── ?>
    <div class="pd-hero">
        <div class="pd-hero-flag-bg"><?php echo $flagEmoji; ?></div>
        <div class="pd-container pd-hero-inner">
            <p class="pd-hero-eyebrow"><?php echo $flagEmoji; ?> Complete UK calling guide — updated <?php echo $updatedDate; ?></p>
            <h1>Cheapest Way to Call <em><?php echo esc_html($countryName); ?></em> from the UK</h1>
            <p class="pd-hero-sub">Every option compared honestly — access numbers, WhatsApp, VoIP apps and eSIMs. The right answer depends on your situation, so we cover all of them.</p>
            <?php if (!empty($cd['code']) || $bestRate !== '—' || !empty($cd['timeAhead'])): ?>
            <div class="pd-hero-stats">
                <?php if ($bestRate !== '—'): ?>
                <div class="pd-hero-stat">
                    <strong><?php echo esc_html($bestRate); ?>p</strong>
                    <span>from UK landline</span>
                </div>
                <?php endif; ?>
                <?php if (!empty($cd['code'])): ?>
                <div class="pd-hero-stat">
                    <strong><?php echo esc_html($cd['code']); ?></strong>
                    <span>dialling code</span>
                </div>
                <?php endif; ?>
                <?php if (!empty($cd['timeAhead'])): ?>
                <div class="pd-hero-stat">
                    <strong><?php echo esc_html($cd['timeAhead']); ?></strong>
                    <span>time difference</span>
                </div>
                <?php endif; ?>
                <?php if (!empty($cd['bestTime'])): ?>
                <div class="pd-hero-stat">
                    <strong><?php echo esc_html($cd['bestTime']); ?></strong>
                    <span>best time to call</span>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <?php // ── BODY ── ?>
    <div class="pd-body">
        <div class="pd-container-narrow">

            <?php // ── COMPARISON TABLE ── ?>
            <div class="pd-section">
                <div class="pd-section-header">
                    <h2>All Your Options at a Glance</h2>
                    <p>There is no single best way to call <?php echo esc_html($countryName); ?> from the UK — it depends on whether both ends have internet, whether you're on a landline or mobile, and how often you call. Here is an honest comparison of every option.</p>
                </div>
                <div class="pd-table-wrap">
                <table class="pd-table">
                    <thead>
                        <tr>
                            <th>Method</th>
                            <th>Typical Cost</th>
                            <th>Needs Internet</th>
                            <th>Best For</th>
                            <th>Verdict</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="pd-method">
                                <div class="pd-method-head">
                                    <div class="pd-logo-multi">
                                        <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=whatsapp.com" alt="WhatsApp" loading="lazy"></span>
                                        <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=apple.com" alt="FaceTime" loading="lazy"></span>
                                    </div>
                                    WhatsApp / FaceTime
                                </div>
                                <small>Free — but only if both ends have a reliable connection</small>
                            </td>
                            <td class="pd-rate-val">Free</td>
                            <td>Both ends</td>
                            <td>Regular callers with WiFi on both sides</td>
                            <td><span class="pd-pill pd-pill-green">Best if both online</span></td>
                        </tr>
                        <tr>
                            <td class="pd-method">
                                <div class="pd-method-head">
                                    <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=pocketdial.com" alt="PocketDial" loading="lazy"></span>
                                    PocketDial Access Number
                                </div>
                                <small>UK landline dial-around — no internet, no account</small>
                            </td>
                            <td class="pd-rate-val"><?php echo ($landlineToLandlineRate ? esc_html($landlineToLandlineRate).'p/min' : 'Coming soon'); ?></td>
                            <td>No</td>
                            <td>UK landline callers, elderly relatives with no smartphone</td>
                            <td><span class="pd-pill pd-pill-blue">Best no-internet option</span></td>
                        </tr>
                        <tr>
                            <td class="pd-method">
                                <div class="pd-method-head">
                                    <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=rebtel.com" alt="Rebtel" loading="lazy"></span>
                                    Rebtel
                                </div>
                                <small>VoIP app — connects as a regular call at the <?php echo esc_html($countryName); ?> end</small>
                            </td>
                            <td class="pd-rate-val">~1–3p/min</td>
                            <td>UK end only</td>
                            <td>UK mobile callers, no app needed on other end</td>
                            <td><span class="pd-pill pd-pill-blue">Best for UK mobiles</span></td>
                        </tr>
                        <tr>
                            <td class="pd-method">
                                <div class="pd-method-head">
                                    <div class="pd-logo-multi">
                                        <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=viber.com" alt="Viber" loading="lazy"></span>
                                        <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=telegram.org" alt="Telegram" loading="lazy"></span>
                                    </div>
                                    VoIP Apps (Viber, Telegram)
                                </div>
                                <small>Free app-to-app only — both ends need same app</small>
                            </td>
                            <td class="pd-rate-val">Free / low</td>
                            <td>Both ends</td>
                            <td>If your contact already uses the same app</td>
                            <td><span class="pd-pill pd-pill-amber">Good if app matches</span></td>
                        </tr>
                        <tr>
                            <td class="pd-method">
                                <div class="pd-method-head">
                                    <div class="pd-logo-multi">
                                        <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=airalo.com" alt="Airalo" loading="lazy"></span>
                                        <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=holafly.com" alt="Holafly" loading="lazy"></span>
                                    </div>
                                    <?php echo esc_html($countryName); ?> eSIM
                                </div>
                                <small>Local data for when you travel there</small>
                            </td>
                            <td class="pd-rate-val">From £3</td>
                            <td>For data calls</td>
                            <td>Travelling to <?php echo esc_html($countryName); ?></td>
                            <td><span class="pd-pill pd-pill-amber">Travel only</span></td>
                        </tr>
                        <tr>
                            <td class="pd-method">
                                <div class="pd-method-head">
                                    Standard UK Mobile
                                </div>
                                <small>EE / O2 / Vodafone — international direct dial</small>
                                <div class="pd-carrier-logos">
                                    <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=ee.co.uk" alt="EE" loading="lazy"></span>
                                    <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=o2.co.uk" alt="O2" loading="lazy"></span>
                                    <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=vodafone.co.uk" alt="Vodafone" loading="lazy"></span>
                                    <span class="pd-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=three.co.uk" alt="Three" loading="lazy"></span>
                                </div>
                            </td>
                            <td class="pd-rate-val">50p–£1.50/min</td>
                            <td>No</td>
                            <td>Emergency calls only</td>
                            <td><span class="pd-pill pd-pill-red">Avoid — very expensive</span></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <p style="font-size:.8em;color:#999;margin-top:10px">💡 <strong>The most important caveat on WhatsApp:</strong> it is genuinely free — but only works if the person you are calling also has a good internet connection. For calling elderly relatives or anyone without reliable WiFi or data, you need a paid option.</p>
            </div>

            <?php // ── DIAL-AROUND BOX ── ?>
            <?php if ($dialAvailable): ?>
            <div class="pd-dialbox pd-dialbox-live">
                <h3>📞 PocketDial Access Numbers for <?php echo esc_html($countryName); ?></h3>
                <p class="pd-dialbox-desc">Call from any UK landline — no account, no internet, no credit card needed. Just dial the number below, then dial <?php echo esc_html($countryName); ?>. Rate: <?php echo esc_html($landlineToLandlineRate); ?>p per minute.</p>
                <div class="pd-numbers">
                    <?php if ($landlineToLandlineTelephone): ?>
                    <div class="pd-number"><?php echo esc_html($landlineToLandlineTelephone); ?></div>
                    <?php endif; ?>
                    <?php if ($landlineToMobileTelephone && $landlineToMobileTelephone !== $landlineToLandlineTelephone): ?>
                    <div class="pd-number"><?php echo esc_html($landlineToMobileTelephone); ?> <small style="font-size:.65em;opacity:.6;font-weight:500">mobiles</small></div>
                    <?php endif; ?>
                </div>
                <div class="pd-steps">
                    <div class="pd-step"><div class="pd-step-n">1</div><div>Dial the access number above from your UK landline</div></div>
                    <div class="pd-step"><div class="pd-step-n">2</div><div>When prompted, dial <strong><?php echo esc_html($cd['dialPrefix'] ?: '00 + country code'); ?></strong> + the <?php echo esc_html($countryName); ?> number</div></div>
                    <div class="pd-step"><div class="pd-step-n">3</div><div>You're connected — charged at <?php echo esc_html($landlineToLandlineRate); ?>p/min to your normal phone bill</div></div>
                </div>
                <p class="pd-dialbox-note">Calls are billed at our service rate plus your landline provider's standard access charge. No account, registration or credit card needed.</p>
            </div>

            <?php else: ?>

            <div class="pd-dialbox pd-dialbox-offline">
                <div class="pd-offline-icon">📞</div>
                <div class="pd-offline-hl">Access Numbers — New Supplier Coming Soon</div>
                <p class="pd-offline-body">We are upgrading our dial-around service to a new supplier offering better rates to <?php echo esc_html($countryName); ?>. Leave your email below and we will notify you the moment new access numbers go live — you will be among the first to know.</p>
                <form class="pd-email-row" action="/wp-admin/admin-post.php" method="POST">
                    <input type="hidden" name="action" value="pd_notify_signup">
                    <input type="hidden" name="country" value="<?php echo esc_attr($countryName); ?>">
                    <?php wp_nonce_field('pd_notify_signup'); ?>
                    <input class="pd-email-in" type="email" name="email" placeholder="Your email address" required>
                    <button class="pd-email-btn" type="submit">Notify Me</button>
                </form>
                <p style="font-size:.77em;color:#aaa;margin-top:10px">One email when numbers go live. No spam, ever.</p>
                <div class="pd-offline-alt">
                    <strong>In the meantime:</strong> <span class="pd-offline-rebtel-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=rebtel.com" alt="" loading="lazy"></span> <a href="<?php echo esc_url($cd['rebtelLink']); ?>" rel="nofollow sponsored" style="color:#e8383e;font-weight:700;text-decoration:none">Rebtel</a> offers competitive per-minute rates to <?php echo esc_html($countryName); ?> from your UK mobile — the person you're calling does not need any app or internet. <a href="<?php echo esc_url($cd['rebtelLink']); ?>" rel="nofollow sponsored" style="color:#e8383e;font-weight:600;text-decoration:none">Try Rebtel →</a>
                </div>
            </div>
            <?php endif; ?>

            <?php // ── MOBILE CALLING ── ?>
            <div class="pd-section">
                <div class="pd-section-header">
                    <h2>Calling from Your UK Mobile</h2>
                    <p>Your standard mobile network will charge 50p–£1.50 per minute for international calls to <?php echo esc_html($countryName); ?>. Here are the two options that actually make sense.</p>
                </div>
                <div class="pd-cards">
                    <div class="pd-card">
                        <div class="pd-card-badge">⭐ Recommended</div>
                        <div class="pd-card-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=rebtel.com" alt="Rebtel" loading="lazy"></div>
                        <h3>Rebtel</h3>
                        <p>The key advantage over WhatsApp: the person you're calling doesn't need a smartphone, internet connection, or any app. Rebtel routes your call over the internet on your end but delivers it as a normal phone call at the <?php echo esc_html($countryName); ?> end. Rates from around 1–3p per minute.</p>
                        <div class="pd-card-features">
                            <span>No app needed at the <?php echo esc_html($countryName); ?> end</span>
                            <span>Works on any UK mobile</span>
                            <span>Calls landlines and mobiles</span>
                        </div>
                        <a href="<?php echo esc_url($cd['rebtelLink']); ?>" class="pd-btn pd-btn-primary" rel="nofollow sponsored">Call <?php echo esc_html($countryName); ?> with Rebtel →</a>
                    </div>
                    <div class="pd-card">
                        <div class="pd-card-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=whatsapp.com" alt="WhatsApp" loading="lazy"></div>
                        <h3>WhatsApp (Free — with a caveat)</h3>
                        <p>Completely free if the person you're calling has WhatsApp and a reliable internet connection. That caveat matters — if they have unreliable WiFi or data, call quality suffers. Best for regular calls to people you know are online.</p>
                        <div class="pd-card-features">
                            <span>Completely free over WiFi</span>
                            <span>Video calls too</span>
                            <span>Requires internet on both ends</span>
                        </div>
                        <a href="https://www.whatsapp.com/download" class="pd-btn pd-btn-ghost" rel="nofollow">Download WhatsApp →</a>
                    </div>
                </div>

                <?php // Skype callout — timely SEO opportunity ?>
                <div style="margin-top:20px;background:#fff;border:1px solid #e8e8f0;border-radius:12px;padding:18px 22px;font-size:.88em;color:#555;line-height:1.6">
                    <strong style="color:#1c1c2e">Used Skype to call <?php echo esc_html($countryName); ?>?</strong> Microsoft shut Skype down in May 2025. The best direct replacement for calling <?php echo esc_html($countryName); ?> landlines and mobiles is <a href="<?php echo esc_url($cd['rebtelLink']); ?>" style="color:#e8383e;font-weight:600;text-decoration:none" rel="nofollow sponsored">Rebtel</a> — same principle, no account top-up required. For free app-to-app calls, WhatsApp is the natural replacement.
                </div>
            </div>

            <hr class="pd-divider">

            <?php // ── MONEY TRANSFER ── ?>
            <div class="pd-section">
                <div class="pd-section-header">
                    <h2>Also Need to Send Money to <?php echo esc_html($countryName); ?>?</h2>
                    <p>Many people calling <?php echo esc_html($countryName); ?> from the UK also send money home regularly. Your high street bank is typically the worst way to do it — most add a hidden margin of 3–5% on top of the exchange rate before charging a transfer fee. These two services are consistently cheaper.</p>
                </div>
                <div class="pd-cards">
                    <div class="pd-card">
                        <div class="pd-card-badge">⭐ Top Pick</div>
                        <div class="pd-card-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=wise.com" alt="Wise" loading="lazy"></div>
                        <h3>Wise</h3>
                        <p>Uses the real mid-market exchange rate — the same one you see on Google — with a small transparent fee shown upfront before you send. No hidden margin buried in the exchange rate. Used by over 16 million people worldwide.</p>
                        <div class="pd-card-features">
                            <span>Mid-market exchange rate</span>
                            <span>74% of transfers arrive in under 20 seconds</span>
                            <span>All fees shown upfront — no surprises</span>
                        </div>
                        <a href="<?php echo esc_url($cd['wiseLink']); ?>" class="pd-btn pd-btn-primary" rel="nofollow sponsored">Send money with Wise →</a>
                    </div>
                    <div class="pd-card">
                        <div class="pd-card-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=remitly.com" alt="Remitly" loading="lazy"></div>
                        <h3>Remitly</h3>
                        <p>Built specifically for diaspora remittances — very popular for UK–<?php echo esc_html($countryName); ?> transfers. Competitive exchange rates with an on-time delivery guarantee: if your transfer is late, they refund the fee. Supports bank deposit, cash pickup and mobile wallet.</p>
                        <div class="pd-card-features">
                            <span>On-time delivery guarantee</span>
                            <span>Cash pickup option available</span>
                            <span>Strong UK–<?php echo esc_html($countryName); ?> corridor</span>
                        </div>
                        <a href="<?php echo esc_url($cd['remitlyLink']); ?>" class="pd-btn pd-btn-ghost" rel="nofollow sponsored">Send money with Remitly →</a>
                    </div>
                </div>
                <p style="font-size:.82em;color:#999;margin-top:14px">💡 Compare both before sending — rates shift daily. The cheapest for your amount this week may differ from last week.</p>
            </div>

            <hr class="pd-divider">

            <?php // ── ESIM ── ?>
            <div class="pd-section">
                <div class="pd-section-header">
                    <h2>Travelling to <?php echo esc_html($countryName); ?>? Avoid Roaming Charges</h2>
                    <p>If you're visiting <?php echo esc_html($countryName); ?>, your UK SIM will cost you significantly more than you expect. EE charges up to £8.45 per day for data outside Europe — which adds up to over £59 on a week's trip just for mobile internet. An eSIM costs a fraction of that and activates before you board.</p>
                </div>
                <div class="pd-cards">
                    <div class="pd-card">
                        <div class="pd-card-badge">Most Popular</div>
                        <div class="pd-card-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=airalo.com" alt="Airalo" loading="lazy"></div>
                        <h3>Airalo</h3>
                        <p>Best for most travellers. Buy a data plan before you leave, scan a QR code, and you have local data rates the moment you land in <?php echo esc_html($countryName); ?>. No physical SIM swap, no queues at the airport. Plans start from around £3.</p>
                        <div class="pd-card-features">
                            <span>Instant digital activation — no SIM swap</span>
                            <span>Plans from £3 — data only</span>
                            <span>Keep your UK number active on same phone</span>
                        </div>
                        <a href="<?php echo esc_url($cd['airaloLink']); ?>" class="pd-btn pd-btn-primary" rel="nofollow sponsored">Get a <?php echo esc_html($countryName); ?> eSIM on Airalo →</a>
                    </div>
                    <div class="pd-card">
                        <div class="pd-card-logo"><img src="https://www.google.com/s2/favicons?sz=128&domain=holafly.com" alt="Holafly" loading="lazy"></div>
                        <h3>Holafly</h3>
                        <p>Better for longer stays or heavy data users. Unlimited data plans mean you never worry about running out — useful if you're making lots of WhatsApp video calls home, using Google Maps constantly, or working remotely during your trip.</p>
                        <div class="pd-card-features">
                            <span>Unlimited data — no monitoring required</span>
                            <span>24/7 customer support</span>
                            <span>Longer stay plans available</span>
                        </div>
                        <a href="<?php echo esc_url($cd['holaLink']); ?>" class="pd-btn pd-btn-ghost" rel="nofollow sponsored">Get a <?php echo esc_html($countryName); ?> eSIM on Holafly →</a>
                    </div>
                </div>
                <p style="font-size:.82em;color:#999;margin-top:14px">ℹ️ eSIMs are data-only — calls and texts still go through apps like WhatsApp. Your UK number stays active on your phone's physical SIM alongside the eSIM.</p>
            </div>

            <hr class="pd-divider">

            <?php // ── HOW TO DIAL ── ?>
            <div class="pd-section">
                <div class="pd-section-header">
                    <h2>How to Dial <?php echo esc_html($countryName); ?> from the UK</h2>
                </div>

                <?php if (!empty($cd['code']) || !empty($cd['timezone']) || !empty($cd['bestTime'])): ?>
                <div class="pd-facts">
                    <?php if (!empty($cd['code'])): ?>
                    <div class="pd-fact"><div class="pd-fact-label">Country Code</div><div class="pd-fact-value"><?php echo esc_html($cd['code']); ?></div></div>
                    <?php endif; ?>
                    <?php if (!empty($cd['dialPrefix'])): ?>
                    <div class="pd-fact"><div class="pd-fact-label">From UK, dial first</div><div class="pd-fact-value"><?php echo esc_html($cd['dialPrefix']); ?></div></div>
                    <?php endif; ?>
                    <?php if (!empty($cd['timezone'])): ?>
                    <div class="pd-fact"><div class="pd-fact-label">Time Zone</div><div class="pd-fact-value"><?php echo esc_html($cd['timezone']); ?></div></div>
                    <?php endif; ?>
                    <?php if (!empty($cd['timeAhead'])): ?>
                    <div class="pd-fact"><div class="pd-fact-label">vs UK (GMT)</div><div class="pd-fact-value"><?php echo esc_html($cd['timeAhead']); ?></div></div>
                    <?php endif; ?>
                    <?php if (!empty($cd['bestTime'])): ?>
                    <div class="pd-fact"><div class="pd-fact-label">Best Time to Call</div><div class="pd-fact-value"><?php echo esc_html($cd['bestTime']); ?></div></div>
                    <?php endif; ?>
                    <?php if (!empty($cd['networks'])): ?>
                    <div class="pd-fact"><div class="pd-fact-label">Major Networks</div><div class="pd-fact-value"><?php echo esc_html($cd['networks']); ?></div></div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($cd['dialNote'])): ?>
                <div class="pd-infobox">
                    <h4>📞 Dialling format</h4>
                    <p><?php echo esc_html($cd['dialNote']); ?></p>
                </div>
                <?php endif; ?>

                <?php if (!empty($cd['timezoneNote'])): ?>
                <div class="pd-infobox">
                    <h4>🕐 Time difference explained</h4>
                    <p><?php echo esc_html($cd['timezoneNote']); ?></p>
                </div>
                <?php endif; ?>
            </div>

            <?php // ── WP CONTENT (area codes table etc) ── ?>
            <?php if (have_posts()): ?>
            <div class="pd-wp-content pd-section">
                <?php while (have_posts()): the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>

            <?php // ── FAQ ── ?>
            <div class="pd-section">
                <div class="pd-section-header">
                    <h2>Frequently Asked Questions</h2>
                </div>
                <div id="pd-faq">
                    <?php foreach ($cd['faq'] as $faqItem): ?>
                    <div class="pd-faq-item">
                        <div class="pd-faq-q" role="button" tabindex="0" aria-expanded="false"><?php echo esc_html($faqItem['q']); ?></div>
                        <div class="pd-faq-a"><?php echo esc_html($faqItem['a']); ?></div>
                    </div>
                    <?php endforeach; ?>
                    <?php // Universal FAQ items added to every page ?>
                    <div class="pd-faq-item">
                        <div class="pd-faq-q" role="button" tabindex="0" aria-expanded="false">What happened to Skype — and what should I use instead to call <?php echo esc_html($countryName); ?>?</div>
                        <div class="pd-faq-a">Microsoft shut Skype down in May 2025. Microsoft Teams, its replacement, does not support outbound calls to regular phone numbers for ordinary users. The best direct replacement for calling <?php echo esc_html($countryName); ?> landlines and mobiles is Rebtel, which works on any UK mobile and requires no app at the <?php echo esc_html($countryName); ?> end. For free app-to-app calls, WhatsApp is the natural alternative — it works on the same principle as Skype video calls and is now used by 87% of UK adults.</div>
                    </div>
                    <div class="pd-faq-item">
                        <div class="pd-faq-q" role="button" tabindex="0" aria-expanded="false">What if the person I'm calling in <?php echo esc_html($countryName); ?> doesn't have internet?</div>
                        <div class="pd-faq-a">WhatsApp and other internet-based apps will not work if the person you are calling has no reliable data connection. For calling people without smartphones or internet access — including elderly relatives — your best options are PocketDial access numbers (from a UK landline) or Rebtel (from a UK mobile). Both connect as a regular phone call at the <?php echo esc_html($countryName); ?> end, with no internet or app required there.</div>
                    </div>
                    <div class="pd-faq-item">
                        <div class="pd-faq-q" role="button" tabindex="0" aria-expanded="false">Is it cheaper to send money or buy credit to top up a phone in <?php echo esc_html($countryName); ?>?</div>
                        <div class="pd-faq-a">For supporting family in <?php echo esc_html($countryName); ?>, sending money via Wise or Remitly is almost always better value than buying international calling credit. A money transfer gives the recipient full control of the funds, arrives in minutes, and the transfer fees are lower than the per-minute costs that accumulate over regular calls. Many families use a combination: occasional calls via a VoIP app, with monthly transfers for living expenses.</div>
                    </div>
                </div>
            </div>

            <?php // ── RELATED ── ?>
            <?php if (!empty($cd['related'])): ?>
            <div class="pd-section">
                <div class="pd-section-header">
                    <h2>Also Calling Nearby?</h2>
                </div>
                <div class="pd-related">
                    <?php foreach ($cd['related'] as $rel): ?>
                    <a href="/cheap-phone-calls-<?php echo esc_attr(strtolower(str_replace(' ', '-', $rel))); ?>/"><?php echo esc_html($rel); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        </div><!-- .pd-container-narrow -->
    </div><!-- .pd-body -->

</div><!-- .pd-page -->

<script>
document.querySelectorAll('.pd-faq-q').forEach(function(q) {
    q.addEventListener('click', function() {
        var a = this.nextElementSibling;
        var isOpen = a.classList.contains('pd-open');
        document.querySelectorAll('.pd-faq-a').forEach(function(el){ el.classList.remove('pd-open'); });
        document.querySelectorAll('.pd-faq-q').forEach(function(el){ el.classList.remove('pd-open'); el.setAttribute('aria-expanded','false'); });
        if (!isOpen) { a.classList.add('pd-open'); this.classList.add('pd-open'); this.setAttribute('aria-expanded','true'); }
    });
    q.addEventListener('keydown', function(e) {
        if (e.key==='Enter'||e.key===' ') { e.preventDefault(); this.click(); }
    });
});
</script>

<?php get_footer(); ?>