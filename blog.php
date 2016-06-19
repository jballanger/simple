<?php
  require('./lib/autoload.php');
  
  $db = DBFactory::getPDO();
  $manager = new PostsManager($db);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple CMS</title>

    <link href="./bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="./bootstrap/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <?php require('menu.php'); ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
        <?php (isset($_GET['id'])) ? require('blogPost.php') : ((isset($_GET['s'])) ? require('blogSearch.php') : require('blogList.php')); ?>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form method='GET' action='blog.php'>
                        <div class="input-group">
                            <input type="text" class="form-control" name='s'>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Random Posts</h4>
                    <div class="row">
                      <div class='col-lg-6'>
                        <ul class="list-unstyled">
                          <?php
                            $nList = $manager->getRandom(3, []);
                          ?>
                        </ul>
                      </div>
                      <div class="col-lg-6">
                          <ul class="list-unstyled">
                            <?php
                              $manager->getRandom(3, $nList);
                            ?>
                          </ul>
                      </div>
                    </div>
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>/other</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <hr>

        <?php require('footer.php'); ?>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="./bootstrap/jquery.min.js"></script>
    <script src="./bootstrap/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./bootstrap/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>
