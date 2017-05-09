<?php

Hook('User Is Not Logged In','PublicPage();');

function PublicPage(){
  Nav('main','link','My Data','/');
  Nav('main','link','Explore','/explore');
  switch(path(0)){
    case 'explore':
      include('PublicExplore.php');
      TemplateBootstrap4('explore','PublicExploreBodyCallback();');
      break;
    default:
      include('PublicHomepage.php');
      TemplateBootstrap4('home','PublicHomepageBodyCallback();');
      break;
  }
}


Hook('User Is Logged In','UserPage();');

function UserPage(){
  Nav('main','link','My Data','/');
  Nav('main','link','Explore','/explore');
  switch(path(0)){
    case 'explore':
      include('UserExplore.php');
      TemplateBootstrap4('explore','UserExploreBodyCallback();');
      break;
    default:
      include('UserHomepage.php');
      TemplateBootstrap4('home','UserHomepageBodyCallback();');
      break;
  }
  
}
