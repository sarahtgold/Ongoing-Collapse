<?php

// SQL connection
// TODO: place these variables into an external file,
// exclude it from the repo$username = "";
$password = "";
$dbname = "";
$conn = mysqli_connect("localhost", $username, $password, $dbname);

// Call APIs / each one by one

// Bitcoin
$responseBitcoin = file_get_contents($requestBitcoin);
$resultsBitcoin = json_decode($responseBitcoin, TRUE);
$jsonBitcoin = $resultsBitcoin['results'];
$bitcoin = $jsonBitcoin['collection1'][0]['bitcoindollar'];

//Draw
$responseDraw = file_get_contents($requestDraw);
$resultsDraw = json_decode($responseDraw, TRUE);
$jsonDraw = $resultsDraw['results'];
$draw = substr($jsonDraw['collection1'][0]['dmnd'], 7, -2);
$coal = substr($jsonDraw['collection1'][0]['cl'], 13, -2);
$wind = substr($jsonDraw['collection1'][0]['wnd'], 13, -2);
$biomass = substr($jsonDraw['collection1'][0]['bmss'], 16, -2);
$nuclear = substr($jsonDraw['collection1'][0]['nclr'], 16, -2);

//PPM
$responsePPM = file_get_contents($requestPPM);
$resultsPPM = json_decode($responsePPM, TRUE);
$jsonPPM = $resultsPPM['results'];
$ppmnow = substr($jsonPPM['collection1'][0]['ppmtoday'], 0, -4);
$ppm1ya = substr($jsonPPM['collection1'][0]['ppm1ya'], 0, -4);
$ppm10ya = substr($jsonPPM['collection1'][0]['ppm10ya'], 0, -4);

//AQ China
$responseAQChina = file_get_contents($requestAQChina);
$resultsAQChina = json_decode($responseAQChina, TRUE);
$jsonAQChina = $resultsAQChina['results'];
$aqchina = $jsonAQChina['collection1'][0]['aqichina'];

//Oil
$responseOil = file_get_contents($requestOil);
$resultsOil = json_decode($responseOil, TRUE);
$jsonOil = $resultsOil['results'];
$oil = $jsonOil['collection1'][0]['oilperbarrel'];

//Internet users
$responseIntusers = file_get_contents($requestIntusers);
$resultsIntusers = json_decode($responseIntusers, TRUE);
$jsonIntusers = $resultsIntusers['results'];
$intuserscom = $jsonIntusers['collection1'][0]['InternetUsers'];
$intusers = str_replace(",", "", $intuserscom);
$fbookuserscom = $jsonIntusers['collection1'][0]['FbookUsers'];
$fbookusers = str_replace(",", "", $fbookuserscom);
$inttrafficcom = $jsonIntusers['collection1'][0]['InternetTraffic'];
$inttraffic = str_replace(",", "", $inttrafficcom);
$intmwhcom = $jsonIntusers['collection1'][0]['MWh'];
$intmwh = str_replace(",", "", $intmwhcom);
$intco2com = $jsonIntusers['collection1'][0]['CO2'];
$intco2 = str_replace(",", "", $intco2com);

//Drones strikes
$responseDrone = file_get_contents($requestDrone);
$resultsDrone = json_decode($responseDrone, TRUE);
$jsonDrone = $resultsDrone['results'];
$pakstrikes = $jsonDrone['collection1'][0]['Pakttl'];
$pakkillscom = substr($jsonDrone['collection1'][0]['Pakkills'], +6);
$pakkills = str_replace(",", "", $pakkillscom);
$yemstrikes = substr($jsonDrone['collection1'][0]['Yemttl'], +4);
$yemkills = substr($jsonDrone['collection1'][0]['Yemkills'], +4);
$somstrikes = $jsonDrone['collection1'][0]['Somttl'];
$somkills = $jsonDrone['collection1'][0]['Somkills'];

//Objects in space
$responseObjects = file_get_contents($requestObjects);
$resultsObjects = json_decode($responseObjects, TRUE);
$jsonObjects = $resultsObjects['results'];
$objectscom = $jsonObjects['collection1'][10]['objects']; //the object in space are annoying cos each on ended up on a separate line, use the original url to figure out which line you need
$objects = str_replace(",", "", $objectscom);
$objectsactivecom = $jsonObjects['collection1'][4]['objects'];
$objectsactive = str_replace(",", "", $objectsactivecom);

// Voyager
$responseVoyager = file_get_contents($requestVoyager);
$resultsVoyager = json_decode($responseVoyager, TRUE);
$jsonVoyager = $resultsVoyager['results'];
$voyagercom = substr($jsonVoyager['collection1'][0]['voyager1'], 0, -3);
$voyager = str_replace(",", "", $voyagercom);

