            <?php 
                $reqPost = $manager->getUnique((int) $_GET['id']);
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

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment :</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Comments -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                </div>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>
                <!-- End Comments -->
            </div>