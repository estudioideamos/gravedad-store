<?php get_header(); ?><main class="content-main"><article class="content-shell page-content"><?php while(have_posts()): the_post(); ?><h1><?php the_title(); ?></h1><?php the_content(); ?><?php endwhile; ?></article></main><?php get_footer(); ?>

