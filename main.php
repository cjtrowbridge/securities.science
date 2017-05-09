<?php

Hook('User Is Not Logged In','PublicHomepage();');

function PublicHomepage(){
  include('PublicHomepage.php');
  TemplateBootstrap4('home','PublicHomepageBodyCallback();');
}
