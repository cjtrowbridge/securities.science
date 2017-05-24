<?php

Hook('Hourly Cron','SecuritiesScienceHourlyCron();');
function SecuritiesScienceHourlyCron(){
  SendEmail('This is an hourly cron alert.','cron','chris.j.trowbridge@gmail.com');
}

Hook('Daily Cron','SecuritiesScienceDailyCron();');
function SecuritiesScienceDailyCron(){
  SendEmail('This is a daily cron alert.','cron','chris.j.trowbridge@gmail.com');
}

Hook('Weekly Cron','SecuritiesScienceWeeklyCron();');
function SecuritiesScienceWeeklyCron(){
  SendEmail('This is a weekly cron alert.','cron','chris.j.trowbridge@gmail.com');
}
