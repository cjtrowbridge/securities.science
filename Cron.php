<?php

Hook('Hourly Cron','SecuritiesScienceHourlyCron();');
function SecuritiesScienceHourlyCron(){
  //SendEmail('This is an hourly cron alert.','cron','chris.j.trowbridge@gmail.com');
}

Hook('Daily Cron','SecuritiesScienceDailyCron();');
function SecuritiesScienceDailyCron(){
  //SendEmail('This is a daily cron alert.','cron','chris.j.trowbridge@gmail.com');
  if(file_exists('plugins/securities.science/InsertWorker.php')){
    include('plugins/securities.science/InsertWorker.php');
  }
}

Hook('Weekly Cron','SecuritiesScienceWeeklyCron();');
function SecuritiesScienceWeeklyCron(){
  //SendEmail('This is a weekly cron alert.','cron','chris.j.trowbridge@gmail.com');
}
