<?php

/**
 * Forum improvements using Apache Mahout and Solr version information
 *
 * @package   local_mahoutsolr
 * @copyright 2014 Daniel Neis Araujo
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2014052709;       // The current module version (Date: YYYYMMDDXX)
$plugin->requires  = 2014050800;    // Requires this Moodle version
$plugin->component = 'local_mahoutsolr';     // Full name of the plugin (used for diagnostics)
$plugin->cron      = 0;
