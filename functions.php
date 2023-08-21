<?php
add_filter('generate_rewrite_rules', function ($wp_rewrite) {
    $wp_rewrite->rules = array_merge(
        ['my-custom-url/?$' => 'index.php?custom=1'],
        $wp_rewrite->rules
    );
});
add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'custom';
    return $query_vars;
});
add_action('template_redirect', function () {
    $custom = intval(get_query_var('custom'));
    if ($custom) {
        include plugin_dir_path(__FILE__) . 'templates/custom.php';
        die;
    }
});
