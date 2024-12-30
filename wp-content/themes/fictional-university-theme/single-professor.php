<?php
get_header();
// Loop through all blog posts
while (have_posts()) {
    // Tells wordpress to get all the infos of the post
    the_post();

    // Get related programs content. The ACF plugin gives us access to the function get_field
    $relatedPrograms = get_field('related_programs');
    ?>
        <div class="page-banner">
            <div class="page-banner__bg-image" style="background-image: url(<?php echo get_field('page_banner_background_image')["sizes"]["pageBanner"] ?>);"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title"><?php the_title(); ?></h1>
                <div class="page-banner__intro">
                    <p><?php the_field("page_banner_subtitle"); ?></p>
                </div>
            </div>
        </div>

        <div class="container container--narrow page-section">
            <?php 
                // print_r($relatedPrograms);

                // Show breadcrumb only if in a child page
                ?>
                    <div class="metabox metabox--position-up metabox--with-home-link">
                        <p>
                            <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Event Home</a> 
                            <span class="metabox__main"><?php the_title(); ?></span>
                        </p>
                    </div>
                <?php
            ?>

            <div class="generic-content">
                <div class="row group">
                    <div class="one-third">
                        <img class="professor-card__image" src="<?php the_post_thumbnail_url("professorPortrait"); ?>">
                    </div>
                    <div class="two-thirds">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>

            <?php 
                if($relatedPrograms && count($relatedPrograms) > 0){
                    ?>
                        <hr class="section-break">

                        <h3 class="headline headline--medium">I teach..</h3>
                    
                        <ul>
                            <?php
                                // Show all programs, which are regular post objects
                                foreach($relatedPrograms as $program){
                                    ?>
                                        <li>
                                            <a href="<?php echo get_the_permalink($program) ?>"><?php echo get_the_title($program) ?></a>
                                        </li>
                                    <?php
                                }
                            ?>
                        </ul>
                    
                    <?php
                }
            ?>
            

        </div>
    <?php
}
get_footer();