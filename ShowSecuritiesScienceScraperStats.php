<?php

function ShowSecuritiesScienceScraperStats(){
  ?>
  <h2>Scraper Stats</h2>
  <?php
  $Code="echo ArrTabler(Query('SELECT * FROM Statistics','stockhistory'));";
  ace($Code);
}
