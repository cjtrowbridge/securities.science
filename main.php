<?php

include('QueryEngine.php');
 

Hook('User Is Not Logged In - Before Presentation','PublicPageBefore();');

function PublicPageBefore(){
  Nav('main-not-logged-in','link','Explore','/explore');
  Nav('main-not-logged-in','link','Login','/login');
}


Hook('User Is Not Logged In - Presentation','PublicPage();');

function PublicPage(){
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


Hook('User Is Logged In - Before Presentation','UserPageBefore();');

function UserPageBefore(){
  Nav('main-logged-in','link','Explore','/explore');
  include_once('ShowSecuritiesScienceScraperStats.php');
  Hook('Architect Homepage','ShowSecuritiesScienceScraperStats();');
}


Hook('User Is Logged In - Presentation','UserPage();');

function UserPage(){
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
