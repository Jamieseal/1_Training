    <?php get_template_part('layout');?>
    <?php get_header();?>

        <div class="container">
            
            <section class="quote-container">

                <!-- Quote -->
                <div class="quote">

                    <?php get_random_automotive_quote() ?>

                </div>

            </section>
        
        <!-- End Main Container div -->
        </div>

    <?php get_footer();?>