<?php

/**
 * Forum observers.
 *
 * @package    local_mahoutsolr
 * @copyright  2014 Daniel Neis Araujo
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_mahoutsolr;
defined('MOODLE_INTERNAL') || die();

class forum_observers {

    /**
     * A new discussion was created
     *
     * @param \mod_forum\event\discussion_created $event The event.
     * @return void
     */
    public static function discussion_created(\mod_forum\event\discussion_created $event) {
        global $CFG;
        require_once($CFG->dirroot . '/search/' . $CFG->SEARCH_ENGINE . '/connection.php');
        require_once($CFG->dirroot . '/search/lib.php');
        $search_engine_installed = $CFG->SEARCH_ENGINE . '_installed';
        $search_engine_check_server = $CFG->SEARCH_ENGINE . '_check_server';
        if ($search_engine_installed() and $search_engine_check_server($client)) {
            try {
                $docs = forum_search_get_documents($event->objectid);
                foreach ($docs as $document) {
                    if ($document->getField('type')->values[0] == SEARCH_TYPE_HTML) {
                            $client->add_document($document);
                    }
                }
                $client->commit();
            } catch (Exception $e) {
            }
        }
    }
}
