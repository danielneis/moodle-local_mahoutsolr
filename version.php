<?php

/**
 * Forum improvements using Apache Mahout and Solr version information
 *
 * @package   local_mahoutsolr
 * @copyright 2014 Daniel Neis Araujo
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2014061101;       // The current module version (Date: YYYYMMDDXX)
$plugin->requires  = 2014050800;    // Requires this Moodle version
$plugin->component = 'local_mahoutsolr';     // Full name of the plugin (used for diagnostics)
$plugin->cron      = 0;
$plugin->depencies = array('block_spam_deletion' => 2014060200);
