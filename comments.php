 <hr class="invis1">
<div class="custombox clearfix">
    <h4 class="small-title"><?php echo get_comments_number(); ?> Comments</h4>
    
    <div class="row">
        <div class="col-lg-12">
            <div class="comments-list">
                <?php
                
                $comment_list=array(
                'per_page'          => 10,
                'reverse_top_level' => true,
                'callback'          =>'better_commets'
                );
                wp_list_comments($comment_list);
                ?>
            </div>
            </div><!-- end col -->
            </div><!-- end row -->
            </div><!-- end custom-box -->
            <hr class="invis1">
<div class="custombox clearfix">
    <?php
    $args=array(
    'title_reply_before'=>'<h4 class="small-title">',
    'title_reply_after' => '</h4>',
    'class_form'        =>'form-wrapper',
    
    'class_submit'      =>'btn btn-primary',
    'fields'            =>array(
    'author'            =>'<input type="text" class="form-control" name="author" placeholder="Your name" required="required" >',
    'email'             =>'<input type="text" class="form-control" name="email" placeholder="Email address" required="required" >',
    'url'               =>'<input type="text" name="url" class="form-control" placeholder="Website">'
    ),
    'comment_field'     =>'<textarea class="form-control" name="comment" placeholder="Your comment" required="required" ></textarea>',
    );
    comment_form($args); ?>
</div>