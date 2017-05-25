<?php

function SSParseFetches(){
  
}

function SSParseFetchesNow(){
  //$Data = Query("SELECT * FROM FeedFetch ORDER BY FetchID DESC LIMIT 1");
  //echo strlen($Data[0]['Content']);
  //echo $Data[0]['Content'];
  $Data = FetchURL('https://api.robinhood.com/quotes/historicals/DUST/?interval=5minute&span=week&bounds=regular');
  $Data  = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],$Data);
  echo strlen($Data);
  echo $Data;
}
