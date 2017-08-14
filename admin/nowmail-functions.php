<?php

//call admin UI page
function nowmail_company_page() {
    
}

//call admin setting UI page
function nowmail_settings_page() {
    require_once 'nowmail-settings.php';
}

//call admin UI page
function nowmail_compose_page() {
    require_once 'nowmail-compose.php';
}

//add menu in left side bar
function nowmail_admin_menu() {
    add_menu_page('nowmail', 'Now Mail', 'manage_options', 'nowmail', 'nowmail_company_page', plugins_url('../images/nowmail.png', __FILE__));
    add_submenu_page('nowmail', 'compose', 'Compose', 'manage_options', 'nowmail', 'nowmail_compose_page');
    add_submenu_page('nowmail', 'settings', 'Settings', 'manage_options', 'nowmailsettings', 'nowmail_settings_page');
}

add_action('admin_menu', 'nowmail_admin_menu');

/**
 *
 * @return int
 */
function nowmail_text_editor() {
    $settings = array(
        'dfw' => false,
        'drag_drop_upload' => true,
        'editor_height' => 360,
        'textarea_name' => 'message',
        'tinymce' => array(
            'resize' => false,
            'add_unload_trigger' => true,
        )
    );
    return $settings;
}

/**
 * @param $options
 * @return mixed
 */
function nowMail_validate_options($options) {
    global $nowMailSettings;
    if (isset($options['nowmail_update'])) {
        $result = __("Options saved successfully.", "nowmail");
        $status = 'updated';
        $nowMailSettings = array();
        $nowMailSettings["from"] = trim($options['nowmail_from']);
        $nowMailSettings["fromname"] = trim($options['nowmail_fromname']);
        $nowMailSettings["host"] = trim($options['nowmail_host']);
        $nowMailSettings["smtpsecure"] = trim($options['nowmail_smtpsecure']);
        $nowMailSettings["port"] = trim($options['nowmail_port']);
        $nowMailSettings["smtpauth"] = trim($options['nowmail_smtpauth']);
        $nowMailSettings["username"] = trim($options['nowmail_username']);
        $nowMailSettings["password"] = trim($options['nowmail_password']);
        $nowMailSettings["deactivate"] = (isset($options['nowmail_deactivate'])) ? trim($options['nowmail_deactivate']) : "";
        update_option("nowMail_settings", $nowMailSettings);
        if (!is_email($nowMailSettings["from"])) {
            $result = __("The field 'From' must be a valid email address!", "nowmail");
            $status = 'error';
        } elseif (empty($nowMailSettings["host"])) {
            $result = __("The field 'SMTP Host' can not be left blank!", "nowmail");
            $status = 'error';
        }
        return '<div id="message" class="'.$status.' fade"><p><strong>' . $result . '</strong></p></div>';
    }
}

/**
 * @param $request
 * @return string
 */
function nowmail_send_mail($request) {
    $failed = 0;
    if (!empty($request['to']) && !empty($request['message'])) {
        try {
            $result = wp_mail($request['to'], $request['subject'], $request['message']);
        } catch (phpmailerException $e) {
            $failed = 1;
        }
    } else {
        $failed = 2;
    }
    if (!$failed) {
        $failed = 1;
        if ($result == TRUE) {
            $response = '<div id="message" class="updated fade"><p><strong>' . __("Message sent!", "nowmail") . '</strong></p></div>';
        }
    }
    if ($failed == 1) {
        $response = '<div id="message" class="error fade"><p><strong>' . __("Some errors occurred!", "nowmail") . '</strong></p></div>';
    } elseif ($failed == 2) {
        $response = '<div id="message" class="error fade"><p><strong>' . __("The fields 'To' and  'Message' can not be blank!", "nowmail") . '</strong></p></div>';
    }
    return $response;
}
