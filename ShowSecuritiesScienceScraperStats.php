<?php

function ShowSecuritiesScienceScraperStats(){
  ?>
  <h2>Scraper Stats</h2>
  <?php
  $Code="echo ArrTabler(Query('SELECT * FROM Statistics','stockhistory'));";
  ace($Code,'','','This will take a while to load. It is very complicated...');
}
