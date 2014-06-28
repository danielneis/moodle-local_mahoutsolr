<?php

$observers = array(
 
    array(
        'eventname'   => '\mod_forum\event\post_created',
        'callback'    => '\local_solr\forum_observers::post_created',
    ),
    array(
        'eventname'   => '\mod_forum\event\discussion_viewed',
        'callback'    => '\local_solr\forum_observers::discussion_viewed',
    ),
);
