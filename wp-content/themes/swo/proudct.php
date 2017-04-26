<?php /* Template Name: Product */ ?>
<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
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
                <?php the_content(); ?>
                <button class="btn-red">Add Product</button>
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
			     }
      
        		?>
        		<form action="" method="post" enctype="multitype-data">
        			<table>
        				
        				<tr>
        					<td>
        						<p>PRODUCT TYPE</p>
        						<input type="" class="" name="p-type" value="<?php echo $p_type ?>" />
        					</td>
        					<td>
        						<p>STRAIN NAME</p>
        						<input type="" class="" name="s-name" value="<?php echo $edit_post_title ?>" />
        					</td>
        					<td>
        						<p>THC/CBD % (eg:</p>
        						<input type="" class="" name="thc-csb" value="<?php echo "$THC_CBD"; ?>" />
        					</td>
        				</tr>
        				<tr>
        					<td>
        						<p>INDOOR/OUTDOOR/GREENHOU</p>
        						<input type="" class="" name="indoor-outdoor" value="<?php echo "$I_O_GH"; ?>"/>
        					</td>
        					<td>
        						<p>INDICA/SATIVA/HYBRI</p>
        						<input type="" class="" name="indica-sativa" value="<?php echo "$I_S_H"; ?>"/>
        					</td>
        					<td>
        						<p>UPLOAD TEST</p>
        						<?php if($edit == 1 && $Test!=''){
        							echo '<img id="upload-test-img-link" src="'.$Test.'" />	';
        						} ?>
        						
        						<input id="upload-test-id" type="hidden" name="upload-test-id" value="<?php echo $Test_id; ?>" />
        						<input id="upload-test-url" type="hidden" name="upload-test-url" />
			  					<input id="upload-test" type="file" class="button" name="upload-test" value="Upload Image" />
        					</td>
        				</tr>
        				<tr>
        					<td>
        						<p>UPLOAD IMAGE</p>		
        						<?php if($edit == 1 && $Test!=''){
        							echo '<img id="upload-image-img-link" src="'.$thumbnail.'" />	';
        						} ?>	
								<input id="upload-image-id" type="hidden" name="upload-image-id" value="<?php echo $image_id; ?>" />
								<input id="upload-image-url" type="hidden" name="upload-image-url" />
			  					<input id="upload-image" type="file" class="button" name="upload-image" value="Upload Image" />
        					</td>
        					<td>
        						<p>PRICE (PER UNIT) OF</p>
        						<input type="" class="" name="price-per-unit" value="<?php echo "$_price"; ?>"/>
        					</td>
        					<td>
        						<p>AMOUNT OF UNITS</p>
        						<input type="" class="" name="ammount-of-units" value="<?php echo "$Amount_Of_Units"; ?>"/>
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

        <article>
        	<div class="product-view hidden">
        		<div class="view-product wrapper">
        			<div class="view-product-left left">
        				<img src="<?php echo get_stylesheet_directory_uri() ?>/images/product-name.PNG">
        			</div>
        			<div class="view-product-right left">
        			<h3 class="red">Your published product listings</h3>
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
	        						<td><h3><img src="<?php echo wp_get_attachment_url( get_post_meta($post->ID,'Test',true) ); ?>" width="60" height="60"/></h3></td>
	        						<td><h3><?php if (has_post_thumbnail( $post->ID ) ): ?>
									  <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
										<img src="<?php echo $url ?>" width="60" height="60"/>
									<?php endif; ?></h3></td>
	        						<td><h3><?php echo get_post_meta($post->ID,'_price',true); ?> (per pound)</h3></td>
	        						<td><h3><?php echo get_post_meta($post->ID,'Amount_Of_Units',true); ?>’S AVAILABLE</h3></td>
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

        <?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

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
jQuery(document).ready(function($){
	uploader_file('#upload-image','#upload-image-url','#upload-image-id','#upload-image-img');
	uploader_file('#upload-test','#upload-test-url','#upload-test-id','#upload-test-img');
  function uploader_file(file_id,url,id,img=''){
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
    });
    // Open the uploader dialog
    mediaUploader.open();
  });
}




var form = document.getElementById("delete-form");
document.getElementById("delete").addEventListener("click", function () {
  form.submit();
});



});
</script>
<?php get_footer(); ?>
