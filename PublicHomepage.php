<?php

function PublicHomepageBodyCallback(){
  ?>
	


<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Welcome to securities.science</h1>
			<p><i>This site is a way of running analytical models against useful historic datasets and publishing successes for mutual benefit.</i></p>

			<p>Log in to run your own strategies and contribute to the ones you like!</p>
			<?php Event('Auth Login Options'); ?>
			
			<p>Here is some recent research I have done, demonstrating the efficacy of buying leveraged commodity ETFs when the RSI-14 indicates they are underbought.</p>
			<?php

$SQL="SELECT
	Symbol,
	MIN(TradingDate)                           AS 'Simulation Run Since',
	MAX(TradingDate)			   AS 'Simulation Run Through',
	COUNT(*)                                   AS 'Number of Opportunities',
	AVG(Advance)                               AS 'Average Daily Advance',
	AVG(Open)                                  AS 'Average Opening Price',
	AVG(Advance) / AVG(Open) * 100             AS 'Average Percent Growth Per Trade',
	AVG(Advance) / AVG(Open) * COUNT(*) * 100  AS 'Average Compound Growth To Date'

FROM DailyQuotesWithRSI
WHERE RSI14 < 30
GROUP BY Symbol
ORDER BY `Average Compound Growth To Date` DESC
";
echo "<h2>Strategy 1</h2>\n";
echo "<p>This strategy is a very obvious one which I can not take credit for. This assumes that whenever the RSI-14 of a stock is below 30, buy it at the following open and then sell at close. Proving this correct is simply a way of validating that the system is working.</p>\n";
$Strategy1=Query($SQL);
echo "<pre>".$SQL."</pre>";
echo ArrTabler($Strategy1);


$SQL="
SELECT
	Symbol,
	MIN(TradingDate)                           AS 'Simulation Run Since',
	MAX(TradingDate)                           AS 'Simulation Run Through',
	COUNT(*)                                   AS 'Number of Opportunities',
	AVG(Advance)                               AS 'Average Daily Advance',
	AVG(Open)                                  AS 'Average Opening Price',
	AVG(High-Low) / AVG(Low) * 100             AS 'Average Percent Growth Per Trade',
	AVG(High-Low) / AVG(Low) * COUNT(*) * 100  AS 'Average Compound Growth To Date'

FROM DailyQuotesWithRSI
WHERE RSI14 < 30
GROUP BY Symbol
ORDER BY `Average Compound Growth To Date` DESC
";
echo "<h2>Strategy 2</h2>\n";
echo "<p>This strategy is more optimistic. It assumes you buy at the low and sell at the high point on the day after each RSI-14 hits 30 or lower at close the night before. As you can see, there is a huge improvement but this is too optimistic to actually accomplish. My point here is that buying at opening and selling at close is not necessarily the best strategy for leveraging RSI-14 data..</p>";
$Strategy2=Query($SQL);
echo "<pre>".$SQL."</pre>";
echo ArrTabler($Strategy2);





			?>

		</div>
	</div>
</div>
<p>&nbsp;</p>

<?php
}
