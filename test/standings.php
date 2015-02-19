<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

	Design by TEMPLATED
	http://templated.co
	Released for free under the Creative Commons Attribution License

	Name       : Nameless Geometry
	Version    : 1.0
	Released   : 20130222

-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Des Moines Adult Hockey - Schedule</title>
		<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="common/style.css" />
	</head>
	<body>
		<div id="bg">
			<div id="outer">
				<div id="header">
				<?php include ("common/header.php");?>
				</div>
				<div id="main">
					<div id="sidebar1">
						<h3>
							Teams
						</h3>
						<ul class="linkedList">
							<li class="first">
								<a href="#">Alien Hockey</a>
							</li>
							<li>
								<a href="#">Flying Moose Knuckles</a>
							</li>
							<li>
								<a href="#">Cup O Kryptonite</a>
							</li>
							<li>
								<a href="#">Forklifts of DM/Kyle's Bikes</a>
							</li>
							<li>
								<a href="#">Ichi Bikes</a>
							</li>
							<li>
								<a href="#">Red Alert</a>
							</li>
							<li>
								<a href="#">Rink Rats</a>
							</li>
							<li class="last">
								<a href="#">Victors</a>
							</li>
						</ul>
						<h3>
							Aliquam etiam adipiscing
						</h3>
						<p>
							Facilisis non dictum ultricies. Purus et enim mi iaculis non magna vitae ipsum. Ultricies mattis risus sed
							sed mattis. Turpis placerat lectus quis consequat tincidunt felis. Fermentum et purus mollis posuere
							aliquam amet commodo sed blandit curae lorem ipsum nascetur congue in sed diam nascetur arcu. Arcu sed
							consectetur fringilla amet tellus montes.
						</p>
					</div>
					<div id="sidebar2">
						<h3>
							Recent Scores
						</h3>
						<ul class="linkedList">
							<li class="first">
								<a href="#">FoDM/KB - 5<br />Red Alert - 8</a>
							</li>
							<li>
								<a href="#">Ichi - 3<br />Alien - 5</a>
							</li>
							<li>
								<a href="#">Kryptonite - 3<br />Rink Rats - 2</a>
							</li>
							<li class="last">
								<a href="#">Victors - 5<br />Flying Moose - 3</a>
							</li>
						</ul>
						<h3>
							Etiam hendrerit
						</h3>
						<img class="top" src="images/pic2.jpg" width="252" height="80" alt="" />
						<p>
							Turpis placerat lectus quis consequat tincidunt felis. Fermentum et purus mollis posuere aliquam 
							commodo sed blandit curae lorem ipsum.
						</p>
					</div>
					<div id="content">
						<div id="box1">

<h1>2014-15 Team Standings</h1>
<hr />
<br />
<table id="standings" align="center" width="90%">
<thead>
	<tr>
		<th>Team</th>
		<th>GP</th>
		<th>Wins</th>
		<th>Losses</th>
		<th>SOL</th>
		<th>Pts</th>
		<th>GF</th>
		<th>GA</th>
	</tr>
