<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>engwords</title>
	<link rel="stylesheet" href="/style/style.css">
</head>
<body>
	<div class="main">
		<div class="header">
			<div class="logo">
				EngDict
			</div>
			<div class="links">
				<ul>
					<li><a href="#">Add words</a></li>
					<li><a href="#">Pass the test</a></li>
				</ul>
			</div>
		</div>
		<div class="content">
			<?php include_once($_SERVER["DOCUMENT_ROOT"].'/sys/templates/'.$tpl.'.tpl.php'); ?>
		</div>
	</div>
</body>
</html>