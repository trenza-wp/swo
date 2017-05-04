<?php /* Template Name: Product */ ?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
		
         $user = wp_get_current_user();

        // Start user roles check

    //The user has the "author" role
// Start the loop.
		while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header> --><!-- .entry-header -->
        	

            <div class="entry-content wrapper">
	            <?php if (has_post_thumbnail( $post->ID ) ): ?>
				  <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
					<img src="<?php echo $url ?>" />
				<?php endif; ?>
                <?php 
                $user_roles = $current_user->roles;
                $user_role = array_shift($user_roles);
                if ( in_array( 'vendor', (array) $user->roles ) ) : ?>
                <?php the_content(); ?>
                <a class="btn-red" href="<?php echo get_home_url(); ?>/product">Add Product</a>
            </div><!-- .entry-content -->
        	
        </article><!-- #post-## -->
            
        <article>
        	<div class="product">
        		<div class="add-product wrapper">
        		<?php
        		if( !empty( $_GET['action'] ) &&  $_GET['action'] == "edit") {
			     	$id =$_GET['post_id'];
					$content_post = get_post($id );
					$edit_post_title = $content_post->post_title;
					$p_type = get_post_meta($id,'Product_Type',true);
					$THC_CBD = get_post_meta($id,'THC_CBD',true);
					$I_O_GH = get_post_meta($id,'I_O_GH',true);
					$I_S_H = get_post_meta($id,'I_S_H',true);
					$_price = get_post_meta($id,'_price',true);
					$Amount_Of_Units = get_post_meta($id,'Amount_Of_Units',true);
					$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($id), 'thumbnail' );
					$image_id = get_post_thumbnail_id($id);
					$Test_id = get_post_meta($id,'Test',true);
					$Test = wp_get_attachment_url( get_post_meta($id,'Test',true) );
					$edit = 1;
			     }else{
                    $p_type = $_POST["p-type"];
                    $edit_post_title = $_POST["s-name"];
                    $THC_CBD = $_POST["thc-csb"];
                    $I_O_GH = $_POST["indoor-outdoor"];
                    $I_S_H = $_POST["indica-sativa"];
                    $_price = $_POST["price-per-unit"];
                    $Amount_Of_Units = $_POST["ammount-of-units"];
                    if(isset($_POST["upload-test-url"]) && $_POST["upload-test-url"]!='' ){
                        $test_url_val = 1;
                        $Test_id = $_POST["upload-image-id"];
                        $test_url = $_POST["upload-test-url"];
                    }else{
                        $test_url_val = 0;
                    }
                    if(isset($_POST["upload-image-url"]) && $_POST["upload-image-url"]!='' ){
                        $image_url_val = 1;
                        $image_id = $_POST["upload-image-id"];
                        $image_url = $_POST["upload-image-url"];
                    }else{
                        $image_url_val = 0;
                    }
                   
                 }

        		?>
                
                    <?php
                    if ($_SESSION["error"] == 1) {
                        echo '<div class="error-msg">* Please Fillup all field</div>';
                        session_unset($_SESSION["error"]);
                    }
                    if(isset($_GET['msg']) && $_GET['msg'] =='update'){
                        echo '<div class="suc-msg">* Successfully Updated!</div>';
                    }
                    if(isset($_GET['msg']) && $_GET['msg'] =='added'){
                        echo '<div class="suc-msg">* Successfully Added!</div>';
                    }

                    
                        
                    ?>
                    
                
        		<form action="" method="post" enctype="multitype-data" onsubmit="return confirm('Do you really want to submit the form?');">
        			<table>
        				
        				<tr>
        					<td>
        						<p>PRODUCT TYPE</p>
        						<input type="" class="" name="p-type" value="<?php echo $p_type ?>" required/>
        					</td>
        					<td>
        						<p>STRAIN NAME</p>
        						<input type="" class="" name="s-name" value="<?php echo $edit_post_title ?>" required/>
        					</td>
        					<td>
        						<p>THC/CBD % (eg:</p>
        						<input type="number" class="" name="thc-csb" value="<?php echo "$THC_CBD"; ?>" required/>
        					</td>
        				</tr>
        				<tr>
        					<td>
        						<p>INDOOR/OUTDOOR/GREENHOU</p>
        						<input type="" class="" name="indoor-outdoor" value="<?php echo "$I_O_GH"; ?>" required/>
        					</td>
        					<td>
        						<p>INDICA/SATIVA/HYBRI</p>
        						<input type="" class="" name="indica-sativa" value="<?php echo "$I_S_H"; ?>" required/>
        					</td>
        					<td>
        						<p>UPLOAD TEST</p>
        						
        						
        						<input id="upload-test-id" type="hidden" name="upload-test-id" value="<?php echo $Test_id; ?>" />
        						<input id="upload-test-url" type="hidden" name="upload-test-url" />
			  					<a href="#"><div id="upload-test" type="" class="button file-upload" name="upload-test" value="Brows">Brows</div></a>
                                <div id="test-upload-text"></div>
                                <div id="edit-upload-text">
                                    <?php if($edit == 1 && $Test!=''){
                                        echo '<img id="upload-test-img-link" src="'.$Test.'" />
                                        <a href="#" type="text" class="delete-img " onclick="clear_img(2)">delete</a>
                                        ';
                                    } ?>
                                </div>
                                <div id="error-upload-text">
                                    <?php if($test_url_val == 1){
                                    echo '<img id="upload-test-img-link" src="'.$test_url.'" />
                                    <a href="#" type="text" class="delete-img " onclick="clear_img(2)">delete</a>
                                    ';
                                    } ?>
                                </div>
        					    
                            </td>
        				</tr>
        				<tr>
        					<td>
        						<p>UPLOAD IMAGE</p>		
        							
								<input id="upload-image-id" type="hidden" name="upload-image-id" value="<?php echo $image_id; ?>" />
								<input id="upload-image-url" type="hidden" name="upload-image-url" />
			  					<div id="upload-image" type="" class="button file-upload" name="upload-image" value="" >Brows</div>
        					    <div id="upload-img-text"></div>
                                <div id="edit-img-upload-text">
                                    
                                    <?php if($edit == 1 && $thumbnail!=''){
                                    echo '<img id="upload-image-img-link" src="'.$thumbnail.'" />   
                                    <a href="#" type="text" class="delete-img " onclick="clear_img(1)">delete</a>';
                                } ?>
                                </div>
                                <div id="error-img-upload-text">
                                    <?php if($image_url_val == 1){
                                    echo '<img id="upload-test-img-link" src="'.$image_url.'" />
                                    <a href="#" type="text" class="delete-img " onclick="clear_img(1)">delete</a>
                                    ';
                                    } ?>
                                </div>
                            </td>
        					<td>
        						<p>PRICE (PER UNIT) OF</p>
        						<input type="number" class="" name="price-per-unit" value="<?php echo "$_price"; ?>"/>
        					</td>
        					<td>
        						<p>AMOUNT OF UNITS</p>
        						<input type="number" class="" name="ammount-of-units" value="<?php echo "$Amount_Of_Units"; ?>"/>
        					</td>
        				</tr>
        				<tr>
        					<td></td>
        					<td></td>
        					<td>
        						<?php  
        							if ($edit!=1) {
        								echo '<input type="hidden" name="action" value="new_post" />';
        							}else{
        								echo '<input type="hidden" name="post_id" value="'.$id.'" />';
        								echo '<input type="hidden" name="action" value="update_post" />';
        							}
        						?>
        						
        						<button class="btn-red" type="submit"> submit </button>
        					</td>
        				</tr>
        			</table>
        		</form>
        		</div>
        	</div>
        </article>
        <?php  
            $user_id = get_current_user_id();
       
        ?>
        <article>
        	<div class="product-view hidden">
        		<div class="view-product wrapper">
        			<div class="view-product-left left">
        				<img src="<?php echo get_stylesheet_directory_uri() ?>/images/product-name.PNG">
        			     <h3 class="green center"><?php echo $user->user_firstname; ?></h3>
                    </div>
        			<div class="view-product-right left">
        			<h3 class="red">Your published product listings</h3>
                    <?php 
                        if(isset($_GET['msg']) && $_GET['msg'] =='deleted'){
                        echo '<div class="suc-msg">* Successfully Deleted!</div>';
                        }
                     ?>
        				<table class="" border="2" bordercolor="#9BBDB3" bordercolorlight="#9BBDB3" bordercolordark="#9BBDB3" bgcolor="#9BBDB3">
	        				<thead>
	        					<tr>
	        						<td><h3>PRODUCT</h3></td>
	        						<td><h3>STRAIN</h3></td>
	        						<td><h3>THC/CBD %</h3></td>
	        						<td><h3>I/O/GH</h3></td>
	        						<td><h3>I/S/H</h3></td>
	        						<td><h3>TEST</h3></td>
	        						<td><h3>PICTURE</h3></td>
	        						<td><h3>PRICE (per pound)</h3></td>
	        						<td><h3>#’S AVAILABLE</h3></td>
	        						<td><h3>EDIT</h3></td>
	        					</tr>
	        				</thead>
	        				<tbody>
	        					
        						<?php 
						        $args = array(
                                    'author' =>  $user_id,
						        	'posts_per_page' => 15,
						            'post_type' => 'product'
						        );
						        $the_query = new WP_Query($args ); if($the_query): ?>
						        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							    <tr>


	        						<td><h3><?php echo get_post_meta($post->ID,'Product_Type',true); ?></h3></td>
	        						<td><h3><?php echo get_post_meta($post->ID,'Strait_Name',true); ?></h3></td>
	        						<td><h3><?php echo get_post_meta($post->ID,'THC_CBD',true); ?> %</h3></td>
	        						<td><h3><?php echo get_post_meta($post->ID,'I_O_GH',true); ?></h3></td>
	        						<td><h3><?php echo get_post_meta($post->ID,'I_S_H',true); ?></h3></td>
	        						<td><h3><a href="<?php echo wp_get_attachment_url( get_post_meta($id,'Test',true) ); ?>"><img src="<?php bloginfo('template_url'); ?>/images/download.PNG" /></a></h3></td>
	        						<td><h3><?php if (has_post_thumbnail( $post->ID ) ): ?>
									  <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
										<img src="<?php echo $url ?>" width="60" height="60"/>
									<?php endif; ?></h3></td>
	        						<td><h3><?php echo get_woocommerce_currency_symbol().get_post_meta($post->ID,'_price',true); ?></h3></td>
                                    <td><h3><?php echo get_post_meta($post->ID,'Amount_Of_Units',true); ?></h3></td>
                                    <td>
	        							<form action="" method="GET" id="edit">
		        							<input type="hidden" name="action" value="edit" />
		        							<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>" />
		        							<input type="submit" class="button_to_text green pointer underline" value="EDIT" />
		        						</form>
		        						<form action="" method="post" id="delete-form">
		        							<input type="hidden" name="action" value="delete" />
		        							<input type="hidden" name="post_id" value="<?php echo $post->ID; ?>" />
		        							<input type="submit" class="button_to_text green pointer underline" value="DELETE" />
		        							</a>
		        						</form>
	        							
	        						</td>
	        					</tr>

	        					<?php endwhile; endif;
					            	wp_reset_postdata();  
					            ?> 
                               
	        				</tbody>
        				</table>
        			</div>
        		</div>
        	</div>
        </article>
        <?php //} //echo the_title(); ?>
        <?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
// End user roles check
        endif;
			// End of the loop.
		endwhile;
            
		?>
        
	</main><!-- .site-main -->
	<?php get_sidebar( ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>


<form method="post">
			  
			</form>
<script type="text/javascript">
function clear_img(del){
        if(del == 1) {
             document.getElementById("upload-image-id").value = '';
            document.getElementById( 'upload-img-text' ).innerHTML = '';
            document.getElementById( 'error-img-upload-text' ).style.display = 'none';
            document.getElementById( 'edit-img-upload-text' ).style.display = 'none';
            alert('Successfully Remove !!');
        }

        if(del == 2) {
             document.getElementById("upload-test-id").value = '';
            document.getElementById( 'test-upload-text' ).innerHTML = '';
            document.getElementById( 'error-upload-text' ).style.display = 'none';
            document.getElementById( 'edit-upload-text' ).style.display = 'none';
            alert('Successfully Remove !!');
        }
    }
jQuery(document).ready(function($){
    

	uploader_file('#upload-image','#upload-image-url','#upload-image-id','#upload-img-text',1,'#error-img-upload-text','#edit-img-upload-text');
	uploader_file('#upload-test','#upload-test-url','#upload-test-id','#test-upload-text',2,'#error-upload-text','#edit-upload-text');
  function uploader_file(file_id,url,id,img='',del,error,edit){
	var mediaUploader;
  	$(file_id).click(function(e) {
    e.preventDefault();
    // If the uploader object has already been created, reopen the dialog
      if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    // Extend the wp.media object
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    }, multiple: false });

    // When a file is selected, grab the URL and set it as the text field's value
    mediaUploader.on('select', function() {
      var attachment = mediaUploader.state().get('selection').first().toJSON();
      $(url).val(attachment.url);
      $(id).val(attachment.id);
      //$(img_link).attr('src',attachment.url);
      $(img).html('<img id="upload-test-img-link" src="'+attachment.url+'" /> <a type="text" href="#" class="delete-img " onclick="clear_img('+del+')">delete</a>');
       $(error).hide();
      $(edit).hide();
    });
    // Open the uploader dialog
    mediaUploader.open();
  });
}




var form = document.getElementById("delete-form");
document.getElementById("delete").addEventListener("click", function () {
  form.submit();
});


jQuery('#button').click(function () {
    jQuery("input[type='file']").trigger('click');
})



});
</script>
<?php get_footer(); ?>
