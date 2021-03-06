<?php
/* Template Name: News Template */
get_header('second');
?>

        <!-- section end Here -->
<div class="body_content">
            <div class="container">
                <div class="subpages_cont">
                    <ul class="breadcrumb">
                      <li><a href="<?php echo site_url();?>">Home</a></li>
                      <li><?php the_title();?></li>
                    </ul> 
                    <h1><?php the_title(); ?> Blog</h1> 
                    <?php 
                    $p_type='news';
                    $years=get_posts_years_array($p_type);
                    
                    ?>
                    <div class="gallery_main">
                            <div class="col-sm-3 gallery_left">
                                <div class="gallery_wrapper">
                               <ul class="accordion">
								    <?php 
									$p_type="news";
									$years=get_posts_years_array($p_type);
									$c_years=count($years);									
									for($i=0;$i<$c_years;$i++){	
										
										$args1 = array(
											'post_type' => 'news',
											'post_status'=>'publish',
											'date_query' => array(
													'year' => $years[$i]),
										);
										$posts1 = get_posts($args1);
										$count_posts1=count($posts1);	
									?>
                                    <li class="parentlist">
                                        <a class="toggle years" href="" data-year="<?php echo $years[$i];?>">
                                            <i class="fa fa-circle" aria-hidden="true"></i>
                                            <?php echo $years[$i]."  (".$count_posts1.")";?>
                                        </a>
                                        <div class="gallery_right" style="display: none;">
                                            <div class="news_short_info">
                                               
                                            </div>
                                            
                                        </div>
                                     </li>
                                    <?php }?>                                     
                                </ul>
                            </div>
                                <div class="news_subscribe">
                                    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/news_subscribe_icon.png" alt="">
                                    <p>Get latest news and updates by subscribing to our newsletter!</p>
                                    <form class="subscribe_from">
                                        <div class="form-group">
                                            <label>Your Email</label>
                                            <input class="form-control" type="email">
                                        </div>
                                        <button type="submit" class="subscribe-btn">Subscribe</button>
                                    </form>
                                </div>
                            </div>
                        <div class="col-sm-9 news_page">
                            <div class="right" style="width:100%;float: right;">
                                <div class="content-Insert">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    
    <?php get_footer();?>
	
		
	<!--popup 1 -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			  </div>
			  <div class="modal-body">
				<p>Some text in the modal.</p>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  </div>
		</div>
	  </div>
	</div>
	<!--popup 1 -->

<script type="text/javascript">
	
jQuery(document).ready(function(){		
	jQuery('.parentlist .toggle').click(function(e) {
			if(jQuery(this).parent().hasClass('parentlist')){
						
						if(jQuery(this).siblings().hasClass('gallery_right')){
							jQuery(this).siblings().addClass('album_contain');
							var getTextis=jQuery(this).siblings().html();
							jQuery('.content-Insert').html(getTextis);
						}
						jQuery('.parentlist .toggle').removeClass('active');
						jQuery(this).addClass('active');
						if(jQuery(this).hasClass('active')){
							var nextSlide=jQuery(this).next();
							jQuery(this).toggleClass('ToggleMe');
							if(jQuery(this).hasClass('ToggleMe')){
								jQuery(nextSlide).find('li:first').find('.toggle').trigger('click');
							}
							jQuery(nextSlide).slideToggle();
							checkEle();
						}
			}else{

					var nextSlide=jQuery(this).next().html();
					console.log(nextSlide);
					jQuery('.content-Insert').html(nextSlide);
			}
	});
	var flag=true;
	jQuery('.parentlist .toggle:first').trigger('click');
	function checkEle(){
		 jQuery('.parentlist .toggle').each(function(e){
				   var ele=jQuery(this);  
				   if(!(jQuery(ele).hasClass('active'))){
						jQuery(ele).next().slideUp(500);
				   }
		 });
	}
	
	jQuery(".years").click(function(){	
		var year=jQuery(this).data("year");
		//alert(year);
				jQuery.ajax({
						url: ajaxurl,
						type: 'post',												
						data:'year='+year+"&action=display_news_by_year",
						success: function(result) {
							//alert(result);
							jQuery('.news_short_info').html(result);
						},
						error: function(){
							//alert("Error!  Please try again.");
						}
				});
				return false;
	});
	jQuery("ul.accordion li:first-child a").click();
});
</script>
</body>
</html>

</body>
</html>
