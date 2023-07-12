<?php
include("geoip/geoip.inc");
$gi = geoip_open("geoip/GeoIP.dat", GEOIP_STANDARD);
echo geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
geoip_close($gi);