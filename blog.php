<?php
  require('./lib/autoload.php');
  
  $db = DBFactory::getPDO();
  $postsManager = new PostsManager($db);
  $commentsManager = new CommentsManager($db);
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
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    
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
        <?php
            if(isset($_GET['id']) && ($postsManager->exists($_GET['id'])))
            {
                require('blogPost.php');
            }
            elseif(isset($_GET['search']))
            {
                require('blogSearch.php');
            }
            elseif(isset($_GET['author']))
            {
                require('blogAuthor.php');
            }
            else
            {
                require('blogList.php');
            }
        ?>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form method='GET' action='blog.php'>
                        <div class="input-group">
                            <input type="text" class="form-control" name='search'>
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
                            $nList = $postsManager->getRandom(3, []);
                          ?>
                        </ul>
                      </div>
                      <div class="col-lg-6">
                          <ul class="list-unstyled">
                            <?php
                              $postsManager->getRandom(3, $nList);
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

    <script>
        function setAuthor()
        {
            if($('.authorComment').length > 0)
            {
                $(".authorComment").val($('.authorName').html());
            }
        }

        setAuthor();

        $('.media').each(function()
        {
            var commentId = $(this).attr('commentId');
            var parentId = $(this).attr('parentId');
            $(this).appendTo()
        });

        $('.flat-list-buttons').click(function()
        {
            var commentId = $(this).attr('commentId');

            if($(this).html() == "reply")
            {
                var replyForm = "<div class='well'><h4>Leave a Comment as <span class='authorName'><?php echo (isset($_SESSION['pseudo'])) ? $_SESSION['pseudo'] : "Anonymous" ?></span></h4><form role='form' method='POST' action='comment.php?postId=<?php echo $post->id(); ?>&parentId="+ commentId +"'><div class='form-group'><input type='hidden' class='authorComment' name='author' /><textarea class='form-control' rows='3' name='content'></textarea></div><button type='submit' class='btn btn-primary'>Submit</button></form></div>";

                $(this).parent().after().append(replyForm);
                setAuthor();
            }
            else if($(this).html() == "report")
            {
                alert('report!');
            }
        });
    </script>
  </body>
</html>
