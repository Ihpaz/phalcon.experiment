<?php

use Dotenv\Dotenv;
use Application\Adapters\Logger\Sentry;

define( 'BASE_DIR', dirname( __DIR__ ) . DIRECTORY_SEPARATOR );
include BASE_DIR . 'app/forms/BarangForm.php';
include BASE_DIR . 'app/models/Barang.php';
include BASE_DIR . 'app/controllers/ControllerBase.php';
include BASE_DIR . 'app/controllers/BarangController.php';
// Include Composer autoloader
include BASE_DIR . 'vendor/autoload.php';
// Load environment variables


$dotenv = new Dotenv( realpath( BASE_DIR ) );
$dotenv->load();



/**
 * @const ENV_PRODUCTION Application production stage
 */
define( 'ENV_PRODUCTION', 'production' );
/**
 * @const ENV_STAGING Application staging stage
 */
define( 'ENV_STAGING', 'staging' );
/**
 * @const ENV_DEVELOPMENT Application development stage
 */
define( 'ENV_DEVELOPMENT', 'development' );
/**
 * @const ENV_TESTING Application test stage
 */
define( 'ENV_TESTING', 'testing' );
/**
 * @const APPLICATION_ENV Current application stage
 */
define( 'APPLICATION_ENV', env( 'APP_ENV', ENV_DEVELOPMENT ) );
/**
 * @const APP_START_TIME The start time of the application, used for profiling
 */
define( 'APP_START_TIME', microtime( true ) );
/**
 * @const APP_START_MEMORY The memory usage at the start of the application, used for profiling
 */
define( 'APP_START_MEMORY', memory_get_usage() );
/**
 * @const NAMESPACE_SEPARATOR Namespace Separator
 */
define( 'NAMESPACE_SEPARATOR', '\\' );
/**
 * @const DEV_IP Developer IP mask
 */
define( 'DEV_IP', '192.168.' );
/**
 * @const HOSTNAME Current hostname
 */
define( 'HOSTNAME', explode( '.', gethostname() )[0] );

if ( function_exists( 'mb_internal_encoding' ) ) {
	// Set the MB extension encoding to the same character set
	mb_internal_encoding( 'utf-8' );
}
if ( function_exists( 'mb_substitute_character' ) ) {
	// Set the mb_substitute_character to "none"
	mb_substitute_character( 'none' );
}
if ( ENV_PRODUCTION === APPLICATION_ENV ) {
	header_remove( 'X-Powered-By' );
	error_reporting( E_ALL ^ E_NOTICE ^ E_WARNING );
}
if ( ENV_DEVELOPMENT === APPLICATION_ENV || ENV_STAGING === APPLICATION_ENV ) {
	error_reporting( E_ALL ^ E_NOTICE ^ E_WARNING );
	// Enable xdebug parameter collection in development mode to improve fatal stack traces.
	// Highly recommends use at least XDebug 2.2.3 for a better compatibility with Phalcon
	if ( extension_loaded( 'xdebug' ) ) {
		ini_set( 'xdebug.collect_params', 4 );
	}
}
if ( PHP_SAPI == 'cli' ) {
	set_time_limit( 0 );
}