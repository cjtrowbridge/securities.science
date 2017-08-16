<?php

function FillInMissingAvg14AtOpen(){
  
  //Find a chunk of them that have not been filled in
  $Missings = Query("SELECT * FROM DailyQuotesWithRSI WHERE Avg14AtOpen IS NULL ORDER BY TradingDate DESC LIMIT 30");
  
  foreach($Missings as $Missing){
    
    //Get the previous 14 days' data
    $Data = Query("SELECT * FROM DailyQuotesWithRSI WHERE Symbol LIKE '".$Missing['Symbol']."' AND TradingDate < '".$Missing['TradingDate']."' ORDER BY TradingDate DESC LIMIT 14");
    
    //If there is not at least 14 days of data, skip this one.
    if(count($Data)<14){
      Query("UPDATE DailyQuotesWithRSI SET FillInMissingAvg14AtOpen = 0 WHERE DailyQuoteWithRSIID = ".Missing['DailyQuoteWithRSIID']);
      continue;
    }
    
    $Average = 0;
    
    foreach($Data as $Day){
    
      $Average += (($Day['Open'] + $Day['Close']) / 2);
    
    }
    
    Query("UPDATE DailyQuotesWithRSI SET FillInMissingAvg14AtOpen = '".$Average."' WHERE DailyQuoteWithRSIID = ".Missing['DailyQuoteWithRSIID']);
    
  }
}
