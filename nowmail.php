<?php

/*
  Plugin Name: NowMail
  Plugin URI: http://wordpress.org/plugins/nowmail/
  Description: Email Delivery. nowmail can help you to send emails via SMTP instead of the PHP mail() function.
  Version: 1.1
  Author: SoniNow Team
  Author URI: http://www.soninow.com
  License: GPLv2
 */
$nowMailSettings = get_option('nowMail_settings');

//smtp functionality with wordpress
function nowmail_smtp($phpmailer) {
    global $nowMailSettings;
    if (!is_email($nowMailSettings["from"]) || empty($nowMailSettings["host"])) {
        return;
    }
    $phpmailer->Mailer = "smtp";
    $phpmailer->From = $nowMailSettings["from"];
    $phpmailer->FromName = $nowMailSettings["fromname"];
    $phpmailer->Sender = $phpmailer->From; //Return-Path
    $phpmailer->AddReplyTo($phpmailer->From, $phpmailer->FromName); //Reply-To
    $phpmailer->Host = $nowMailSettings["host"];
    $phpmailer->SMTPSecure = $nowMailSettings["smtpsecure"];
    $phpmailer->Port = $nowMailSettings["port"];
    $phpmailer->SMTPAuth = ($nowMailSettings["smtpauth"] == "yes") ? TRUE : FALSE;
    if ($phpmailer->SMTPAuth) {
        $phpmailer->Username = $nowMailSettings["username"];
        $phpmailer->Password = $nowMailSettings["password"];
    }
}

add_action('phpmailer_init', 'nowmail_smtp');

//add setting option on plugin installed page
function nowmail_settings_link($links) {
    $settings_link = '<a href="admin.php?page=nowmail">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}

$plugin = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin", 'nowmail_settings_link');

//initial variable foe functons
function nowmail_activate() {
    $nowMailSettings = array();
    $nowMailSettings["enable"] = "1";
    $nowMailSettings["from"] = "";
    $nowMailSettings["fromname"] = "";
    $nowMailSettings["host"] = "";
    $nowMailSettings["smtpsecure"] = "";
    $nowMailSettings["port"] = "";
    $nowMailSettings["smtpauth"] = "yes";
    $nowMailSettings["username"] = "";
    $nowMailSettings["password"] = "";
    $nowMailSettings["deactivate"] = "";
    add_option("nowMail_settings", $nowMailSettings);
}

register_activation_hook(__FILE__, 'nowmail_activate');

//remove all option in case of remove
if ($nowMailSettings["deactivate"] == "yes") {
    register_deactivation_hook(__FILE__, create_function('', 'delete_option("nowMail_settings");'));
}
//admin section
if (is_admin()) {
    require_once('admin/nowmail-functions.php');
}
