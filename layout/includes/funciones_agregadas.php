<?php

function message_count_unread_messages($user1=null, $user2=null) {
    global $USER, $DB;

    if (empty($user1)) {
        $user1 = $USER;
    }

    if (!empty($user2)) {
        return $DB->count_records_select('message', "useridto = ? AND useridfrom = ?",
            array($user1->id, $user2->id), "COUNT('id')");
    } else {
        return $DB->count_records_select('message', "useridto = ?",
            array($user1->id), "COUNT('id')");
    }
}

?>