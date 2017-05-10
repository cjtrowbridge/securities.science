<?php

Hook('User Is Not Logged In','PublicPage();');

function PublicPage(){
  Nav('main-not-logged-in','link','Explore','/explore');
  Nav('main-not-logged-in','link','Login','/login');
  switch(path(0)){
    case 'login':
      PromptForLogin();
      break;
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
  
  //If the user is logged in, they can run queries
  include('QueryEngine.php');
  SecuritiesScienceQueryEngine();
  
  Nav('main-logged-in','link','My Data','/my-data');
  Nav('main-logged-in','link','Explore','/explore');
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