//Solar wind
$responseSolar = file_get_contents($requestSolar);
$resultsSolar = json_decode($responseSolar, TRUE);
$jsonSolar = $resultsSolar['results'];
$solarwind = $jsonSolar['collection1'][0]['windspeed'];

//Exoplanets
$responseExo = file_get_contents($requestExo);
$resultsExo = json_decode($responseExo, TRUE);
$jsonExo = $resultsExo['results'];
$exoplanets = substr($jsonExo['collection1'][0]['Plnts'], +8, -63);
$exosystems = substr($jsonExo['collection1'][0]['Plnts'], +23, -48);

//Sea levels
$responseLev = file_get_contents($requestLev);
$resultsLev = json_decode($responseLev, TRUE);
$jsonLev = $resultsLev['results'];
$sealevlym = $jsonLev['collection1'][0]['lymington'];
$sealevgan = $jsonLev['collection1'][0]['maldives'];

//Quakes
$responseQuake = file_get_contents($requestQuake);
$resultsQuake = json_decode($responseQuake, TRUE);
$jsonQuake = $resultsQuake['results'];
$quakelatest = $jsonQuake['collection1'][0]['location'];
$quakemag = $jsonQuake['collection1'][0]['magnitude'];
$quakedepth = $jsonQuake['collection1'][0]['depth'];

echo "Bitcoin ".$bitcoin."<br>";
echo "Draw ".$draw."<br>";
echo "Coal ".$coal."<br>";
echo "Wind ".$wind."<br>";
echo "Biomass ".$biomass."<br>";
echo "Nuclear ".$nuclear."<br>";
echo "PPMnow ".$ppmnow."<br>";
echo "PPM1ya ".$ppm1ya."<br>";
echo "PPM10ya ".$ppm10ya."<br>";
echo "AQChina ".$aqchina."<br>";
echo "Oil ".$oil."<br>";
echo "Intusers ".$intusers."<br>";
echo "Fbookusers ".$fbookusers."<br>";
echo "InternetTraffic ".$inttraffic."<br>";
echo "Int MWh ".$intmwh."<br>";
echo "Int CO2 ".$intco2."<br>";
echo "Pakstrikes ".$pakstrikes."<br>";
echo "Pakkills ".$pakkills."<br>";
echo "Yemstrikes ".$yemstrikes."<br>";
echo "Yemkills ".$yemkills."<br>";
echo "Somstrikes ".$somstrikes."<br>";
echo "Somkills ".$somkills."<br>";
echo "Objects ".$objects."<br>";
echo "Objectsactive ".$objectsactive."<br>";
echo "Voyager ".$voyager."<br>";
echo "Solarwind ".$solarwind."<br>";
echo "Exoplanets ".$exoplanets."<br>";
echo "Exosystems ".$exosystems."<br>";
echo "Sealevlym ".$sealevlym."<br>";
echo "Sealevgan ".$sealevgan."<br>";
echo "Quakelatest ".$quakelatest."<br>";
echo "Quakemag ".$quakemag."<br>";
echo "Quakedepth ".$quakedepth."<br>";

// Write to SQL table
$sql = "INSERT OCapi (Datekey, Draw, Coal, Wind, Biomass, Nuclear, PPMnow, PPM1ya, PPM10ya, AQChina, Oil,
Bitcoin, Intusers, Fbookusers, Inttraffic, Intmwh, Intco2, Pakstrikes, Pakkills, Yemstrikes, Yemkills, Somstrikes, Somkills,
Objects, Objectsactive, Voyager, Solarwind, Exoplanets, Exosystems, Sealevlym, Sealevgan, Quakelatest, Quakemag, Quakedepth)
VALUES (DATE(NOW()), '$draw', '$coal', '$wind', '$biomass', '$nuclear', '$ppmnow', '$ppm1ya', '$ppm10ya', '$aqchina', '$oil', '$bitcoin',
'$intusers', '$fbookusers', '$inttraffic', '$intmwh', '$intco2', '$pakstrikes', '$pakkills','$yemstrikes', '$yemkills', '$somstrikes', '$somkills',
'$objects', '$objectsactive', '$voyager', '$solarwind', '$exoplanets', '$exosystems', '$sealevlym', '$sealevgan', '$quakelatest', '$quakemag', '$quakedepth')
ON DUPLICATE KEY UPDATE
Datekey = Datekey ";

if (mysqli_query($conn, $sql)) {
  $last_id = mysqli_insert_id($conn);
  echo "<p>New record created successfully. Last inserted ID is: " . $last_id;
} else {
  echo "<p>Error: " . $sql . "<br>" . mysqli_error($conn);
}

//Wipe table!!!
//$sql = "DELETE FROM Kimonoapi";

?>
