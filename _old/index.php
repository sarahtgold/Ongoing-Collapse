<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd"
    >

<html lang="en">
<head>
<meta charset="utf-8">
<title>The Ongoing Collapse</title>
<link rel="icon" type="image/png" href="http://theongoingcollapse.com/oc.png">
<link rel="shortcut icon" href="http://theongoingcollapse.com/favicon.ico">
<script type="text/javascript" src="d3/d3.min.js"></script>
</head>

<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>

<style type="text/css">
body {
    font-family:"Roboto", Helvetica, sans-serif;
    font-size: 16px;
    font-weight: 300;
    letter-spacing: 0.05em;
    line-height: 150%;
    background-image: url('http://theongoingcollapse.com/bg.gif');
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: center;
    overflow: scroll;
    -webkit-background-size: 45%;
    -moz-background-size: 45%;
    -o-background-size: 45%;
    background-size: 45%;
}

#top {
    width:200px;
    height: 20px;
    position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    text-align:left;
    padding:5px;
    background-color: rgba(255, 255, 255, .7);
}

#content {
    width:700px;
    height: 100%; /** 530 CHANGE THIS WITH NEW STUFF**/
    top: 20px;
    position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto; /** CHANGE THIS WITH NEW STUFF = half height**/
    text-align:left;
    padding:5px;
    background-color: rgba(255, 255, 255, .7);
}

#bottom {
    width:140px;
    height: 20px;
    top: 40px;
    position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    text-align:left;
    padding:5px 5px 20px 5px;
    background-color: rgba(255, 255, 255, .7);
}


