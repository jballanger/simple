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
                    <h4>Leave a Comment as <span id='authorName'><?php echo (isset($_SESSION['pseudo'])) ? $_SESSION['pseudo'] : "Anonymous" ?></span></h4>
                    <form role="form" method="POST" action="comment.php?postId=<?php echo $post->id(); ?>&parentId=0">
                        <div class="form-group">
                            <input type='hidden' id='authorComment' name='author' />
                            <textarea class="form-control" rows="3" name="content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Comments -->
                <?php 
                    if(!empty($commentsManager->getComments($post->id(), false)))
                    {
                        foreach($commentsManager->getComments($post->id(), false) as $comment)
                        {
                ?>
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author(); ?>
                            <small><?php echo $comment->addDate()->format("l, d-m-Y H:i:s"); ?></small>
                        </h4>
                        <?php echo $comment->content(); ?>
                        <!-- Nested Comment -->
                        <?php
                            foreach($commentsManager->getComments($post->id(), true) as $nestedComment)
                            {
                                if($nestedComment->parentId() == $comment->id())
                                {
                        ?>
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $nestedComment->author(); ?>
                                    <small><?php echo $nestedComment->addDate()->format("l, d-m-Y H:i:s"); ?></small>
                                </h4>
                                <?php echo $nestedComment->content(); ?>
                            </div>
                        </div>
                        <?php
                                } // if closure
                            } // foreach closure
                        ?>
                        <!-- End Nested Comment -->
                    </div>
                </div>
                <?php
                        } //foreach closure
                    } //if closure
                ?>
                <!-- End Comments -->
            </div>