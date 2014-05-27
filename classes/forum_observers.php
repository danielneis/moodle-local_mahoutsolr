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
        var_dump($event->get_record_snapshot('forum_discussions', $event->objectid));
        die('sopt2!');
    }
}
