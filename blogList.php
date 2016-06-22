<!--
*****************************
"List of Blog Posts"
Bootstrap 3.2.0 Snippet by pukey22
http://bootsnipp.com/snippets/featured/list-of-blog-posts
*****************************
-->
<div class="col-lg-8">
    <div id="postlist">
        <?php
            foreach($postsManager->getList(0, 10) as $post)
            {
                if(strlen($post->leadContent()) <= 301)
                {
                    $leadContent = $post->leadContent();
                }
                else
                {
                    $leadContent = substr($post->leadContent(), 0, 297);
                    $leadContent = substr($leadContent, 0) . '...';
                }
        ?>
        <div class="panel">
            <div class="panel-heading">
                <div class="text-center">
                    <div class="row">
                        <div class="col-sm-9">
                            <h3 class="pull-left"><a href='blog.php?id=<?php echo $post->id(); ?>'><?php echo $post->title(); ?></a></h3>
                        </div>
                        <div class="col-sm-3" style='padding-top:17px;'>
                            <h4 class="pull-right">
                                <small><em><?php echo $post->addDate()->format("l, d-m-Y H:i:s"); ?></em></small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="panel-body">
                <?php echo $leadContent; ?>
                <br/><a href="blog.php?id=<?php echo $post->id(); ?>">Read more</a>
            </div>
            
            <div class="panel-footer">
                <?php  
                    $tags = explode(",", $post->tags()); 
                    foreach($tags as $tag){ 
                        echo " <span class='label label-default'>". $tag . "</span>"; 
                    } 
                ?>
            </div>
        </div>
        <?php
            } //foreach closure
        ?>
    </div>
    
    <div class="text-center">
        <a href="#" id="loadmore" class="btn btn-primary">Pagination here</a>
    </div>
</div>