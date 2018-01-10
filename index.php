<html>
<head>
	<title>MC Server GUI Web Interface</title>
	<link href="https://fonts.googleapis.com/css?family=Hammersmith+One" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php
	if (!isset($_POST['ip'])) {
		include('login.php');
	}
	else {
		include('MCServerGUI.php');
	}
?>
</body>
</html>

