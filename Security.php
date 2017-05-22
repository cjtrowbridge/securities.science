<?php

function SecurityBodyCallback(){
  global $ASTRIA;
  $Title = 'Securities';
  $Symbol = null;
  if(!(path(1)==false)){
    $Symbol = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],path(1));
    $Symbol=strtoupper($Symbol);
    $Symbol=Query("SELECT Symbol FROM Security WHERE Symbol LIKE '".$Symbol."'");
    if(isset($Symbol[0])){
      $Symbol=$Symbol[0]['Symbol'];
      $Title=$Symbol;
    }
  }
  
  
  
  //SHOWING A LIST OF SECURITIES
  
  if($Symbol==null){
    ?>
  <h1><?php echo $Title; ?></h1>
  <p>Here are all the securities we track;</p>
    <?php
    
    $Securities=Query("
      SELECT * 
      FROM Security
    ");
    foreach($Securities as $Security){
      ?>
      <p><b><?php echo $Security['Symbol']; ?></b></p>
      <p><?php echo $Security['Desciption']; ?></p>
      <?php
    }
  }
  
  
  //SHOWING A SINGLE SECURITY
  ?>
  <h1>/<a href="/security">Security</a>/<?php echo $Title; ?></h1>
  <?php
  //Increment Hit Counter
  Query("
    UPDATE Security 
    SET Hits = Hits + 1 
    WHERE Symbol LIKE '".$Symbol."'
  ");
  
  //Show Recent Activity
  ?>
  <h2>Last 14 Days</h2>
  <?php
  $Table=Query("
    SELECT 
      *,
      ROUND(AvgAdvance14,4) as 'AvgAdvance14',
      ROUND(AvgDecline14,4) as 'AvgDecline14',
      ROUND(RSI14) as 'RSI14'
      
    FROM DailyQuotesWithRSI 
    WHERE 
      Symbol LIKE '".$Symbol."'
    ORDER BY TradingDate DESC
    LIMIT 14
  ","stockhistory");
  echo ArrTabler($Table);
}
