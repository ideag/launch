<?php 
  function _t( $file ) {
    echo get_stylesheet_directory_uri().'/'.$file;
  }

  add_filter( 'tinynewsletter_subscribe_form_template' , 'launch_subscribe' );
  function launch_subscribe( $template ) {
  	$template = '                        <form action="%1$s" method="post" class="%2$s">
  							<input type="email" id="email" name="email" placeholder="%3$s" required/>
                            <button type="submit" class="button icon submit" name="subscribe"></button>
  							<input type="hidden" name="list" value="%4$s">
  							<input type="hidden" name="user" value="">
                        %6$s
                        </form>
';
  	return $template;
  }
?>