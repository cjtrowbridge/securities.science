<?php

function SSParseFetches(){
  
}

function SSParseFetchesNow(){
  $Data = Query("SELECT * FROM FeedFetch ORDER BY FetchID DESC LIMIT 1");
  echo $Data[0]['Content'];
}
