<html>
<head>
	<title>LDAP Connection Test</title>
	<style type="text/css">
		body {
			font-family: "Helvetica", Arial, 12px
		}
	</style>
</head>
<body>
	<h1 style="text-align: center">LDAP Test</h1><hr>
	<?php 
	echo 'Connecting...';
	$ds = ldap_connect("ldap.virginia.edu");
	echo 'Connect result is ' . $ds . '<br>';

	if ($ds) {
		echo 'Binding...';
		$r = ldap_bind($ds);

		echo 'Bind result is ' . $r . '<br>';

		echo 'Searching for (uid=dgm3df)<br>';
		$sr = ldap_search($ds, "o=University of Virginia, c=US", "uid=dgm3df");
		echo 'Search result is ' . $sr . '<br>';

		echo 'Number of entries returned is ' . ldap_count_entries($ds, $sr) . '<br>';

		echo 'Getting entries...<p>';
		$info = ldap_get_entries($ds, $sr);
		echo 'Data for ' . $info["count"] . ' items returned<p>';

		for ($i=0; $i < $info["count"]; $i++) { 
			echo 'dn is ' . $info[$i]["dn"] . "<br>";
			echo 'first cn entry is ' . $info[$i]["cn"][0] . "<br>";
			echo "first email entry is: " . $info[$i]["mail"][0] . "<br /><hr />";
		}

		echo "Closing connection";
		ldap_close($dn);

	} else {
		echo "<h4>FAIL</h4>";
	}
	
	 ?>
</body>
</html>