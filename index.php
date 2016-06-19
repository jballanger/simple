<?php
  require('./lib/autoload.php');

  $db = DBFactory::getPDO();
  $manager = new PostsManager($db);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Simple CMS</title>

    <!-- Bootstrap core CSS -->
    <link href="./bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./bootstrap/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./bootstrap/jumbotron.css" rel="stylesheet">
    <link href="./bootstrap/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="./bootstrap/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./bootstrap/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

   <?php require('menu.php'); ?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Hello, world!</h1>
        <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>
      </div>
    </div>

    <div class="container">
      <div class="row">
      <?php
        foreach($manager->getList(0, 3) as $post)
        {
          if(strlen($post->leadContent()) <= 251)
          {
            $leadContent = $post->leadContent();
          }
          else
          {
            $leadContent = substr($post->leadContent(), 0, 247);
            $leadContent = substr($leadContent, 0) . '...';
          }

          echo "<div class='col-md-4'><h2>". $post->title() ."</h2><p>". $leadContent ."</p><p><a class='btn btn-primary' href='post.php?id=". $post->id() ."'>View More »</a></p></div>";
        }
      ?>
      </div>

      <hr>

      <?php require('footer.php'); ?>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript -->
    <script src="./bootstrap/jquery.min.js"></script>
    <script src="./bootstrap/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./bootstrap/ie10-viewport-bug-workaround.js"></script>
  
  </body>
</html>