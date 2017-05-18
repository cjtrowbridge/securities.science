<?php

function ShowSecuritiesScienceScraperStats(){
  ?>
  <h2>Scraper Stats</h2>
  <?php
  $Stats=Query('SELECT * FORM Statistics','stockhistory');
  echo ArrTabler($Stats);
}
