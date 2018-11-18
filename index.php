<!DOCTYPE html>
<html>

<head>
  <title>Serveur de Fri&#38;Me</title>
  <link rel="icon" href="img/logo.jpg">
  <link rel="stylesheet" type="text/css" href="style/main.css">
</head>

<script src="//cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

<body>
	<div id="particles-js"></div>
	<div class="text"> 
		<img src="img/logo.jpg" class="img">
		<?php
			echo "<p>Le serveur tourne à l'adresse ".$_SERVER['SERVER_ADDR']."</p>";
		?>
	</div>
</body>

<script type="text/javascript">
	particlesJS.load('particles-js', 'style/particles.json', function(){
		console.log('particles.json loaded...');
	});
</script>

</html>