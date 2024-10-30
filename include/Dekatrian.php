<?php
if ( !class_exists( 'Dekatrian' ) ) {
    class Dekatrian {
        public $page = 'dekatrian';
        public $option_name = 'dekatrian_settings';
        private $options;

        public function __construct() {
            register_activation_hook(DEKATRIAN_BASENAME, array($this, 'activate'));
            register_deactivation_hook(DEKATRIAN_BASENAME, array($this, 'deactivate'));

            add_action('plugins_loaded', array($this, 'init'));
        }

        public function init() {
            add_action('plugin_action_links_' . DEKATRIAN_BASENAME, array($this, 'load_plugin_action_links'));

            add_action('admin_menu', array($this, 'dktn_admin_menu'));
            add_action('admin_init', array($this, 'dktn_plugin_settings'));
            add_action('admin_enqueue_scripts', array($this, 'enqueue_javascript_stylesheet'));
            add_action('admin_footer', array($this, 'dekatrian_javascript'));
            add_action('wp_ajax_dekatrian_date_format', array($this, 'dekatrian_date_format'));

            if(get_option($this->option_name)["activate"])
                add_action('get_the_date', array($this, 'dktn_filter_publish_dates'), 10, 3);
        }

        public function dktn_filter_publish_dates( $the_date, $d, $post ) {
            $date = new DekatrianDate(get_option($this->option_name)['date_format'], $post->post_date, get_option('date_format'));
            return $date;
        }

        public function activate() {
            update_option($this->option_name, self::get_default_options());
        }

        public function deactivate() {
            delete_option($this->option_name);
        }

        public function load_plugin_action_links($links) {
            $settings_url = admin_url('options-general.php?page=' . $this->page);
            $links[] = '<a href="' . esc_url($settings_url) . '">Configurações</a>';
            return $links;
        }

        public function dktn_admin_menu() {
             add_options_page(
               'Calendário Dekatrian',
               'Calendário Dekatrian',
               'edit_posts',
               $this->page,
               array($this, 'dktn_admin_menu_callback')
            );
        }

        public function dktn_admin_menu_callback() {
            include_once DKT_ADMIN_INC . '/html-settings-page.php';
        }

        public function enqueue_javascript_stylesheet($hook) {
            if ('settings_page_' . $this->page != $hook) {
                return;
            } else {
                wp_enqueue_script($this->page . '-admin', DEKATRIAN_URL . '/admin/js/' . $this->page . '-admin.js', array('jquery'));
                wp_enqueue_style($this->page . '-admin', DEKATRIAN_URL . '/admin/css/' . $this->page . '-admin.css', false);
            }
        }


        public function dekatrian_date_format() {
            echo new DekatrianDate(stripslashes($_POST['date_format']), date('c'), get_option('date_format'));
            wp_die();
        }

        public function dekatrian_javascript() { ?>
            <script type="text/javascript" >
            jQuery(document).ready(function($) {
                var date_format_custom = $('#date_format-custom').val();
                $('#date_format-custom').on('focusout', function(){

                    if($(this).val() != date_format_custom){
                        date_format_custom = $(this).val();
                        var data = {
                            'action': 'dekatrian_date_format',
                            'date_format': $(this).val()
                        };

                        $(".spinner").addClass("is-active");
                        jQuery.post(ajaxurl, data, function(response) {
                            $(".spinner").removeClass("is-active");
                            $(".example").html(response);
                        });
                    }
                });
            });
            </script> <?php
        }

        public function dktn_plugin_settings() {
             add_settings_field(
                'activate',
                'Ativo',
                array($this, 'radio_element_callback'),
                $this->page,
                'dktn_basic_section',
                array(
                    'id'   => 'activate'
                )
            );

            add_settings_field(
                'date_format',
                "Formato de data",
                array($this, 'radio_format_callback'),
                $this->page,
                'dktn_basic_section',
                array(
                    'id'   => 'date_format'
                )
            );

            register_setting($this->option_name, $this->option_name, array($this, 'validate_dktn_settings'));
        }

        static public function get_default_options() {
            return array(
                'date_format'  => '?d F Y',
                'activate'      => 1,
                'version'       => DEKATRIAN_VERSION,
            );
        }

         public function radio_element_callback($args) {
            extract($args);
            $options = get_option($this->option_name);
            $value = isset($options[$id]) ? $options[$id] : '0';

            echo "<label><input id='$id-0' type='radio' name='" . $this->option_name . "[$id]' value='0'" . checked('0', $value, false) . " /> N&atilde;o</label>";
            echo "<br />";
            echo "<label><input id='$id-1' type='radio' name='" . $this->option_name . "[$id]' value='1'" . checked('1', $value, false) . " /> Sim</label>";
        }

        public function radio_format_callback($args) {
            extract($args);
            $options = get_option($this->option_name);
            $value = isset($options[$id]) ? $options[$id] : '';
            $date = new DekatrianDate('', date('c'), get_option('date_format'));
            $custom = true;
            
            foreach (['?d F Y', 'd\m\Y', 'd\m\Y | G'] as $format) {
                $custom &= !checked($format, $value, false);
                echo "<label><input type='radio' name='" . $this->option_name . "[$id]' " . checked($format, $value, false) . " value='" . $format . "'> <span class='date-time-text'>" . $date->format($format) . "</span><code>" . $format . "</code></label><br>";
            }
            echo "<label><input type='radio' name='" . $this->option_name . "[$id]' " . checked($custom ? $value : '', $value, false) . " value='custom'> <span class='date-time-text'>Personalizado:</span><input id='$id-custom' type='text' name='" . $this->option_name . "[$id]' value='" . $value . "' /></label><span class='example'>" . $date->format($value) . "</span><span class='spinner'></span><br>";
            echo "<p class='date-time-doc'><a href='#help-tab'>Documentação sobre a formatação da Data</a></p>";
        }

        public function validate_dktn_settings($input) {
            foreach ($input as $k => $v)
                $newinput[$k] = trim($v);

            return $newinput;
        }
    }
    new Dekatrian();
}