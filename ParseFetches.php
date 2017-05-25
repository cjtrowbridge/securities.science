<?php

function SSParseFetches(){
  
}

function SSParseFetchesRobinhood(){
  $Data = Query("SELECT * FROM FeedFetch WHERE URL LIKE '%robinhood%' ORDER BY FetchID DESC LIMIT 1");
  foreach($Data as $Fetch){
    pd($Fetch);
  }
}
