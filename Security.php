<?php

function SecurityBodyCallback(){
  global $ASTRIA;
  $Title = 'Securities';
  if(!(path(1)==false)){
    $Symbol = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],path(1));
    $Symbol=strtoupper($Symbol);
    $Symbol=Query("SELECT Symbol FROM Security WHERE Symbol LIKE '".$Symbol."'");
    if(isset($Symbol[0])){
      $Title=$Symbol[0]['Symbol'];
    }
  }
  ?>
  <h1><?php echo $Title; ?></h1>
  <h2>Last 14 Days</h2>
  <?php
  $Table=Query("
    SELECT * 
    FROM DailyQuotesWithRSI 
    WHERE 
      Symbol LIKE '".$Symbol."' AND 
      TradingDate >= DATE_SUB(NOW(),INTERVAL 14 DAY) 
    ORDER BY TradingDate DESC
  ","stockhistory");
  echo ArrTabler($Table);
}
