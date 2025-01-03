<?php
if( ! function_exists( 'better_commets' ) ):
function better_commets($comment, $args, $depth) {
    ?>
   <div class="media" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <a class="img-thumbnail media-left d-none d-sm-block">
                <?php echo get_avatar($comment,$size='80',$default='http://0.gravatar.com/avatar/36c2a25e62935705c5565ec465c59a70?s=32&d=mm&r=g' ); ?>
            </a>

            <div class="comment-block media-body">
                 <h4 class="media-heading user_name"><?php echo get_comment_author() ?> <small><?php printf(/* translators: 1: date and time(s). */ esc_html__('%1$s at %2$s' , '5balloons_theme'), get_comment_date(),  get_comment_time()) ?></small></h4>
                <div class="comment-arrow"></div>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em><?php esc_html_e('Your comment is awaiting moderation.','5balloons_theme') ?></em>
                        <br />
                    <?php endif; ?>
                <p> <?php comment_text() ?></p>
                <span class="float-left">
                    <span class="btn btn-primary btn-sm">
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        
                        
                    </span>
                </span>
            </div>
    </div>    

<?php
        }
endif;
