<?php
/**
 * Plugin Name:     Variation Max for WooCommerce
 * Plugin URI:      https://premierethemes.com/plugins/variation_max
 * Description:     Increase the max number of variations that can be processed in WooCommerce
 * Author:          Premiere Themes
 * Author URI:      https://premierethemes.com
 * Text Domain:     variation-max
 * Domain Path:     /languages
 * Version:         1.0
 * License:         GPL v3 or later
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.en.html
 * 
 * @package         Variation_Max
 * 
 */

/*
Variation Max is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.
 
Variation Max is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Variation Max. If not, see https://www.gnu.org/licenses/gpl-3.0.en.html.
*/

/* Do not change anything below here */
define( 'VARMAXFORWOO_CLASS_NAME_VARIATION_MAX', 'VarMaxForWooVariationMax' );
define( 'VARMAXFORWOO_CLASS_FILE_NAME_VARIATION_MAX', 'class-varmaxforwoo-variation-max.php' );
define( 'VARMAXFORWOO_FIELD_NAME', 'varmaxforwoo_variation_max_value' );
define( 'VARMAXFORWOO_SECTION_NAME', 'varmaxforwoo_variation_max' );
define( 'VARMAXFORWOO_SECTION_LABEL', 'Variation Max' );
define( 'VARMAXFORWOO_SECTION_DEF_TIP', 'This will change the max number of variations that can be processed by defualt' );
define( 'VARMAXFORWOO_WC_VARIATION_MAX_DEFAULT', 50 );

try
{
    require_once( VARMAXFORWOO_CLASS_FILE_NAME_VARIATION_MAX );

    if( !class_exists( VARMAXFORWOO_CLASS_NAME_VARIATION_MAX ) )
    {
        throw( _e( 'Class ' . VARMAXFORWOO_CLASS_NAME_VARIATION_MAX . ' not defined.', 'variation-max' ) );
    }

    // Instantiate object and run initialization methods
    $VarMax = new VarMaxForWooVariationMax();
    $VarMax->registerHooks();

    /**
     * Create the section beneath the Advanced tab
     **/
    $VarMax->setMaxFieldValue();

} catch( Exception $e )
{
    echo $e->getMessage();
    exit;
} 
