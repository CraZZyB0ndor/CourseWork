<?php

include 'SelectInfoAboutPost.php';

function ProcessingPostData($MySql) {

    if ( key_exists('order', $_SESSION) && key_exists('filter', $_SESSION) && key_exists('search', $_SESSION) ) {

        $MySQL_query = $_SESSION['filter'] . " " . $_SESSION['search'] . " " . $_SESSION['order'];

        return DisplayPosts($MySql, $MySQL_query);

    } else if ( key_exists('order', $_SESSION) && key_exists('filter', $_SESSION) ) {

        $MySQL_query = $_SESSION['filter'] . " " . $_SESSION['order'];

        return DisplayPosts($MySql, $MySQL_query);

    } else if ( key_exists('filter', $_SESSION)  && key_exists('search', $_SESSION) ) {

        $MySQL_query = $_SESSION['filter'] . " " . $_SESSION['search'];

        return DisplayPosts($MySql, $MySQL_query);

    } else if ( key_exists('order', $_SESSION)  && key_exists('search', $_SESSION) ) {

        $MySQL_query = $_SESSION['search'] . " " . $_SESSION['order'];

        return DisplayPosts($MySql, $MySQL_query);

    } else if ( key_exists('order', $_SESSION) ) {

        return DisplayPosts($MySql, $_SESSION['order']);

    } else if ( key_exists('filter', $_SESSION) ) {

        return DisplayPosts($MySql, $_SESSION['filter']);

    } else if ( key_exists('search', $_SESSION)) {

        return DisplayPosts($MySql, $_SESSION['search']);

    } else {

        return DisplayPosts($MySql, "");
    }

}

?>