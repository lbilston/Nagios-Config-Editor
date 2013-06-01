<?php
header("Content-type: text/plain");
//$con=mysqli_connect("localhost","root","root","nagiosconfig");
$con=mysqli_connect("localhost","dbuser","dbpass","dbname");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$hosts = mysqli_query($con,"SELECT * FROM hostGroups");

while($row = mysqli_fetch_array($hosts))
  {
	$hostgroup = $row['hostgroup'];
	$hostgroupAlias = $row['hostgroupAlias'];
	
	
  	$machines = mysqli_query($con,"SELECT * FROM devices WHERE `hostgroup` = '$hostgroup'");
	
	$host_array = "";
	while($line = mysqli_fetch_array($machines))
	{
		$ipaddress = $line['IP'];
		$name = $line['Name'];
		
		echo "define host{\n";
		echo "	use			$hostgroup\n";
		echo "	host_name		$name\n";
		echo "	alias			$name\n";
		echo "	address			$ipaddress\n";
		echo "	}";
		echo "\n";
		echo "\n";
		
		$host_array[] = $name;
		
	}
	
	echo "define host{\n";
	echo "	name			$hostgroup\n";
	echo "	use			generic-host\n";
	echo "	max_check_attempts	10\n";
	echo "	contact_groups		admins\n";
	echo "	hostgroups		$hostgroup\n";
	echo "	}";
	echo "\n";
	echo "\n";

	
	echo "define hostgroup{\n";
	echo "	hostgroup_name		$hostgroup\n";
	echo "	alias			$hostgroupAlias\n";
	echo "	}";
	echo "\n";
	echo "\n";

	
	echo "define service{\n";
	echo "	use			generic-service\n";
	echo "	host_name		";
	$arrlength=count($host_array);
	for($x=0;$x<$arrlength;$x++)
	  {
	  echo $host_array[$x];
	  if ($x != $arrlength-1) {echo ", ";}
	  }
	echo "\n";
	echo "	service_description	Status\n";
	echo "	check_command		check_ping!3000.0,80%!5000.0,100%\n";
	echo "	normal_check_interval	10\n";
	echo "	retry_check_interval	1\n";
	echo "	}";

	echo "\n";
	echo "\n";
	
  }

mysqli_close($con);

?>