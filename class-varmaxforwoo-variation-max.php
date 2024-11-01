<?php

class VARMAXFORWOOVariationMax
{
    private $errMsg;

    public function setSectionName( $section = null )
    {
        if( !isset( $section ) )
            return;

        $this->section_name = $section;
        return;
    }

    public function setMaxFieldValue()
    {
        /**
         * Redefine WC_MAX_LINKED_VARIATIONS if the max is stored
         */
        if( $max = get_option( VARMAXFORWOO_FIELD_NAME ) )
        {
            if( isset( $max ) && is_numeric( $max ) )
            {
                define( 'WC_MAX_LINKED_VARIATIONS', $max );
            }
        }
    }

    public function setFilter( $filter = null, $callback, $priority, $argCnt )
    {
        add_filter( $filter, $callback, $priority, $argCnt );
        return true;
    }

    public function registerHooks()
    {

        add_filter( 'woocommerce_get_sections_advanced', array( $this, 'varmaxforwoo_add_advanced_section' ) );
        add_filter( 'woocommerce_get_settings_advanced', array( $this, 'varmaxforwoo_add_advanced_section_all_settings' ), 10, 2 );
        register_uninstall_hook(__FILE__, 'varmaxforwoo_variation_max_uninstall' );

    }

    public function getMaxFieldName()
    {
        return VARMAXFORWOO_MAX_FIELD_NAME;
    }

    public function getSectionName()
    {
        return VARMAXFORWOO_SECTION_NAME;
    }

    /**
     * Create the section beneath the products tab
     **/

    function varmaxforwoo_add_advanced_section( $sections )
    {
        $sections[ $this->getSectionName() ] = __( VARMAXFORWOO_SECTION_LABEL, 'variation-max' );
        return $sections;
    }

    /**
     * Add settings to the specific section we created before
     */
    function varmaxforwoo_add_advanced_section_all_settings( $settings, $current_section ) 
    {
        /**
         * Check the current section is what we want
         **/
        if ( $current_section == $this->get_section_name() ) 
        {
            $settings_slider = array();

            // Add Title to the Settings
            $settings_slider[] = array( 'name' => __( 'Variation Max Settings', 'variation-max' ), 
                                        'type' => 'title', 
                                        'desc' => __( 'The following options are used to configure Variation Max', 'variation-max' ), 
                                        'id'   => $this->get_section_name() );

            // Add text field option
            $settings_slider[] = array(
                'name'     => __( $this->getSectionLabel(), 'variation-max' ),
                'desc_tip' => __( $this->getSectionDefTip(), 'variation-max' ),
                'id'       => $this->get_max_value_option_name(),
                'type'     => 'text',
                'desc'     => __( 'Enter a numeric value', 'variation-max' ),
            );

            $settings_slider[] = array( 'type' => 'sectionend', 'id' => $this->get_section_name() );
            return $settings_slider;
        

        } else
        { // If not, return the standard settings
            return $settings;
        }
    }

    /** Add (a)n uninstall hook */
    function varmaxforwoo_variation_max_uninstall()
    {   
        // reset variation max to default on uninstall
        define( 'WC_MAX_LINKED_VARIATIONS', VARMAXFORWOO_WC_VARIATION_MAX_DEFAULT );
        delete_option( $this->get_max_value_option_name() );
    }

    /**
     * Helper function to get variation max input field id
     */
    function get_max_value_option_name()
    {
        return VARMAXFORWOO_FIELD_NAME;

    }

    /**
     * Helper function to get section name
     */
    function get_section_name()
    {
        return VARMAXFORWOO_SECTION_NAME;
    }

    public function getSectionLabel()
    {
        return VARMAXFORWOO_SECTION_LABEL;
    }

    public function getSectionDefTip()
    {
        return VARMAXFORWOO_SECTION_DEF_TIP;
    }
}