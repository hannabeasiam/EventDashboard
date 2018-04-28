<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
		<meta name="description" content="Create Student Profile, Event Generate donate report">
		<meta name="keywords" content="PHP, DB PDO, CRUD">
		<meta name="author" content="Hanna Lee">
    <title><?php if(isset($title)){ echo $title; } ?></title>
    <link href="static/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  <div class="wrap"><!--wrap header and main except footer-->
		<!--main header layout-->
		<header class="main-header">
			<div class="container">
				<h1>PHP</h1>
				<h3 class="name"><a href="eventType.php">Home</a></h3>
				<ul class="main-nav">
				  <li><a href="report.php">Report</a></li>
					<li><a href="dashboard.php">Dashboard</a></li>
				</ul>
			</div>
		</header>