<?php

include('QueryEngine.php');

Hook('Template Head','SecuritiesScienceTemplateHead();');
function SecuritiesScienceTemplateHead(){
  ?>
  <link rel="stylesheet" href="/plugins/securities.science/style.css">
<?php
}

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
      TemplateBootstrap4('Explore','PublicExploreBodyCallback();');
      break;
    default:
      include('PublicHomepage.php');
      TemplateBootstrap4('Home','PublicHomepageBodyCallback();');
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
      TemplateBootstrap4('Explore','UserExploreBodyCallback();');
      break;
    case 'create-query':
      include('UserCreateQuery.php');
      if(isset($_POST['name'])){
        UserCreateQueryPostHandler();
      }else{
        TemplateBootstrap4('Create Query','UserCreateQueryBodyCallback();');
      }
      break;
    case 'edit-query':
      include('UserEditQuery.php');
      if(isset($_POST['QueryID'])){
        UserEditQueryPostHandler();
      }else{
        TemplateBootstrap4('Edit Query','UserEditQueryBodyCallback();');
      }
      break;
    default:
      include('UserHomepage.php');
      TemplateBootstrap4('Home','UserHomepageBodyCallback();');
      break;
  }
  
}
