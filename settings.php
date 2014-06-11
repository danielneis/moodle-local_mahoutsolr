<?php
// this file is part of moodle - http://moodle.org/
//
// moodle is free software: you can redistribute it and/or modify
// it under the terms of the gnu general public license as published by
// the free software foundation, either version 3 of the license, or
// (at your option) any later version.
//
// moodle is distributed in the hope that it will be useful,
// but without any warranty; without even the implied warranty of
// merchantability or fitness for a particular purpose.  see the
// gnu general public license for more details.
//
// you should have received a copy of the gnu general public license
// along with moodle.  if not, see <http://www.gnu.org/licenses/>.

/**
 * Improvements to forum using Apache Mahout and Apache Solr settings and presets.
 *
 * @package    local_mahoutsolr
 * @copyright  2014 Daniel Neis
 * @license    http://www.gnu.org/copyleft/gpl.html gnu gpl v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $settings = new admin_settingpage('local_mahoutsolr_settings', get_string('settings', 'local_mahoutsolr'), 'local/mahoutsolr:config');
    //--- general settings -----------------------------------------------------------------------------------
    $settings->add(new admin_setting_heading('local_mahoutsolr_settings_header', '', get_string('pluginname_desc', 'local_mahoutsolr')));

    $settings->add(new admin_setting_configtext('local_mahoutsolr/mahouthost', get_string('mahouthost', 'local_mahoutsolr'), get_string('mahouthost_desc', 'local_mahoutsolr'), 'localhost'));
    $settings->add(new admin_setting_configtext('local_mahoutsolr/mahoutport', get_string('mahoutport', 'local_mahoutsolr'), get_string('mahoutport_desc', 'local_mahoutsolr'), '8080'));

    $ADMIN->add('localplugins', $settings);
}
