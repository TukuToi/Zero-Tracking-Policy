<?php
/**
 * Provide the public API.
 *
 * @package Zero_Tracking_Policy
 * @since 1.0.0
 */

/**
 * Autoload Classes
 *
 * @param string $class The Class to autoload.
 */
function ztp_autoloader( $class ) {
	include 'classes/' . $class . '.php';
}
spl_autoload_register( 'ztp_autoloader' );

/**
 * Load the API and set response header.
 */
$api = new Zero_Tracking_Policy_Api();
header( 'Content-Type: application/json; charset=utf-8' );

/**
 * If the request is for getting the chain.
 */
if ( isset( $_GET['get_chain'] ) ) {

	echo $api->get_chain();

}

/**
 * If the request is for validating the chain
 */
if ( isset( $_GET['is_chain_valid'] ) ) {

	echo $api->is_chain_valid();

}

/**
 * If the request is for replacing the chain
 */
if ( isset( $_GET['replace_chain'] ) ) {

	echo $api->replace_chain();

}

/**
 * If the request is for getting a domain.
 */
if ( isset( $_GET['get_domain'] ) ) {

	$domain = filter_var( stripslashes( htmlspecialchars( $_GET['get_domain'] ) ), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME );

	echo $api->get_domain( $domain );

}

/**
 * If the request is to stage a domain
 */
if ( isset( $_POST['stage_domain'] ) ) {

	$domain = filter_var( stripslashes( htmlspecialchars( $_POST['stage_domain'] ) ), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME );
	//$domain = filter_var( gethostbyname( $domain ), FILTER_VALIDATE_IP );

	echo $api->stage_domain( $domain );

}

/**
 * If the request is to verify a domain.
 */
if ( isset( $_POST['verify_domain'] ) ) {

	$domain = filter_var( stripslashes( htmlspecialchars( $_POST['verify_domain'] ) ), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME );
	//$domain = filter_var( gethostbyname( $domain ), FILTER_VALIDATE_IP );

	echo $api->verify_domain( $domain );

}

/**
 * If the request is to add a node.
 */
if ( isset( $_POST['add_node'] ) ) {

	$node = filter_var( stripslashes( htmlspecialchars( $_POST['add_node'] ) ), FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME );
	//$node = filter_var( gethostbyname( $domain ), FILTER_VALIDATE_IP );

	echo $api->add_node( $node );

}

