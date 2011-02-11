</div><!-- #container -->

<?php wp_reset_query() ?>

<div id="primary" class="aside main-aside sidebar">
<?php arras_above_sidebar() ?>  
	<ul class="xoxo">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Primary Sidebar') ) : ?>
			<li class="widgetcontainer clearfix">
				<h5 class="widgettitle"><?php _e('Welcome to the New SEAHO.org!', 'arras') ?></h5>
				<div class="widgetcontent">
				<div class="textwidget">
					<p><?php _e('The new SEAHO.org is designed to create more community between members, and all members to get to the information quickly.  The new site is dynamic and content will change constantly, so visit often.', 'arras') ?></p>
				</div>
				</div>
			</li>
			<li class="widgetcontainer clearfix">
				<h5 class="widgettitle"><?php _e('Recent Posts', 'arras') ?></h5>
				<div class="widgetcontent">
<?php 
				$r = new WP_Query(array('showposts' => 10, 'what_to_show' => 'posts', 'nopaging' => 0, 'post_status' => 'publish', 'caller_get_posts' => 1));
				if ($r->have_posts()) :
?>
				<ul>
				<?php while ($r->have_posts()) : $r->the_post(); ?>
				<li><a href="<?php the_permalink() ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?> </a></li>
				<?php endwhile ?>			
				</ul>
<?php
				wp_reset_query();
				endif;
?>
				</div>
			</li>
			<li class="widgetcontainer clearfix">
				<h5 class="widgettitle"><?php _e('Tag Cloud', 'arras') ?></h5>
				<div class="tags widgetcontent">
				<?php wp_tag_cloud(); ?>
				</div>
			</li>
		<?php endif; ?>
	</ul>		
</div><!-- #primary -->
<div id="secondary" class="aside main-aside sidebar">
    <ul class="xoxo">
        <!-- Widgetized sidebar, if you have the plugin installed.  -->
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Secondary Sidebar #1') ) : ?>
		<li></li>		
        <?php endif; ?>
		
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Secondary Sidebar #2') ) : ?>
		<li></li>
		<?php endif; ?>
    </ul>
	<?php arras_below_sidebar() ?>  
</div><!-- #secondary -->
