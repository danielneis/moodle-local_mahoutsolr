M.local_mahoutsolr = {};

// This function adds the 'report as spam' link on every post.
M.local_mahoutsolr.show_related_discussions = function(Y, related_discussions) {
    var mainsection = Y.one('#page-mod-forum-discuss #region-main');

    mainsection.append('<div class="discussioncontrol"><a id="showrelateddiscussions" href="#">' + M.str.local_mahoutsolr.show_related_discussions + '</a></div>');

    Y.one("#showrelateddiscussions").on('click', function(ev) {
        if (!Y.one("#relateddiscussions")) {
            var related_list = '<ul id="relateddiscussions">';
            for (var i in related_discussions) {
                discussion = related_discussions[i];
                related_list += '<li><a href="' +M.cfg.wwwroot + discussion.link + '">'+discussion.name +'</a></li>';
            }
            related_list += '</ul>';
            mainsection.append(related_list);
        }
        ev.preventDefault();
        return false;
    });
}
