<?php
$url="https://"$instance
$cont = true;
$start=0;
$f = array();

# Start counting instances following

while($cont){
	$followingsstr= file_get_contents($url."/api/v1/server/following?start=".$start);
	$followings = json_decode($followingsstr, true);
	foreach($followings['data'] as $follower){
			array_push($f,$follower['following']['url']);
	}
	$start+=15;
	if(sizeof($followings['data'])<15)
	 $cont=false;
}

# End counting instances following

# Start listing instances following

echo "<h2>Following ".sizeof($f)." instances"."</h2>";
echo "<b>videos from these instances will be available in "$instance".</b> <br /> <br/>";
foreach($f as $follower){
    $instance_url = str_replace('/accounts/peertube', '', $follower);
    $instance_short = str_replace('https://', '', $instance_url);
	echo $follower."<br />";
}

# End listing instances following

echo "<br /><br />";
$start=0;
$f = array();
$cont=true;

# Start counting instances followers

while($cont){
	$followersstr= file_get_contents($url."/api/v1/server/followers?start=".$start);
	$followers = json_decode($followersstr, true);
	foreach($followers['data'] as $follower){
		if (strpos($follower['follower']['url'], 'accounts/peertube') !== false)
			array_push($f,$follower['follower']['url']);
	}
	$start+=15;
	if(sizeof($followers['data'])<15)
	 $cont=false;
}

# End counting instances followers

# Start listing instances followers

echo "<h2>Followed by ".sizeof($f)." instances"."</h2>";
echo "<b>videos of "$instance" will be available in these instances</b><br /> <br/>";
foreach($f as $follower){
	echo $follower."<br />";
}

# End listing instances followers

<?php
header("X-Author: skid9000 & leonekmi");

if (!empty($_REQUEST['instance'])) {
    
}

?>
<!doctype html>
<html>
<head>
<title>Peertube Follow Tracker</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="semantic.min.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="css/icons.css">
</head>

<body>
<a href="https://github.com/nsaovh/rcgp"><img style="position: absolute; top: 0; right: 0; border: 0;" src="forkme.png" alt="Fork me on GitHub" data-canonical-src="forkme2.png"></a>
<center>
<form>
  <input type="text" name="instance_name"><br>
  <input type="submit" value="Submit">
</form> 
</a>
<br/>
<br/>
<div class="credits">Powered by Tuto-Craft Corporation, nekmi corp software development and NSA.OVH team</div>
</center>
<script src="https://nocdn.nsa.ovh/cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="semantic.min.js"></script>
<script src="select.js"></script>
</body>

</html>