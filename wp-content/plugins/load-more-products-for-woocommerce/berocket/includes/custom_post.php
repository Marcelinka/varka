<?php
if( ! class_exists('BeRocket_custom_post_class') ) {
    class BeRocket_custom_post_class {
        public $meta_boxes = array();
        public $default_settings = array();
        public $post_settings, $post_name;
        /* $post_settings example
          array(
               'labels' => array(
                   'menu_name'          => _x( 'Product Filters', 'Admin menu name', 'BeRocket_AJAX_domain' ),
                   'add_new_item'       => __( 'Add New Filter', 'BeRocket_AJAX_domain' ),
                   'edit'               => __( 'Edit', 'BeRocket_AJAX_domain' ),
                   'edit_item'          => __( 'Edit Filter', 'BeRocket_AJAX_domain' ),
                   'new_item'           => __( 'New Filter', 'BeRocket_AJAX_domain' ),
                   'view'               => __( 'View Filters', 'BeRocket_AJAX_domain' ),
                   'view_item'          => __( 'View Filter', 'BeRocket_AJAX_domain' ),
                   'search_items'       => __( 'Search Product Filters', 'BeRocket_AJAX_domain' ),
                   'not_found'          => __( 'No Product Filters found', 'BeRocket_AJAX_domain' ),
                   'not_found_in_trash' => __( 'No Product Filters found in trash', 'BeRocket_AJAX_domain' ),
               ),
               'description'     => __( 'This is where you can add Product Filters.', 'BeRocket_AJAX_domain' ),
               'public'          => true,
               'show_ui'         => true,
               'capability_type' => 'post',
               'publicly_queryable'  => false,
               'exclude_from_search' => true,
               'show_in_menu'        => 'edit.php?post_type=product',
               'hierarchical'        => false,
               'rewrite'             => false,
               'query_var'           => false,
               'supports'            => array( 'title' ),
               'show_in_nav_menus'   => false,
           )
         */
        function __construct () {
            add_filter( 'init', array( $this, 'init' ) );
            add_filter( 'admin_init', array( $this, 'admin_init' ) );
        }
        function init() {
            register_post_type( $this->post_name, $this->post_settings);
        }
        public function add_meta_box($slug, $name, $callback = false, $position = 'normal', $priority = 'high') {
            if( $callback === false ) {
                $callback = array($this, $slug);
            }
            $this->meta_boxes[$slug] = array('slug' => $slug, 'name' => $name, 'callback' => $callback, 'position' => $position, 'priority' => $priority);
        }
        public function admin_init() {
            if( ! empty($this->post_settings['show_in_menu']) && $this->post_settings['show_in_menu'] == 'berocket_custom_post' ) {
                $this->berocket_custom_post_menu();
            }
            add_filter( 'bulk_actions-edit-'.$this->post_name, array( $this, 'bulk_actions_edit' ) );
            add_filter( 'views_edit-'.$this->post_name, array( $this, 'views_edit' ) );
            add_filter( 'manage_edit-'.$this->post_name.'_columns', array( $this, 'manage_edit_columns' ) );
            add_action( 'manage_'.$this->post_name.'_posts_custom_column', array( $this, 'columns_replace' ), 2 );
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
            add_action( 'save_post', array( $this, 'wc_save_product' ), 10, 2 );
            add_filter( 'post_row_actions', array( $this, 'post_row_actions' ), 10, 2 );
            add_filter( 'list_table_primary_column', array( $this, 'list_table_primary_column' ), 10, 2 );
        }
        public function post_row_actions($actions, $post) {
            if( $post->post_type == $this->post_name ) {
                if( isset($actions['inline hide-if-no-js']) ) {
                    unset($actions['inline hide-if-no-js']);
                }
            }
            return $actions;
        }
        public function list_table_primary_column($default, $screen_id) {
            if( $screen_id == 'edit-'.$this->post_name ) {
                $default = 'name';
            }
            return $default;
        }
        public function bulk_actions_edit ( $actions ) {
            unset( $actions['edit'] );
            return $actions;
        }
        public function views_edit ( $view ) {
            unset( $view['publish'], $view['private'], $view['future'] );
            return $view;
        }
        public function manage_edit_columns ( $columns ) {
            $columns = array();
            $columns["cb"]   = '<input type="checkbox" />';
            $columns["name"] = __( "Name", 'BeRocket_AJAX_domain' );
            return $columns;
        }
        public function columns_replace ( $column ) {
            global $post;
            switch ( $column ) {
                case "name":

                    $edit_link = get_edit_post_link( $post->ID );
                    $title = '<a class="row-title" href="' . $edit_link . '">' . _draft_or_post_title() . '</a>';

                    echo 'ID:' . $post->ID . ' <strong>' . $title . '</strong>';

                    break;
            }
        }
        public  function add_meta_boxes () {
            add_meta_box( 'submitdiv', __( 'Save content', 'BeRocket_AJAX_domain' ), array( $this, 'save_meta_box' ), $this->post_name, 'side', 'high' );
            foreach($this->meta_boxes as $meta_box) {
                add_meta_box( $meta_box['slug'], $meta_box['name'], $meta_box['callback'], $this->post_name, $meta_box['position'], $meta_box['priority'] );
            }
        }
        public  function save_meta_box($post) {
            wp_enqueue_script( 'berocket_aapf_widget-colorpicker' );
            wp_enqueue_script( 'berocket_aapf_widget-admin' );
            wp_enqueue_style( 'brjsf-ui' );
            wp_enqueue_script( 'brjsf-ui' );
            wp_enqueue_script( 'berocket_framework_admin' );
            wp_enqueue_style( 'berocket_framework_admin_style' );
            wp_enqueue_script( 'berocket_widget-colorpicker' );
            wp_enqueue_style( 'berocket_widget-colorpicker-style' );
            wp_enqueue_style( 'font-awesome' );
            ?>
            <div class="submitbox" id="submitpost">

                <div id="minor-publishing">
                    <div id="major-publishing-actions">
                        <div id="delete-action">
                            <?php
                            global $pagenow;
                            if( in_array( $pagenow, array( 'post-new.php' ) ) ) {
                            } else {
                                if ( current_user_can( "delete_post", $post->ID ) ) {
                                    if ( ! EMPTY_TRASH_DAYS )
                                        $delete_text = __( 'Delete Permanently', 'BeRocket_AJAX_domain' );
                                    else
                                        $delete_text = __( 'Move to Trash', 'BeRocket_AJAX_domain' );
                                    ?>
                                    <a class="submitdelete deletion" href="<?php echo esc_url( get_delete_post_link( $post->ID ) ); ?>"><?php echo esc_attr( $delete_text ); ?></a>
                                <?php 
                                }
                            } ?>
                        </div>

                        <div id="publishing-action">
                            <span class="spinner"></span>
                            <input type="submit" class="button button-primary tips" name="publish" value="<?php _e( 'Save', 'BeRocket_AJAX_domain' ); ?>" data-tip="<?php _e( 'Save/update notice', 'BeRocket_AJAX_domain' ); ?>" />
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
            <?php
            wp_nonce_field($this->post_name.'_check', $this->post_name.'_nonce');
        }
        public function wc_save_check($post_id, $post) {
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return false;
            }
            if ( $this->post_name != $post->post_type ) {
                return false;
            }
            if( empty($_REQUEST[$this->post_name.'_nonce']) || ! wp_verify_nonce($_REQUEST[$this->post_name.'_nonce'], $this->post_name.'_check') ) {
                return false;
            }
            return true;
        }
        public function wc_save_product( $post_id, $post ) {
            $current_settings = get_post_meta( $post_id, $this->post_name, true );
            if( empty($current_settings) ) {
                update_post_meta( $post_id, $this->post_name, $this->default_settings );
            }
            if( ! $this->wc_save_check($post_id, $post) ) {
                return;
            }
            if ( isset( $_POST[$this->post_name] ) ) {
                $post_data = berocket_sanitize_array($_POST[$this->post_name]);
                if( is_array($post_data) ) {
                    $settings = array_merge($this->default_settings, $post_data);
                } else {
                    $settings = $post_data;
                }
                update_post_meta( $post_id, $this->post_name, $settings );
            }
        }
        public function get_option( $post_id ) {
            $options = get_post_meta( $post_id, $this->post_name, true );
            if( ! is_array($options) ) {
                $options = array();
            }
            $options = array_merge($this->default_settings, $options);
            return $options;
        }
        public function berocket_custom_post_menu() {
            global $berocket_custom_post_menu_page_added;
            if( empty($berocket_custom_post_menu_page_added) ) {
                add_menu_page(
                    'BeRocket Posts',
                    'BeRocket Posts',
                    'manage_options', 
                    'berocket_custom_post', 
                    null,
                    plugin_dir_url( __FILE__ ).'ico.png',
                    '55.55'
                );
                $berocket_custom_post_menu_page_added = true;
                add_action( 'admin_head', array( $this, 'icon_style') );
            }
        }
        public function icon_style() {
            ?>
            <style>
                .toplevel_page_berocket_custom_post .dashicons-before img {
                    max-width: 16px;
                    max-height: 16px;
                }
            </style>
            <?php
        }
    }
}
