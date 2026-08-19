<?php get_header(); ?><main class="content-main"><article class="content-shell page-content"><?php while(have_posts()): the_post(); ?><p class="section-label"><?php echo esc_html(get_the_date()); ?></p><h1><?php the_title(); ?></h1><?php if(has_post_thumbnail()) the_post_thumbnail('large'); the_content(); endwhile; ?></article></main><?php get_footer(); ?>

