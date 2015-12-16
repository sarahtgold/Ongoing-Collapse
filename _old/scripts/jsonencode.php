<?php

// SQL connection
// TODO: place these variables into an external file,
// exclude it from the repo
$username = "";
$password = "";
$dbname = "";
$conn = mysqli_connect("localhost", $username, $password, $dbname);

$myquery = "SELECT Datekey, Bitcoin, Draw, Coal, Wind, Biomass, Nuclear, PPMnow, PPM1ya, PPM10ya, AQChina, Oil,
Bitcoin, Intusers, Fbookusers, Inttraffic, Intmwh, Intco2 Pakstrikes, Pakkills, Yemstrikes, Yemkills, Somstrikes, Somkills,
Objects, Objectsactive, Voyager, Solarwind, Exoplanets, Exosystems, Sealevlym, Sealevgan
FROM OCapi ORDER BY Datekey DESC LIMIT 30";

$query = mysqli_query($conn, $myquery);

if (!$myquery) {
  echo mysqli_error();
  die;
}

$data = array();

for ($x = 0; $x < mysqli_num_rows($query); $x++) {
  $data[] = mysqli_fetch_assoc($query);
}

echo json_encode($data);

mysqli_close($server);

?>
