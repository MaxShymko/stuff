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
					<li>
						<?php
						if($GLOBALS['this_id'] == 0) 
							echo '<a href="/login">Login</a>';
						else 
							echo '<a href="/logout">Logout</a>';?>
					</li>
					<li><a href="/addwords">Add words</a></li>
					<li><a href="/test">Pass the test</a></li>
				</ul>
			</div>
		</div>
		<div class="content">
			<?php include_once(ROOT.'/templates/'.$tpl.'.tpl.php'); ?>
		</div>
	</div>

	<script src="/sys/js/jquery-3.2.1.min.js"></script>
	<script src="/sys/js/main.js"></script>
</body>
</html>