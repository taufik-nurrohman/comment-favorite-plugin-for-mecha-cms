<?php

$cfv_config = File::open(PLUGIN . DS . File::B(__DIR__) . DS . 'states' . DS . 'config.txt')->unserialize();

Filter::add('shield:lot', function($data) use($cfv_config) {
    if(isset($data['article']->comments) && $data['article']->comments !== false) {
        foreach($data['article']->comments as &$comment) {
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
        echo O_BEGIN . str_repeat(TAB, 2) . '<style media="screen">' . ($config->html_minifier ? Converter::detractShell($cfv_config['css']) : $cfv_config['css']) . '</style>' . O_END;
    });
}