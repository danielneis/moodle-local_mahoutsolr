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
     * A new post was created
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

    /**
     * A new post was created
     *
     * @param \mod_forum\event\post_created $event The event.
     * @return void
     */
    public static function post_created(\mod_forum\event\post_created $event) {
        require_once($CFG->dirroot.'/local/mahoutsolr/lib.php');
        $mahoutclient = new MahoutClient();
        $snapshot = $event->get_record_snapshot('forum_posts', $event->objectid);
        $maybespam = $snapshot->subject .' '. $snapshot->message;
        if ($mahoutclient->isSpam($maybespam)) {
            require_once($CFG->dirroot . '/blocks/spam_deletion/lib.php');
            $postspam = new \forum_post_spam($event->objectid);
            $postspam->register_vote(2);
        }
    }

    /**
     * A discussion was viewed
     *
     * @param \mod_forum\event\discussion_viewed $event The event.
     * @return void
     */
    public static function discussion_viewed(\mod_forum\event\discussion_viewed $event) {
        global $CFG;
        require_once($CFG->dirroot . '/search/' . $CFG->SEARCH_ENGINE . '/connection.php');
        require_once($CFG->dirroot . '/search/lib.php');
        $search_engine_installed = $CFG->SEARCH_ENGINE . '_installed';
        $search_engine_check_server = $CFG->SEARCH_ENGINE . '_check_server';
        if ($search_engine_installed() and $search_engine_check_server($client)) {

            $snapshot = $event->get_record_snapshot('forum_discussions',$event->objectid);

            $search = new \stdclass();
            //$search->queryfield = '[title:("'.$snapshot->name.'")]';
            $search->queryfield = $snapshot->name;
            $search->modulefilterqueryfield = 'forum';

            try {
                $results = \call_user_func($CFG->SEARCH_ENGINE . '_execute_query', $client, $search);
                if ($results != 'No search results found. Try modifying your query.') {
                    $cleanresults = array();
                    foreach ($results as $r){
                        $cleanresults[] = array('name' => $r->title, 'link' => $r->contextlink);
                    }
                    global $PAGE;
                    $PAGE->requires->strings_for_js(array('show_related_discussions'), 'local_mahoutsolr');
                    $PAGE->requires->js_init_call('M.local_mahoutsolr.show_related_discussions', array($cleanresults), true);
                }
            } catch (Exception $e) {
            }
        }
    }
}
