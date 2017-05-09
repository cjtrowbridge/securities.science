<?php

Hook('User Is Not Logged In','PublicHomepage();');

function PublicHomepage(){
  include('PublicHomepage.php');
  TemplateBootstrap4('home','PublicHomepageBodyCallback();');
}


Hook('User Is Logged In','UserHomepage();');

function UserHomepage(){
  include('UserHomepage.php');
  TemplateBootstrap4('home','UserHomepageBodyCallback();');
}
