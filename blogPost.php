            <?php 
                $reqPost = $postsManager->getUnique((int) $_GET['id']);
                $reqPost['addDate'] = (new Datetime($reqPost['addDate']));
                $reqPost['uppDate'] = (new Datetime($reqPost['uppDate']));
                $post = new Posts($reqPost);
            ?>
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post->title(); ?></h1>

                <!-- Author -->
                <p class="lead">
                  by <a href="user.php?u=<?php echo $post->author(); ?>"><?php echo $post->author(); ?></a>
                  <ol class="breadcrumb">
                    <li><a href="index.php">Simple</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="blog.php?author=<?php echo $post->author(); ?>"><?php echo $post->author(); ?></a></li>
                    <li class="active"><?php echo $post->title(); ?></li>
                  </ol>
                </p>

                <hr>
                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post->addDate()->format("l, d-m-Y H:i:s"); ?></p>
                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="http://placehold.it/900x300" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">
                  <?php echo $post->leadContent(); ?>
                </p>

                <?php echo $post->content(); ?>

                <hr>
                <!-- Blog Comments -->

                <?php
                    if(isset($_GET['error']))
                    {
                        echo "<div class='alert alert-danger'>An error occurred, please try again later or contact an Administrator.</div>";
                    }
                    elseif(isset($_GET['success']))
                    {
                        echo "<div class='alert alert-success'>Comment posted successfully !</div>";
                    }
                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>
                    Leave a Comment as <span class='authorName'><?php echo (isset($_SESSION['pseudo'])) ? $_SESSION['pseudo'] : "Anonymous" ?></span>
                    </h4>
                    <form role="form" method="POST" action="comment.php?postId=<?php echo $post->id(); ?>&parentId=0">
                        <div class="form-group">
                            <input type='hidden' class='authorComment' name='author' />
                            <textarea class="form-control" rows="3" name="content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>
                <!-- Comments -->
                <section class="comment-list">
                    <?php
                        if($commentsManager->getComments($post->id(), false, false))
                        {
                            foreach($commentsManager->getComments($post->id(), false, false) as $comment)
                            {
                    ?> 
                    <article class="row">
                        <div class="col-md-2 col-sm-2 hidden-xs">
                          <figure class="thumbnail">
                            <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                            <figcaption class="text-center"><?php echo $comment->author(); ?></figcaption>
                          </figure>
                        </div>
                        <div class="col-md-10 col-sm-10">
                          <div class="panel panel-default arrow left">
                            <div class="panel-body">
                              <header class="text-left">
                                <div class="comment-user"><i class="fa fa-user"></i> <?php echo $comment->author(); ?></div>
                                <time class="comment-date" datetime="<?php echo $post->addDate()->format("l, d-m-Y H:i:s"); ?>">
                                    <i class="fa fa-clock-o"></i> <?php echo $post->addDate()->format("l, d-m-Y H:i:s"); ?>
                                </time>
                              </header>
                              <div class="comment-post">
                                <p>
                                 <?php echo $comment->content(); ?>
                                </p>
                              </div>
                              <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
                            </div>
                          </div>
                        </div>
                    </article>
                    <?php
                            } //foreach closure
                        } //if closure
                    ?>
                </section>
            </div>
