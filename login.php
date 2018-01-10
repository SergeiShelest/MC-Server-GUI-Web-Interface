<h1 class="title">Log-in</h1>

<form class="form" action="./index.php" method="POST">

	<div id='status'>
	<?php

		if (isset($_GET['error'])) {
			
			if ($_GET['error'] == 'badpass') {
				echo "Invalid password!";
			}

			if ($_GET['error'] == 'baddata') {
				echo "There is no GUI at that IP/Port!";
			}
		
		}

	?>	
	</div>

	<input class="input" type="login" name="ip" placeholder="Host/IP"><br>
	<input class="input" type="login" name="port" placeholder="Port"><br>
	<input class="input" type="password" name="pass" placeholder="Password"><br>
	<input class="login" type="submit" name="button" value="Connect">

</form>
