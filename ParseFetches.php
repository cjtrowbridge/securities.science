<?php

function SSParseFetches(){
  
}

function SSParseFetchesRobinhood(){
  $Securities = Query("SELECT * FROM Security");
  foreach($Securities as $Security){
    $MostRecent = Query("SELECT MAX(TradingDate) as 'LastDate' FROM Daily WHERE Symbol LIKE '".$Security['Symbol']."'","stockhistory");
    $LastDate = strtotime($MostRecent[0]['LastDate']);
    
    while($LastDate < time()){
      //check for data
      $SQL="SELECT * FROM FeedFetch WHERE URL LIKE '%robinhood%' AND FetchTime LIKE '%".date('Y-m-d',$LastDate)."T16:00%' ORDER BY FetchID DESC LIMIT 1";
      $Data = Query($SQL);
      pd($SQL);
      pd($Data);
      //add to dailies
      
      //plus one day
      $LastDate += (60*60*24);
    }
    
  }
}