</thead>
<tbody>
<?php
	include ("common/db_setup.php");
	$connection = mysqli_connect($server, $username, $password, $database) or die ("Connection failed");
	$query = "select t.name, 
			(select count(*) from game 
				join schedule on game.id = schedule.id 
				where schedule.home=1 or schedule.away=1) as 'GP', 
			(select count(*) from game as g 
				join schedule as s on g.id = s.id 
				where (t.id = s.home and g.home_score > g.away_score) 
					or (t.id = s.away and g.home_score < g. away_score) 
					or (t.id = s.home and g.special_case = 'A_SOL') 
					or (t.id = s.away and g.special_case = 'H_SOL')
					or (t.id = s.home and g.special_case = 'A_FOR')
					or (t.id = s.away and g.special_case = 'H_FOR')) as 'W', 
			(select count(*) from game as g 
				join schedule as s on g.id = s.id 
				where (t.id = s.home and g.home_score < g. away_score) 
					or (t.id = s.away and g.home_score > g. away_score)
					or (t.id = s.home and g.special_case = 'H_FOR')
					or (t.id = s.away and g.special_case = 'A_FOR')) as 'L', 
			(select count(*) from game as g 
				join schedule as s on g.id = s.id 
				where (t.id = s.away and g.special_case = 'A_SOL') 
					or (t.id = s.home and g.special_case = 'H_SOL')) as 'SOL', 
			((select count(*) from game as g 
				join schedule as s on g.id = s.id 
				where (t.id = s.home and g.home_score > g. away_score) 
				or (t.id = s.away and g.home_score < g. away_score) 
				or (t.id = s.home and g.special_case = 'A_SOL') 
				or (t.id = s.away and g.special_case = 'H_SOL')
				or (t.id = s.home and g.special_case = 'A_FOR')
				or (t.id = s.away and g.special_case = 'H_FOR'))*2) + 
					(select count(*) from game as g 
						join schedule as s on g.id = s.id 
						where (t.id = s.away and g.special_case = 'A_SOL') 
							or (t.id = s.home and g.special_case = 'H_SOL')) as 'Pts',
			(select sum(home_score) from game g
			    join schedule s on g.id = s.id
			    where t.id = s.home) +
			(select sum(away_score) from game g
			    join schedule s on g.id = s.id
			    where t.id = s.away) as 'GF',
			(select sum(away_score) from game g
			    join schedule s on g.id = s.id
			    where t.id = s.home) +
			(select sum(home_score) from game g
			    join schedule s on g.id = s.id
			    where t.id = s.away) as 'GA'
			from team as t 
			where season = 1 
			order by 6 desc, 3 desc, 4 desc, 1";
	$result = mysqli_query($connection, $query) or die("Query failed");
	while ($row = mysqli_fetch_assoc($result)) {
		$team = $row['name'];
		$games = $row['GP'];
		$wins = $row['W'];
		$losses = $row['L'];
		$sol = $row['SOL'];
		$points = $row['Pts'];
		$gf = $row['GF'];
		$ga = $row['GA'];
		echo "<tr><td align=left><strong>";
		echo htmlentities($team);
		echo "</strong></td><td align=center>";
		echo htmlentities($games);
		echo "</td><td align=center>";
		echo htmlentities($wins);
		echo "</td><td align=center>";
		echo htmlentities($losses);
		echo "</td><td align=center>";
		echo htmlentities($sol);
		echo "</td><td align=center><strong>";
		echo htmlentities($points);
		echo "</strong></td><td align=center>";
		echo htmlentities($gf);
		echo "</td><td align=center>";
		echo htmlentities($ga);
		echo "</td></tr>";
	}
	mysqli_free_result($result);
	mysqli_close($connection);
?>
</tbody>
</table>

							<p>
								
							</p>
						</div>
						
						<br class="clear" />
					</div>
					<br class="clear" />
				</div>
				<div id="footer">
					<div id="footerContent">
						<h3>
							Fringilla integer morbi
						</h3>
						<p>
							Duis rhoncus aenean fusce ornare. Dolor velit augue proin pellentesque. Semper purus orci vivamus. 
							Tempus nullam praesent sem ipsum. Sapien nibh aliquam convallis vestibulum. Lorem elit sapien duis 
							et cras. Nunc feugiat sed praesent amet lobortis semper tellus. Lobortis sodales nisi feugiat. 
							Cubilia sollicitudin metus ut lectus ante. Aliquam condimentum faucibus velit, sit amet molestie 
							dolor euismod non. Integer nec sapien turpis. Quisque volutpat aliquet tortor sit amet laoreet. 
							Phasellus posuere rutrum lacus, id vestibulum metus dictum id. Curabitur dictum ullamcorper 
							bibendum. Phasellus quam justo. Sed vitae placerat dolor. Vivamus ultrices congue auctor. 
							Pellentesque sit amet posuere libero.
						</p>
					</div>
					<div id="footerSidebar">
						<h3>
							Consequat metus
						</h3>
						<ul class="linkedList">
							<li class="first">
								<a href="#">Vestibulum lacinia nisl dolore</a>
							</li>
							<li>
								<a href="#">Tristique amet sodales aliquam</a>
							</li>
							<li class="last">
								<a href="#">Tellus et volutpat sed etiam</a>
							</li>
						</ul>
					</div>
					<br class="clear" />
				</div>
			</div>
			<div id="copyright">
				&copy; DMAHockey.com | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
			</div>
		</div>
	</body>
</html>