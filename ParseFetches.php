<?php

function SSParseFetches(){
  
}

function SSParseFetchesRobinhood(){
  $Securities = Query("SELECT * FROM Security");
  foreach($Securities as $Security){
    $MostRecent = Query("SELECT MAX(TradingDate) as 'LastDate' FROM Daily WHERE Symbol LIKE '".$Security['Symbol']."'","stockhistory");
    $LastDate = strtotime($MostRecent[0]['LastDate']);
    
    $Data = Query("SELECT * FROM FeedFetch WHERE URL LIKE '%robinhood%' AND FetchTime > '".$LastDate."' ORDER BY FetchID DESC LIMIT 1");
    foreach($Data as $Fetch){
      $Content = $Fetch['Content'];
      $JSON = json_decode($Content,true);
      pd($JSON);
    }
    
  }
}
