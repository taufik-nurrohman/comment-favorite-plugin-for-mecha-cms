<?php

$cfv_config = File::open(__DIR__ . DS . 'states' . DS . 'config.txt')->unserialize();

Filter::add('shield:lot', function($data) use($config, $cfv_config) {
    $c = $config->page_type;
    if(isset($data[$c]->comments) && $data[$c]->comments !== false) {
        foreach($data[$c]->comments as &$comment) {
            if(isset($comment->fields->comment_favorite)) {
                $comment->name = sprintf($cfv_config['marker'], $comment->name);
                $comment->message = sprintf($cfv_config['container'], $comment->message);
            }
        }
        unset($comment);
    }
    return $data;
});

if(trim($cfv_config['css']) !== "") {
    Weapon::add('shell_after', function() use($config, $cfv_config) {
        echo O_BEGIN . '<style media="screen">' . $cfv_config['css'] . '</style>' . O_END;
    });
}