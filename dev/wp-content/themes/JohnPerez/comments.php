		<div class="white_box">
                <h2>Comments</h2>
                <ul class="ext_list comments_box">
            		<?php wp_list_comments(); ?>      
                </ul>
              </div>

<?php
		$req_mess = '<span class="empty" style="display: block;">*This field is required.</span>';
        $commenter = wp_get_current_commenter();
		// $aria_req = ( $req ? " aria-required='true'" : '' );



		$name = '<label class="name"><span class="label">
        			<span class="text-form"></span>
        			<input name="author" type="text" value="'.esc_attr($commenter['comment_author']).'">
        			<span class="empty" style="display: block;">*This field is required.</span>
        			<span class="error" style="display: none;">*Invalid field.</span>
        		  </span></label>';
        $email = '<label class="email"><span class="label">
        			<span class="text-form"></span>
        			<input name="email" type="text" value="'.esc_attr($commenter['comment_author_email']).'">
        			<span class="empty" style="display: block;">*This field is required.</span>
        			<span class="error" style="display: none;">*Invalid field.</span>
        		  </span></label>';

        $comment_field = '<label class="message"><span class="label">
        					<span class="text-form"></span>
                            <textarea  name="comment" value="Message*">Message*</textarea>
                            <span class="error" style="display: none;">*Invalid field.</span>
                            <span class="empty" style="display: none;">*This field is required.</span>
                		  </span></label>';


        // $name = '<label><span>Your Name</span><input type="text"></label>';
        // $email = '<label><span>Email</span><input type="text"></label>';
        $submit_btn = '<label class="notRequired"><span class="label"><span></span><a href="#" id="submit_form" class="button-3">Submit Comment</a></span></label>';
		$fields =  array('author' => $name, 'email'=>$email);

// 'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		// 'email' => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',





// $comment_field = '<label><span>Message</span><textarea></textarea></label>';
$label_submit = '<label><span></span><a href="#" class="button-3">Submit Comment</a></label>';		  
$commenter = wp_get_current_commenter();  
$fields =  array(  
    'author' => '<p class="comment-form-author">' . '<label class="name" for="author">' . __( '' ) . '</label> ' . ( $req ? '<span class="required"></span>' : '' ) .  
                '<input id="author" name="author" type="text" value="Name*' . esc_attr( $commenter['comment_author'] ) . '" size="30" /></p>',  
    'email'  => '<p class="comment-form-email"><label for="email">' . __( '' ) . '</label> ' . ( $req ? '<span class="required"></span>' : '' ) .  
                '<input id="email" name="email" type="text" value="Email*' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /></p>',  
    'url'    => '<p class="comment-form-url"><label for="url">' . __( '' ) . '</label>' .  
                '<input id="url" name="url" type="text" value="Web Site' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',  
);   
		  
		  
		    		 
		$comments_args = array(
		'fields' => (apply_filters( 'comment_form_default_fields', $fields )),
		    'title_reply'=>'Leave a Comment',
		    'id_form'=>'leave_comment',
		    'comment_notes_before'=>'<p class="gray1 p3">Your email address will not be published. Required fields are marked *</p>',
		    'comment_notes_after'=>'',
			'label_submit' => __( 'Submit Comment' ), 
			'comment_field' => $comment_field
		);
?>
              <div class="white_box">
				<?php comment_form($comments_args); ?> 
              </div>