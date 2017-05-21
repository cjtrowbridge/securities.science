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
  ?>
  <h1><?php echo $Title; ?></h1>
  <?php
  
  
  //SHOWING A LIST OF SECURITIES
  
  if($Symbol==null){
    ?>
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
    SELECT * 
    FROM DailyQuotesWithRSI 
    WHERE 
      Symbol LIKE '".$Symbol."' AND 
      TradingDate >= DATE_SUB(NOW(),INTERVAL 14 DAY) 
    ORDER BY TradingDate DESC
  ","stockhistory");
  echo ArrTabler($Table);
}
