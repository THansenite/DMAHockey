<html>
<head>
	<title>DMAHockey.com</title>
	<link href="common/styles.css" rel="stylesheet">

<!-- Google Analytics Tracking Script-->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-5932229-1', 'auto');
	  ga('send', 'pageview');

	</script>

</head>
<body background="black">
<div id="content">

<div align="center">
<img src="images/ABC_Logo3.jpg" alt="ABC League Logo">
</div>

<h1>2014-15 Team Standings</h1>
<table id="standings" align="center">
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

		echo "<tr><td align=left>";
		echo htmlentities($team);
		echo "</td><td align=center>";
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

<h1>2014-15 Schedule</h1>
<table id="schedule" align="center">

<thead>
	<tr>
		<th>Date</th>
		<th>Time</th>
		<th>Home Team</th>
		<th>Away Team</th>
		<th>Score</th>
	</tr>
</thead>
<tbody>
<?php
	include ("common/db_setup.php");
	$connection = mysqli_connect($server, $username, $password, $database) or die ("Connection failed");
	$query = "select date_format(sched.date,'%c/%e/%y') as 'date', time_format(sched.time,'%h:%i %p') as 'time', team1.name as 'home', team2.name as 'away', g.special_case as 'outcome', g.home_score as 'home_score', g.away_score as 'away_score' from schedule sched join team team1 on sched.home = team1.id join team team2 on sched.away = team2.id left join game g on g.id = sched.id";
	$result = mysqli_query($connection, $query) or die("Query failed");

	while ($row = mysqli_fetch_assoc($result)) {
		$date = $row['date'];
		$time = $row['time'];
		$home = $row['home'];
		$away = $row['away'];
		$outcome = $row['outcome'];
		$home_score = $row['home_score'];
		$away_score = $row['away_score'];

		echo "<tr><td align=center>";
		echo htmlentities($date);
		echo "</td><td align=center>";
		echo htmlentities($time);
		echo "</td><td align=center>";
		if ($home_score > $away_score || $outcome == 'A_SOL' || $outcome == 'A_FOR') {
			echo "<strong>";
			echo htmlentities($home);
			echo "</strong>";
		}
		else
		{
			echo htmlentities($home);
		}
		echo "</td><td align=center>";
		if ($home_score < $away_score || $outcome == 'H_SOL' || $outcome == 'H_FOR') {
			echo "<strong>";
			echo htmlentities($away);
			echo "</strong>";
		}
		else
		{
			echo htmlentities($away);
		}
		echo "</td><td align=center>";
		if (is_null($outcome))
		{
			echo "";
		}
		else
		{
			echo htmlentities($home_score);
			echo " - ";
			echo htmlentities($away_score);
			if ($outcome == 'H_SOL' || $outcome == 'A_SOL') 
			{
				echo " (SO)";
			}
			if ($outcome == 'H_FOR' || $outcome == 'A_FOR') 
			{
				echo " (F)";
			}
		}
		echo "</td></tr>";
	}
	mysqli_free_result($result);
	mysqli_close($connection);
?>
</tbody>
</table>

<p><em>- Please look over the recently updated <a href="common/discipline-flowchart.pdf" target="_blank">discipline flowchart</a> for assessing suspensions.</em></p>

	<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:black; clear:left; font:18px Helvetica,Arial,sans-serif; font-weight: bold; color: gray; text-align: center;}
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>

<div id="mc_embed_signup" align="center" margin="20px">
<form action="//DMAHockey.us7.list-manage.com/subscribe/post?u=3d8e9402ae40e1f93cd346122&amp;id=665cb5755d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
	<label for="mce-EMAIL" >Sign up now for league updates!</label><br/>
	<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;"><input type="text" name="b_3d8e9402ae40e1f93cd346122_665cb5755d" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
</form>
</div>

<!--End mc_embed_signup-->
	</th>
</tr>
</table>



</div>
</body>
</html>