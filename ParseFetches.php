<?php

function SSParseFetches(){
  
}

function SSParseFetchesNow(){
  //$Data = Query("SELECT * FROM FeedFetch ORDER BY FetchID DESC LIMIT 1");
  //echo strlen($Data[0]['Content']);
  //echo $Data[0]['Content'];
  
  global $ASTRIA;
  
  $Start    = microtime(true);
  $Content  = FetchURL('https://api.robinhood.com/quotes/historicals/DUST/?interval=5minute&span=week&bounds=regular');
  $End      = microtime(true);
  
  $Duration = $End - $Start;
  $URL      = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],'https://api.robinhood.com/quotes/historicals/DUST/?interval=5minute&span=week&bounds=regular');
  $Content  = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],$Content);
  $Expires=date('Y-m-d H:i:s',(time()+$Feed['TTL']));
  
  $SQL="
    INSERT INTO `FeedFetch` (
      `FeedID`, `URL`, `Arguments`, `FetchTime`, `Duration`, `Content`, `ContentLength`, `Expires`
    ) VALUES (
      '".$Feed['FeedID']."', 
      '".$URL."', 
      NULL /* TODO: Arguments (This is complicated and not immediately necessary.) */, 
      NOW(), 
      '".$Duration."', 
      '".$Content."',
      '".strlen($Content)."',
      '".$Expires."'
    );
  ";
  pd(Query($SQL));
}
