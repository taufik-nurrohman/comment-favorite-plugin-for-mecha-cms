<?php

$cf_config = File::open(__DIR__ . DS . 'states' . DS . 'config.txt')->unserialize();

Filter::add('shield:lot', function($data) use($config, $cf_config) {
    $c = $config->page_type;
    if(isset($data[$c]->comments) && $data[$c]->comments !== false) {
        foreach($data[$c]->comments as &$comment) {
            if(isset($comment->fields->comment_favorite)) {
                $comment->name = sprintf($cf_config['marker'], $comment->name);
                $comment->message = sprintf($cf_config['container'], $comment->message);
            }
        }
        unset($comment);
    }
    return $data;
});

if(trim($cf_config['css']) !== "") {
    Weapon::add('shell_after', function() use($config, $cf_config) {
        echo O_BEGIN . '<style media="screen">' . $cf_config['css'] . '</style>' . O_END;
    });
}