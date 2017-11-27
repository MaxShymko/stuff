<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>EngDict</title>
	<link rel="stylesheet" href="/style/style.css">
	<link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="shortcut icon" href="/style/img/favicon.gif" type="image/gif">
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
						<?php if($GLOBALS['this_id'] == 0) 
							echo '<a href="/login">Login</a>';
						else 
							echo '<a href="/logout">Logout</a>';?>
					</li>
					<li><a href="/mywords">My words</a></li>
					<li><a href="/test">Pass the test</a></li>
				</ul>
			</div>
		</div>
		<div class="content">
			<?php include_once(ROOT.'/templates/'.$tpl.'.tpl.php'); ?>
		</div>
	</div>
	
	<div class="messageDiv"></div>

	<script src="/sys/js/jquery-3.2.1.min.js"></script>
	<script src="/sys/js/main.js"></script>
</body>
</html>