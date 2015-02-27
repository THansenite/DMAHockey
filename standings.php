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
	<?php include ("common/tracking.php");?>
		<div id="bg">
			<div id="outer">
				<div id="header">
				<?php include ("common/header.php");?>
				</div>
				<div id="main">
					<div id="sidebar1">
						<?php include ("common/teams.php");?>
					</div>
					<div id="sidebar2">
						<?php include ("common/recent_scores.php");?>
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
					<?php include ("common/footer.php");?>
				</div>
			</div>
			<div id="copyright">
				&copy; DMAHockey.com | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
			</div>
		</div>
	</body>
</html>
