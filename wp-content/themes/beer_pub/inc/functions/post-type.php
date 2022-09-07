<?php
class ThemePostTypes {

    function __construct() {
        // Register post types
        add_action('init', array($this, 'addGalleryPostType'));
        add_filter('manage_gallery_posts_columns', array($this, 'addGallery_columns'));
        add_action('manage_gallery_posts_custom_column', array($this, 'addGallery_columns_content'), 10, 2);
    }

    // Register Gallery post type
    function addGalleryPostType() {
        register_post_type(
            'gallery', array(
                'labels' => $this->getLabels(esc_html__('Gallery', 'makeupartist'), esc_html__('Galleries', 'makeupartist')),
                'exclude_from_search' => false,
                'has_archive' => false,
                // 'publicly_queryable'  => false,
                'menu_icon' => 'dashicons-format-gallery',
                'public' => true,
                'rewrite' => array('slug' => 'gallery','with_front' => false),
                'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes'),
                'can_export' => true
            )
        );
    }
    function get_the_image( $post_id = false ) {

        $post_id    = (int) $post_id;
        $cache_key  = "featured_image_post_id-{$post_id}-_thumbnail";
        $cache      = wp_cache_get( $cache_key, null );

        if ( !is_array( $cache ) )
            $cache = array();

        if ( !array_key_exists( $cache_key, $cache ) ) {
            if ( empty( $cache) || !is_string( $cache ) ) {
                $output = '';

                if ( has_post_thumbnail( $post_id ) ) {
                    $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), array( 36, 32 ) );

                    if ( is_array( $image_array ) && is_string( $image_array[0] ) )
                        $output = $image_array[0];
                }

                if ( empty( $output ) ) {
                    // $output = plugins_url( 'images/default.png', __FILE__ );
                    // $output = apply_filters( 'featured_image_column_default_image', $output );
                }

                $output = esc_url( $output );
                $cache[$cache_key] = $output;

                wp_cache_set( $cache_key, $cache, null, 60 * 60 * 24 /* 24 hours */ );
            }
        }
        return isset( $cache[$cache_key] ) ? $cache[$cache_key] : $output;
    }
    function addGallery_columns($defaults) {

        if ( !is_array( $defaults ) )
            $defaults = array();
        $new = array();
        foreach( $defaults as $key => $title ) {
            if ( $key == 'title' )
                $new['featured_image'] = 'Image';

            $new[$key] = $title;
        }

        return $new;
    }
    // SHOW THE FEATURED IMAGE
    function addGallery_columns_content($column_name, $post_id) {
        if ( 'featured_image' != $column_name )
            return;

        $image_src = self::get_the_image( $post_id );

        if ( empty( $image_src ) ) {
            echo "&nbsp;"; // This helps prevent issues with empty cells
            return;
        }

        echo '<img alt="' . esc_attr( get_the_title() ) . '" src="' . esc_url( $image_src ) . '" />';
    }
    // Get content type labels
    function getLabels($singular_name, $name, $title = FALSE) {
        if (!$title)
            $title = $name;

        return array(
            "name" => $title,
            "singular_name" => $singular_name,
            "add_new" => esc_html__("Add New", 'makeupartist'),
            "add_new_item" => sprintf(esc_html__("Add New %s", 'makeupartist'), $singular_name),
            "edit_item" => sprintf(esc_html__("Edit %s", 'makeupartist'), $singular_name),
            "new_item" => sprintf(esc_html__("New %s", 'makeupartist'), $singular_name),
            "view_item" => sprintf(esc_html__("View %s", 'makeupartist'), $singular_name),
            "search_items" => sprintf(esc_html__("Search %s", 'makeupartist'), $name),
            "not_found" => sprintf(esc_html__("No %s found", 'makeupartist'), $name),
            "not_found_in_trash" => sprintf(esc_html__("No %s found in Trash", 'makeupartist'), $name),
            "parent_item_colon" => ""
        );
    }
}
new ThemePostTypes();