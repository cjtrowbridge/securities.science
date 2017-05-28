<?php

function SSParseFetches(){
  
}

function SSParseFetchesRobinhood(){
  $MarketOpen = '9:30am';
  $MarketClose = '4:00pm';
  $Date = new DateTime($MarketOpen, new DateTimeZone('America/New_York'));
  $MarketOpen = $Date->format('U');
  $Date = new DateTime($MarketClose, new DateTimeZone('America/New_York'));
  $MarketClose = $Date->format('U');

  $Interval = 60*5;


  $Securities = Query("SELECT * FROM Security");
  $URL='https://api.robinhood.com/quotes/historicals/?symbols=';
  foreach($Securities as $Security){
    $URL.=$Security['Symbol'].',';
  }
  $URL.='&span=year&interval=day&bounds=regular';
  pd($URL);
}

function sadfsd(){foreach($A as $b){
    
    $MostRecent = Query("SELECT MAX(TradingDate) as 'LastDate' FROM Daily WHERE Symbol LIKE '".$Security['Symbol']."'","stockhistory");
    $LastDate = strtotime($MostRecent[0]['LastDate']);
    $WorkingDate = $LastDate + (60*60*24);
    
    while($WorkingDate < time()){
      //check for data
      $SQL="SELECT * FROM FeedFetch WHERE URL LIKE '%robinhood%' AND URL LIKE '%/".$Security['Symbol']."/%' AND Content LIKE '%".gmdate('Y-m-d',$WorkingDate)."T".gmdate('H:i',$MarketOpen)."%' ORDER BY FetchID DESC LIMIT 1";
      $Data = Query($SQL);
      $Open = null;
      $Close = null;
      foreach($Data as $Fetch){
        $JSON = json_decode($Fetch['Content'],true);
        $Open = $JSON['open_price'];
        foreach($JSON['historicals'] as $Quote){
          $CloseTime = gmdate('Y-m-d',$WorkingDate-$Interval)."T".gmdate('H:i',$MarketClose-$Interval).":00Z";
          if($Quote['begins_at']==$CloseTime){
            $Close = $Quote['close_price'];
          }
        }
      }

      pd($SQL);

      $Advance = 0;
      $Decline = 0;

      if($Close > $Open){
        $Advance = $Close - $Open;
      }else{
        $Decline = $Open - $Close;
      }

      if(
        (!($Open==null))&&
        (!($Close==null))
      ){

        //Add to RSI14 Table
        $SQL="
          INSERT INTO `stockhistory`.`RSI14` (
            TradingDate, Symbol, Open, Close, Advance, Decline
          )VALUES(
            '".date('Y-m-d',$WorkingDate)."','".$Security['Symbol']."','".$Open."','".$Close."','".$Advance."','".$Decline."'
          );
        ";
        pd($SQL);
        //Query($SQL,"stockhistory");
      }
      //plus one day
      $WorkingDate += (60*60*24);
    }
    
  }
}

function FillInMissingRSI14(){
  //find all quotes with missing rsi
  $Missing = Query("SELECT * FROM `stockhistory`.`RSI14` WHERE RSI14 IS NULL");
  foreach($Missing as $Quote){
    //see if there is enough data to calculate
    //calculate
    $RSI14 = Query("
      SELECT 100 - (100 / (1+(SUM(Advance)/14) / (SUM(Decline)/14)))as 'RSI14'
      FROM (SELECT * FROM `stockhistory`.`RSI14`
      WHERE Symbol LIKE '".$Security['Symbol']."' AND TradingDate < '".date('Y-m-d',$WorkingDate)."' ORDER BY TradingDate DESC LIMIT 14) Old
    ");
    $RSI14 = $RSI14[0]['RSI14'];
    
    //update quote
  }
}
