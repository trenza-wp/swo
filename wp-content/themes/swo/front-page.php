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
            </div><!-- .entry-content -->
        
        </article><!-- #post-## -->
            

        <?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->
<?php  
            $blogusers = get_users( 'orderby=id&role=vendor' );
                // Array of WP_User objects.
                foreach ( $blogusers as $user ) {
                    //echo '<span>' . esc_html( $user->user_email ) . '</span>';
                
        ?>
        <article>
        	<div class="product-view hidden">
        		<div class="view-product wrapper">
        			<div class="view-product-left left">
        				<img src="<?php echo get_stylesheet_directory_uri() ?>/images/product-name.PNG">
        			     <h3 class="green center"><?php echo $user->user_firstname; ?></h3>
                    </div>
        			<div class="view-product-right left">
        			<!-- <h3 class="red">Your published product listings</h3> -->
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
	        						<td><h3>ORDER</h3></td>
	        					</tr>
	        				</thead>
	        				<tbody>
	        					
        						<?php 
						        $args = array(
                                    'author' =>  $user->id,
						        	'posts_per_page' => 15,
						            'post_type' => 'product'
						        );
						        $the_query = new WP_Query($args ); if($the_query): ?>
						        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							    <tr>


	        						<td><h3 id="type-<?php echo $post->ID; ?>"><?php echo get_post_meta($post->ID,'Product_Type',true); ?></h3></td>
	        						<td><h3 id="name-<?php echo $post->ID; ?>"><?php echo get_post_meta($post->ID,'Strait_Name',true); ?></h3></td>
	        						<td><h3><?php echo get_post_meta($post->ID,'THC_CBD',true); ?> %</h3></td>
	        						<td><h3><?php echo get_post_meta($post->ID,'I_O_GH',true); ?></h3></td>
	        						<td><h3><?php echo get_post_meta($post->ID,'I_S_H',true); ?></h3></td>
	        						<td><h3><img src="<?php bloginfo('template_url'); ?>/images/download.PNG" /></h3></td>
	        						<td><h3><?php if (has_post_thumbnail( $post->ID ) ): ?>
									  <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
										<img src="<?php echo $url ?>" width="60" height="60"/>
									<?php endif; ?></h3></td>
	        						<td>
	        							<input type="hidden" id="price-<?php echo $post->ID; ?>" value="<?php echo get_post_meta($post->ID,'_price',true); ?>">
	        						<h3><?php echo get_woocommerce_currency_symbol().get_post_meta($post->ID,'_price',true); ?></h3>
	        						</td>
	        						<td><h3><?php echo $product->get_stock_quantity(); ?></h3></td>
	        						<td>
	        							<select id="order-qty-select-<?php echo $post->ID; ?>" max="<?php echo get_post_meta($post->ID,'Amount_Of_Units',true); ?>" min="1" onchange="cart_update(<?php echo $post->ID; ?>)">
	        							<option value"">0</option>
	        							<?php  
	        								for ($i = 1; $i <= $product->get_stock_quantity() ; $i++ ) {
	        							?>
	        								<option value"1"><?php echo $i; ?></option>
	        							<?php } ?>
	        							</select>
	        							<input type="number" max="" min="1" class="order-qty" id="order-qty-<?php echo $post->ID; ?>" value="1" style="display:none"/>
	        							
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
        <?php } //echo the_title(); ?>
        <article>
        	<div class="product">
        		<div class="add-product wrapper">
        <div class="error">
        	<p class="error-cart" style="display:none">* Please add some product</p>
        	<p class="error-field" style="display:none">* Please fillup all field</p>
        </div>
        <form action="" method="post" enctype="multitype-data" name="cart-form">
        			<table>
        				
        				<tr>
        					<td>
        					</td>
        					<td>
        						<p>ORDER SUMMARY</p>
        						<div type="" class="" id="cart_display" name="o-summery" readonly></div>
        					</td>
        					<td>
        					</td>
        				</tr>
        				<tr>
        					<td>
        						<p>NAME</p>
        						<input type="" class="" id="order_name" name="order_name" required/>
        					</td>
        					<td>
        						<p>OLCC #</p>
        						<input type="" class="" id="order_olcc" name="order_olcc" required/>
        					</td>
        					<td>
        						<p>CONFIRMATION CALL PHONE #</p>
        						<input type="" class="" name="order_phone" id="order_phone" required/>
        					</td>
        				</tr>
        				
        				<tr>
        					<td></td>
        					<td>
								<input type="hidden" id="checkout" name="checkout" value='' />
								<input type="hidden" name="action" value='checkout_submit' />
								<input type="hidden" name="post_id" value="'.$id.'" />
        						<button class="btn-red" id="place" type="submit">PLACE</button>
        					</td>
        					<td></td>
        				</tr>
        			</table>
        		</form>
        		</div>
        	</div>
        </article>
	        
        <script type="text/javascript">
        	function qty_update(id)
			  {
			  var select_qty = document.getElementById("order-qty-select-"+id).value;
			  var order_qty = document.getElementById("order-qty-"+id);
			  if (select_qty <= 5){
			  	alert('5 less'+order_qty);
			  	order_qty.value = select_qty;
			  }else{
			  	alert('5 up');
			  	document.getElementById("order-qty-select-"+id).style.display = 'none';
			  	document.getElementById("order-qty-"+id).style.display = 'inline';
			  	order_qty.value = select_qty;
			  }
			}


			var select_qty = {};
			var des_qty = {};

			function cart_update(id)
			  {
			  /*var select_qty = document.getElementById("order-qty-select-"+id).value;
			  var cart_display_old = document.getElementById("cart_display").val;
			  var cart_display = document.getElementById("cart_display");
			  	if(cart_display_old==''){
			  		cart_display.value=select_qty;
			  	}else{
			  		cart_display.value = cart_display+select_qty;
			  	}*/
			  description = document.getElementById("name-"+id).innerHTML;
			  price = jQuery("#price-"+id).val();
			  //alert(description.innerHTML);
			  qty = jQuery("#order-qty-select-"+id).val();
			  newdata='';
			  totalprice = 0;
/*			  des_qty['name'] = qty;
			  des_qty['qty'] = qty;*/
			  check = '';
			  select_qty[id] = [qty, description,price];

  			 //jQuery('#cart_display').val( jQuery('#cart_display').val() +' '+ select_qty);
  			 console.log(select_qty); 
  			 //alert(select_qty.length); 
  			 //alert(select_qty["id"]); 
  			 Object.keys(select_qty).forEach(function(key) {
			    if(select_qty[key][0] != 0){
			    newdata =newdata + select_qty[key][1]+' - qty:'+ select_qty[key][0] +' - price:'+ select_qty[key][2] +'<br>';
			    totalprice+= select_qty[key][0]*select_qty[key][2];
			    /*check += ' \''+select_qty[key][1]+'\''+'=>'+'\''+select_qty[key][0]+'\''+',';*/
			    check += key+'=>'+select_qty[key][0]+',';
				}
			});
  			 /*alert(check.slice(0, -1));*/
  			 jQuery('#checkout').val(check.slice(0, -1));
  			 newdata = newdata+'<div class="total-price">Total Purchase Amount:<?php echo get_woocommerce_currency_symbol()?>'+ totalprice+'</div>';
  			 jQuery('#cart_display').html(newdata);
			}


			jQuery(document).ready(function() {
		    jQuery('form[name=cart-form]').submit(function(){
		    		var order_name=document.forms["cart-form"]["order_name"].value.replace(/^\s+|\s+$/g, '');
		    		var order_olcc=document.forms["cart-form"]["order_olcc"].value.replace(/^\s+|\s+$/g, '');
		    		var order_phone=document.forms["cart-form"]["order_phone"].value.replace(/^\s+|\s+$/g, '');
		    		var checkout=document.forms["cart-form"]["checkout"].value.replace(/^\s+|\s+$/g, '');
		    		var cart_error = '';
		    		if(order_name==''){
		    			jQuery("#order_name").addClass("input-error");
		    		}else{
		    			jQuery("#order_name").removeClass("input-error");
		    		}
		    		if(order_olcc==''){
		    			jQuery("#order_olcc").addClass("input-error");
		    		}else{
		    			jQuery("#order_olcc").removeClass("input-error");
		    		}
		    		if(order_phone==''){
		    			jQuery("#order_phone").addClass("input-error");
		    		}else{
		    			jQuery("#order_phone").removeClass("input-error");
		    		}
		    		if(checkout==''){
		    			jQuery("#cart_display").addClass("input-error");
		    			cart_error = 1;
		    		}else{
		    			jQuery("#cart_display").removeClass("input-error");
		    			cart_error = 0;
		    		}
		    		if(cart_error == 1){
		    			jQuery('.error-cart').show();
		    			return false;
		    		}else{
		    			jQuery('.error-cart').hide();
		    		}
		    		if(order_name=='' || order_olcc=='' || order_phone==''){
		        		/*alert("Please Fillup all field !!");*/
		        		jQuery('.error-field').show();
		        		return false;
		        	}
		    	});
			});

			jQuery(function() {
			    jQuery('#order_phone').on('keypress', function(e) {
			        if (e.which == 32)
			            return false;
			    });
			});	
        </script>
</div><!-- .content-area -->
<?php

$str = stripslashes($_POST['checkout']);
$mstr = explode(",",$str);
$a = array();
foreach($mstr as $nstr )
{
    $narr = explode("=>",$nstr);
$narr[0] = str_replace("\x98","",$narr[0]);
$ytr[1] = $narr[1];
$a[$narr[0]] = $ytr[1];
}
?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
