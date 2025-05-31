<?php
/*
Plugin Name: CheckItOf
Plugin URI: https://github.com/yourusername/checkitof
Description: A simple to-do list plugin for WordPress.
Version: 1.0
Author: Your Name
Author URI: https://yourportfolio.com
*/

defined('ABSPATH') || exit;

// Load CSS & JS
function checkitof_enqueue_scripts() {
    wp_enqueue_style('checkitof-style', plugin_dir_url(__FILE__) . 'style.css');
    wp_enqueue_script('checkitof-script', plugin_dir_url(__FILE__) . 'script.js', array('jquery'), null, true);
    wp_localize_script('checkitof-script', 'checkitof_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'checkitof_enqueue_scripts');

// Shortcode output
function checkitof_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/todo-list.php';
    return ob_get_clean();
}
add_shortcode('checkitof', 'checkitof_shortcode');

// Save task
add_action('wp_ajax_checkitof_save_task', 'checkitof_save_task');
add_action('wp_ajax_nopriv_checkitof_save_task', 'checkitof_save_task');

function checkitof_save_task() {
    $task = sanitize_text_field($_POST['task']);
    $tasks = get_option('checkitof_tasks', []);
    $tasks[] = ['task' => $task, 'completed' => false];
    update_option('checkitof_tasks', $tasks);
    wp_send_json_success($tasks);
}

// Get all tasks
add_action('wp_ajax_checkitof_get_tasks', 'checkitof_get_tasks');
add_action('wp_ajax_nopriv_checkitof_get_tasks', 'checkitof_get_tasks');

function checkitof_get_tasks() {
    $tasks = get_option('checkitof_tasks', []);
    wp_send_json_success($tasks);
}

// Toggle complete/incomplete
add_action('wp_ajax_checkitof_toggle_task', 'checkitof_toggle_task');
add_action('wp_ajax_nopriv_checkitof_toggle_task', 'checkitof_toggle_task');

function checkitof_toggle_task() {
    $index = intval($_POST['index']);
    $tasks = get_option('checkitof_tasks', []);
    if (isset($tasks[$index])) {
        $tasks[$index]['completed'] = !$tasks[$index]['completed'];
        update_option('checkitof_tasks', $tasks);
        wp_send_json_success($tasks);
    }
    wp_send_json_error();
}

// Delete task
add_action('wp_ajax_checkitof_delete_task', 'checkitof_delete_task');
add_action('wp_ajax_nopriv_checkitof_delete_task', 'checkitof_delete_task');

function checkitof_delete_task() {
    $index = intval($_POST['index']);
    $tasks = get_option('checkitof_tasks', []);
    if (isset($tasks[$index])) {
        array_splice($tasks, $index, 1);
        update_option('checkitof_tasks', $tasks);
        wp_send_json_success($tasks);
    }
    wp_send_json_error();
}
