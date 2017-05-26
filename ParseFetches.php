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
      $Data = Query("SELECT * FROM FeedFetch WHERE URL LIKE '%robinhood%' AND FetchTime LIKE '%".date('Y-m-d',$LastDate)."T16%' ORDER BY FetchID DESC LIMIT 1");
      pd($Date);
      //add to dailies
      
      //plus one day
      $LastDate += (60*60*24);
    }
    
    /*
    $Data = Query("SELECT * FROM FeedFetch WHERE URL LIKE '%robinhood%' AND FetchTime > '".date('Y-m-d',$LastDate)."' ORDER BY FetchID DESC LIMIT 1");
    foreach($Data as $Fetch){
      $Content = $Fetch['Content'];
      $JSON = json_decode($Content,true);
      foreach($JSON['Historical'] as $Quote){
        $QuoteTime = strtotime($Quote['begins_at']);
        if(
          ($QuoteTime > $LastDate) &&
          (date('H',$QuoteTime) > 16
        ){
          
        }
      }
    }
  */
  }
}
