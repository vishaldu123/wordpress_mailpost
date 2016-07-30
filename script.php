/*-----------------------------------------------------------------------------------*/
/* My Custom --Vishal Dubey
/*-----------------------------------------------------------------------------------*/

function cat_chk($post_ID){
	$categories = get_the_category( $post_ID );
	foreach($categories as $cat)
	{
		if($cat->name=='E-mail'){
			$args = array('role'=> 'subscriber'); 
			$user_query = get_users( $args );
			foreach ($user_query as $user) {
				//$user->display_name $user->user_email bloginfo('admin_email') the_title()  the_content()
				$post = get_post($post_ID); //assuming $id has been initialized
				//setup_postdata($post);
				if( $post->post_modified_gmt == $post->post_date_gmt ){
					$title=get_the_title();
					$content=get_post_field('post_content', $post_ID);//the_content();
					$link=get_post_permalink($post_ID);
					$to=$user->user_email;
					$sub="MCR World -".$title;
					$msg=$content."<br><br><br><a href='".$link."'><strong>Read More</strong></a>"  ;
					
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					$headers .= 'From:info@mcrworld.com' . "\r\n";
					/*echo"<hr><div style='display:block;background:#fff444'>##1.".$to."</div>
					<div style='display:block;background:#999fff'>##2.".$sub."</div>
					<div style='display:block;background:#fff444'>##3.".$msg."</div>
					<div style='display:block;background:#999fff'>##4.".$headers."</div>
					<hr>";*/
					
					mail($to,$sub,$msg,$headers);
				}
			}
		}
	}
//die();	
}
add_action ( 'publish_post', 'cat_chk' );
