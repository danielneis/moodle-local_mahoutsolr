<?php

$observers = array(
 
    array(
        'eventname'   => '\mod_forum\event\discussion_created',
        'callback'    => '\local_mahoutsolr\forum_observers::discussion_created',
    ),
);
