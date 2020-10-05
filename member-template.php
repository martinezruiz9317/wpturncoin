<?php

/**
 * Template Name: Members
 *
 * @package WordPress
 * @subpackage cto
 * @since cto 1.0
 */
get_header();
?>
<!-- HEADER -->
<?php
$custom_terms = get_terms(array(
    'taxonomy' => 'member_cat',
    'orderby'  => 'slug',
    'order'    => 'ASC',
));

foreach ($custom_terms as $custom_term) {
    // print_r($custom_term);
    echo '<div id="members-' . $custom_term->term_id . '" class="meber-cat-wrap">';
    wp_reset_query();
    $args = array(
        'post_type' => 'members',
        'tax_query' => array(
            array(
                'taxonomy' => 'member_cat',
                'field' => 'slug',
                'orderby' => 'title',
                'terms' => $custom_term->slug,
            ),
        ),
        'orderby'  => 'date',
        'order'    => 'ASC',
        'posts_per_page' => -1
    );
    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        if($custom_term->term_id == 9){
            echo '<h3 class="meme-cat-subheading blingbling">XTREME TEAM</h3><br><h3 class="meme-cat-subheading">Cape Town, South Africa Dev. Team</h3>';
        }
        else{
        ?>
        <div class="d-flex align-items-center justify-content-center">
        <div class="line-divider flex-fill"></div>
        <div class="pg-title">
        <?php echo '<h2 class="mem-cat-name">' . $custom_term->name . '</h2></div>'; ?>
        <div class="line-divider flex-fill"></div>
        </div>

        <?php 
        if($custom_term->term_id == 12){
            echo '<h3 class="meme-cat-subheading blingbling">NO REST LABS</h3><br><h3 class="meme-cat-subheading">Silicone Valley & Asia Dev. Teams</h3>';
        }
        }	
        ?>        
        
        <?php 
            // if($custom_term->term_id == 8){
            //     echo '<h3 class="meme-cat-subheading">NO REST LABS/MOUSEBELT<br>
            //     Silicone Valley & Asia Dev. Teams</h3>';
            // }
            // if($custom_term->term_id == 7){
            //     // echo '<h3 class="meme-cat-subheading">Cape Town, South Africa</h3>';
            // }
        ?>
        
        <div class="my-row">


            <?php
            while ($loop->have_posts()) {
                $loop->the_post();
            ?>
                <div class="my-col-20 member-col-out">
                    <?php
                    echo '<div class="member-col-in"><a class="m-open-popup" onClick="openMemberModal(' . get_the_id() . ')">';
                    if (has_post_thumbnail()) {
                        echo get_the_post_thumbnail();
                    }
                    echo '<h2 class="member-name">' . get_the_title() . '</h2>';
                    echo '<h3 class="member-title">' . get_post_meta(get_the_id(), 'memtitle', true) . '</h3>';
                    echo '</a></div>';
                    ?>
                </div>
        <?php
            }
        }
        wp_reset_query();
        ?>
        </div>
    </div>
    <?php
    $ajax_nonce = wp_create_nonce("member-bootstrap");
}
    ?>
    <div id="member-modal" class="member-container">
        <div class="my-row mem-box">
            <div class="my-col-4">
                <div id="memberImgPop">

                </div>
            </div>
            <div class="my-col-8">
                <div class="pop-cnt-wrap">
                    <h4>
                        <div id="memberTitle">
                    </h4>
                    <div id="mempos">

                    </div>
                    <div id="memeberDescription">

                    </div>
                </div>
                
            </div>
            <a href="" class="close-popup-member"><i class="fas fa-times"></i></a>
        </div>
    </div>
    
    <script>
        function openMemberModal(id) {
            jQuery.ajax({
                url: "<?php echo admin_url('admin-ajax.php'); ?>",
                data: {
                    id: id,
                    action: 'member_show_post',
                    security: '<?php echo $ajax_nonce; ?>'
                },

                success: function(response) {
                    if (jQuery("#member-modal").hasClass('pop-is-open')) {
                        jQuery("#member-modal").removeClass('pop-is-open');
                        // jQuery("#member-modal").animate({
                        //     width: '0',
                        // }, 0, function() {

                        // });
                    }
                    if (response['error'] == '1') {
                        jQuery('#memberTitle').html("Error");
                        jQuery('#memeberDescription').html("No post found! Sorry :(");
                    } else {
                        jQuery('#memberTitle').html(response['post_title']);
                        // console.log(response['post_title']);
                        jQuery('#memeberDescription').html(response['post_content']);
                        // console.log(response['post_content']);
                        jQuery('#memberImgPop').html(response['post_thumbnail']).removeClass().addClass(response['cat_id']);
                        jQuery('#mempos').html(response['memtitle']);
                    }
                    if(!jQuery("body").hasClass('noscroll')){
                        jQuery("html").addClass('noscroll');
                        jQuery("body").addClass('noscroll');
                    }
                    jQuery("#member-modal").addClass('pop-is-open');
                    // jQuery("#member-modal").animate({
                    //     width: '80%',
                    // }, 300, function() {

                    // });

                }
            });
        }
    </script>
    <?php
    get_footer();