a:link {color:#000;}      /* unvisited link */
a:visited {color:#000;}  /* visited link */
a:hover {color:#000;}  /* mouse over link */
a:active {color:#000;}  /* selected link */

</style>

<body>

<?php

//infrastructure report
$dhs = file_get_contents('http://dhs-daily-report.blogspot.co.uk/');
$start6 = strpos($dhs, 'http://www.dhs.gov/sites');
$end6 = strpos($dhs, '.pdf', $start6);
$infr= substr($dhs, $start6, $end6-$start6+4);

// SQL Connection
$username = "";
$password = "";
$dbname = "";
$conn = mysqli_connect("localhost", $username, $password, $dbname);

    // Retrive data for printing
$sql = "SELECT Datekey Bitcoin, Draw, Coal, Wind, Biomass, Nuclear, PPMnow, PPM1ya, PPM10ya, AQChina, Oil,
    Bitcoin, Intusers, Fbookusers, Inttraffic, Intmwh, Intco2, Pakstrikes, Pakkills, Yemstrikes, Yemkills, Somstrikes, Somkills,
    Objects, Objectsactive, Voyager, Solarwind, Exoplanets, Exosystems, Sealevlym, Sealevgan, Quakelatest,
    Quakemag, Quakedepth FROM OCapi ORDER BY Datekey DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $datekey = $row["Datekey"];
        $draw = $row["Draw"];
        $coal = $row["Coal"];
        $wind = $row["Wind"];
        $biomass = $row["Biomass"];
        $nuclear = $row["Nuclear"];
        $ppmnow = $row["PPMnow"];
        $ppm1ya = $row["PPM1ya"];
        $ppm10ya = $row["PPM10ya"];
        $aqchina = $row["AQChina"];
        $oil = $row["Oil"];
        $bitcoin = $row["Bitcoin"];
        $intusers = $row["Intusers"];
        $fbookusers = $row["Fbookusers"];
        $inttraffic = $row["Inttraffic"];
        $intmwh = $row["Intmwh"];
        $intco2 = $row["Intco2"];
        $pakstrikes = $row["Pakstrikes"];
        $pakkills = $row["Pakkills"];
        $yemstrikes = $row["Yemstrikes"];
        $yemkills = $row["Yemkills"];
        $somstrikes = $row["Somstrikes"];
        $somkills = $row["Somkills"];
        $objects = $row["Objects"];
        $objectsactive = $row["Objectsactive"];
        $voyager = $row["Voyager"];
        $solarwind = $row["Solarwind"];
        $exoplanets = $row["Exoplanets"];
        $exosystems = $row["Exosystems"];
        $sealevlym = $row["Sealevlym"];
        $sealevgan = $row["Sealevgan"];
        $quakelatest = $row["Quakelatest"];
        $quakemag = $row["Quakemag"];
        $quakedepth = $row["Quakedepth"];
    }
} else {
    echo "unavaliable";
}

mysqli_close($conn);

?>

<div id="top">
<a href="http://theongoingcollapse.com/">The Ongoing Collapse</a>
</div>
<div id="content">
<p>The <a href="http://www.gridwatch.templar.co.uk/" target="_blank">current</a> draw on the UK National Grid is <strong><?php echo $draw; ?></strong> Gigawatts.</p>
<p>Of which <strong><?php echo $coal; ?>%</strong> is coal, <strong><?php echo $wind; ?>%</strong> is wind, <strong><?php echo $biomass; ?>%</strong> is biomass and <strong><?php echo $nuclear; ?>%</strong> is nuclear.</p>
<p>There are <a href="http://co2now.org/Current-CO2/CO2-Now/weekly-data-atmospheric-co2.html" target="_blank">currently</a> <strong><?php echo $ppmnow; ?></strong> parts per million of carbon in the atmosphere.</p>
<p>1 year ago today there were <strong><?php echo $ppm1ya; ?></strong> parts per million of carbon in the atmosphere.</p>
<p>10 years ago today there were <strong><?php echo $ppm10ya; ?></strong> parts per million of carbon in the atmosphere.</p>
<p>In Beijing, China, the Air Quality Index is <a href="http://aqicn.org/city/beijing/" target="_blank">currently</a> <strong><?php echo $aqchina; ?></strong>.</p>
<p>Crude oil is currently <a href="http://www.quoteoil.com/" target="_blank">valued</a> at <strong>$<?php echo $oil; ?></strong> a barrel.</p>
<p>One bitcoin is currently <a href="http://www.bitcoinexchangerate.org/" target="_blank">valued</a> at <strong>$<?php echo $bitcoin; ?></strong>.</p>
<p>There are <a href="http://www.statista.com/topics/1145/internet-usage-worldwide/" target="_blank">currently</a> an estimated <strong><?php echo $intusers; ?></strong> Internet users globally.</p>
<p>An estimated <strong><?php echo $fbookusers; ?></strong> of them <a href="http://www.statista.com/topics/751/facebook/" target="_blank">use</a> Facebook.</p>
<p>So far today there has been <strong><?php echo $inttraffic; ?> GB</strong> of Internet traffic requiring <strong><?php echo $intmwh; ?> MWh</strong> of power and releasing <strong><?php echo $intco2; ?> tons</strong> of carbon.</p>
<p><a href="http://map.ipviking.com/" target="_blank"><strong>Here</strong></a> is a live map of current cyber attacks.</p>
<p>To date, there have <a href="http://www.thebureauinvestigates.com/category/projects/drones/drones-graphs/" target="_blank">been</a> up to <strong><?php echo $pakstrikes; ?></strong> US drone strikes in Pakistan, killing up to <strong><?php echo $pakkills; ?></strong> people.</p>
<p>There have <a href="http://www.thebureauinvestigates.com/category/projects/drones/drones-graphs/" target="_blank">been</a> up to <strong><?php echo $yemstrikes; ?></strong> US drone strikes in Yemen, killing up to <strong><?php echo $yemkills; ?></strong> people.</p>
<p>In Somalia, there have <a href="http://www.thebureauinvestigates.com/category/projects/drones/drones-graphs/" target="_blank">been</a> up to <strong><?php echo $somstrikes; ?></strong> US drone strikes, killing <strong><?php echo $somkills; ?></strong> people.</p>
<p><a href="http://www.swpc.noaa.gov/forecast.html" target="_blank"><strong>Here</strong></a> is today's NOAA report on space weather and solar geophysical activity.</p>
<p><a href="http://www.esa.int/Our_Activities/Human_Spaceflight/International_Space_Station/Where_is_the_International_Space_Station" target="_blank"><strong>Here</strong></a> is a map of where the International Space Station is.</p>
<p>Check out the latest images from Mars Curiosity <a href="http://www.midnightplanets.com/web/MSL/latestImages.html" target="_blank"><strong>here</strong></a>.</p>
<p>There <a href="http://celestrak.com/satcat/boxscore.asp" target="_blank">are</a> <strong><?php echo $objects ?></strong> man-made objects in space.</p>
<p>Of those, <strong><?php echo $objectsactive ?></strong> are in active use.</p>
<p>Voyager 1 is <a href="http://voyager.jpl.nasa.gov/where/" target="_blank">currently</a> <strong><?php echo $voyager ?> km</strong> away from Earth.</p>
<p><a href="http://spaceflightnow.com/launch-schedule/" target="_blank"><strong>Here</strong></a> is an up to date list of planned space launches.</p>
<p>Solar wind speed around Earth is <a href="http://www.swpc.noaa.gov/" target="_blnka">currently</a> <strong><?php echo $solarwind ?> km/s</strong>.</p>
<p>There are <a href="http://exoplanet.eu/catalog/" target="_blank">currently</a> <strong><?php echo $exoplanets; ?></strong> known exoplanets.</p>
<p>And there <a href="http://exoplanet.eu/catalog/" target="_blank">are</a> <strong><?php echo $exosystems; ?></strong> known exoplanetary systems.</p>
<p><a href="http://www.estofex.org/cgi-bin/polygon/showforecast.cgi?text=yes&fcstfile=2014061006_201406082231_3_stormforecast.xml" target="_blank"><strong>Here</strong></a> is the latest ESTOFEX Storm Forecast.</p>
<p>Sea level relative to 0m is currently <strong><?php echo $sealevlym; ?>m</strong> <a href="http://www.ioc-sealevelmonitoring.org/list.php?order=delay&dir=asc&contact=69" target="_blank">at</a> Lymington, UK.</p>
<p>In Gan, Maldives, sea level relative to 0m <a href="http://www.ioc-sealevelmonitoring.org/station.php?code=geor" target="_blank">is</a> currently <strong><?php echo $sealevgan; ?>m</strong>.</p>
<p>The latest earthquake was at <strong><?php echo $quakelatest?></strong> of magnitude <strong><?php echo $quakemag?></strong> at a depth of <strong><?php echo $quakedepth?> km</strong>.</p>
<p><strong><a href="http://inciweb.nwcg.gov" target="_blank">Here</a></strong> is an up to date list of current US fire incidents.</p>
<p><strong><a href="<?php echo $infr; ?>" target="_blank">Here</a></strong> is today's Department of Homeland Security Daily Infrastructure Report.</p>

</div>

<div id="bottom">
<a href="http://theongoingcollapse.com/about.html">[about]</a>
<a href="http://theongoingcollapse.com/links.html">[links]</a>
</div>

</body>

</html>
