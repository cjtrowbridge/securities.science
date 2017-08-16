<?php

function FillInMissingOpenGaps(){
  
  //Find a chunk of them that have not been filled in
  $Missings = Query("SELECT * FROM `stockhistory`.DailyQuotesWithRSI WHERE OpenGap IS NULL ORDER BY TradingDate DESC");
  
  foreach($Missings as $Missing){
    
    //Get the previous days' data
    $Data = Query("SELECT * FROM `stockhistory`.DailyQuotesWithRSI WHERE Symbol LIKE '".$Missing['Symbol']."' AND TradingDate < '".$Missing['TradingDate']."' ORDER BY TradingDate DESC LIMIT 1");
    
    //If there is not at least one previous day of data, skip this one.
    if(count($Data)<1){
      Query("UPDATE `stockhistory`.DailyQuotesWithRSI SET OpenGap = 0 WHERE DailyQuoteWithRSIID = ".$Missing['DailyQuoteWithRSIID']);
      continue;
    }
    
    $Gap = $Missing['Open'] - $Data[0]['Close'];
    
    
    $SQL="UPDATE `stockhistory`.DailyQuotesWithRSI SET OpenGap = '".$Gap."' WHERE DailyQuoteWithRSIID = ".$Missing['DailyQuoteWithRSIID'];
    Query($SQL);
    
  }
}
