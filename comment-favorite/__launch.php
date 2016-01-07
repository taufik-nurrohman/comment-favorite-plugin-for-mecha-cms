<?php


/**
 * Plugin Updater
 * --------------
 */

Route::accept($config->manager->slug . '/plugin/' . File::B(__DIR__) . '/update', function() use($config, $speak) {
    if($request = Request::post()) {
        Guardian::checkToken($request['token']);
        unset($request['token']);
        File::serialize($request)->saveTo(__DIR__ . DS . 'states' . DS . 'config.txt', 0600);
        Notify::success(Config::speak('notify_success_updated', $speak->plugin));
        Guardian::kick(File::D($config->url_current));
    }
});

// Add a star icon to the comment marked as favorite ...
if(Route::is($config->manager->slug . '/comment') || Route::is($config->manager->slug . '/comment/(:num)')) {
    Weapon::add('comment_footer', function($page) {
        if(isset($page->fields->comment_favorite) && $page->fields->comment_favorite !== false) {
            echo '<span style="color:#FFB350;">' . Jot::icon('star') . '</span> &middot; ';
        }
    });
}