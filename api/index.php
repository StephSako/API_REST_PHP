<!DOCTYPE html>
<html>

<head>
  <title>API REST de Fri&#38;Me</title>
  <link rel="icon" href="../img/logo.jpg">
  <link rel="stylesheet" type="text/css" href="../style/main.css">
</head>

<script src="//cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

<body>
	<div id="particles-js"></div>
	<div class="text"> 
		<img src="../img/logo.jpg" class="img">
		<p>API REST en construction</p>
	</div>
	<div class="stext"> 
		<p>
			<?php
				$string = file_get_contents("./services.json");
				$services = json_decode($string, true);

				foreach ($services as $service => $val) {
					echo $val['desc'].' -> '.$val['url'].'<br/>';
				}
			?>
		</p>
	</div>
</body>

<script type="text/javascript">
	particlesJS.load('particles-js', '../style/particles.json', function(){
		console.log('particles.json loaded...');
	});
</script>

</html>