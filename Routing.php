<?php

include('RunQuery.php');
include('Cron.php');

Hook('FeedSync Fetch Service Done','SSParser();');
function SSParser(){
  include('ParseFetches.php');
  SSParseFetches();
}

Hook('Template Head','SecuritiesScienceTemplateHead();');
function SecuritiesScienceTemplateHead(){
  ?>
  <link rel="stylesheet" href="/plugins/securities.science/style.css">
<?php
}

Hook('User Is Not Logged In - Before Presentation','PublicPageBefore();');

function PublicPageBefore(){
  Nav('main-not-logged-in','link','Login','/login');
}


Hook('User Is Not Logged In - Presentation','PublicPage();');

function PublicPage(){
  switch(path(0)){
    case 'run-query':
      global $ThisQuery;
      $ThisQuery = Query("SELECT QueryID,Name,Description,ParserLastOutput,Code FROM Query WHERE QueryID = ".intval(path(1)));
      if(isset($ThisQuery[0])){
        $Title=$ThisQuery[0]['Name'];
      }else{
        $ThisQuery='Query Not Found';
      }
      TemplateBootstrap4($Title,'RunQueryBodyCallback();');
      break;
    case false:
    case 'explore':
      include('PublicExplore.php');
      TemplateBootstrap4('Explore','PublicExploreBodyCallback();');
      break;
    case 'explore-table':
      include('ExploreTable.php');
      TemplateBootstrap4('Table Explorer','ExploreTableBodyCallback();');
      break;
    default:
    case 'login':
      PromptForLogin();
      break;
  }
}


Hook('User Is Logged In - Before Presentation','UserPageBefore();');

function UserPageBefore(){
  include_once('ShowSecuritiesScienceScraperStats.php');
  Hook('Architect Homepage','ShowSecuritiesScienceScraperStats();');
  Nav('main-logged-in','link','Explore','/explore');
}


Hook('User Is Logged In - Presentation','UserPage();');

function UserPage(){
  global $ASTRIA;
  switch(path(0)){
    case 'security':
      include('Security.php');
      $Title='Security';
      if(!(path(1)==false)){
        $Symbol = mysqli_real_escape_string($ASTRIA['databases']['astria']['resource'],path(1));
        $Symbol=strtoupper($Symbol);
        $Symbol=Query("SELECT Symbol FROM Security WHERE Symbol LIKE '".$Symbol."'");
        if(isset($Symbol[0])){
          $Title=$Symbol[0]['Symbol'];
        }
      }
      TemplateBootstrap4($Title,'SecurityBodyCallback();',true);
      break;
    case 'explore-table':
      include('ExploreTable.php');
      TemplateBootstrap4('Table Explorer','ExploreTableBodyCallback();');
      break;
    case 'run-query':
      global $ThisQuery;
      $ThisQuery = Query("SELECT QueryID,Name,Description,ParserLastOutput,Code FROM Query WHERE QueryID = ".intval(path(1)));
      if(isset($ThisQuery[0])){
        $Title=$ThisQuery[0]['Name'];
      }else{
        $ThisQuery='Query Not Found';
      }
      TemplateBootstrap4($Title,'RunQueryBodyCallback();');
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
    case 'test':
      include('ParseFetches.php');
      SSParseFetchesNow();
    case 'delete-query':
      include('UserDeleteQuery.php');
      UserDeleteQueryHandler();
      break;
    case 'undelete-query':
      include('UserUndeleteQuery.php');
      UserUndeleteQueryHandler();
      break;
    default:
      include('UserHomepage.php');
      TemplateBootstrap4('Home','UserHomepageBodyCallback();');
      break;
    case 'explore':
      include('PublicExplore.php');
      include('UserExplore.php');
      TemplateBootstrap4('Explore','UserExploreBodyCallback();');
      break;
  }
  
}
