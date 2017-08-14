<?php
if(isset($_POST['nowmail_send_mail']) && $_POST['nowmail_send_mail'] == '1'){
	$sendnowmail = isset($_POST['nowMail_settings'])?$_POST['nowMail_settings']:array();
	$request['to'] = isset($sendnowmail['sendemail'])?trim($sendnowmail['sendemail']):'';
	$request['subject'] = isset($sendnowmail['sendsubject'])?trim($sendnowmail['sendsubject']):'';
	$request['message'] = isset($_POST['nowmail-sendmessage'])?  htmlentities($_POST['nowmail-sendmessage']):'';
	echo nowmail_send_mail($request);
}
?>
<div class="wrap">
    <h2>
       <?php _e( 'Now Mail Compose Mail', 'nowmail' ); ?>
    </h2>
    <form action="" method="post">
        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="nowmail-sendemail"><?php _e( 'Email address', 'nowmail'); ?></label>
                </th>
                <td>
                    <?php ?>
                    <input name="nowMail_settings[sendemail]" placeholder="<?php _e( 'Email', 'nowmail'); ?>" type="text" id="nowmail-sendemail" class="regular-text">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="nowmail-sendsubject"><?php _e( 'Subject', 'nowmail'); ?></label>
                </th>
                <td>
                    <input name="nowMail_settings[sendsubject]" placeholder="<?php _e( 'Subject', 'nowmail'); ?>" type="text" id="nowmail-sendsubject" class="regular-text">
                </td>
            </tr>
            <tr>
                <th scope="row">
                    <label for="nowmail-sendmessage"><?php _e( 'Message', 'nowmail'); ?></label>
                </th>
                <td><?php $content = '';
                    $editor_id = 'nowmail-sendmessage';
                    wp_editor( $content, $editor_id, 'nowmail_text_editor' );?>
                </td>
            </tr>
        </table>
        <p class="submit">
			<input type="hidden" name="nowmail_send_mail" value="1">
            <input type="submit" name="send" class="button button-primary" value="<?php _e( 'Send', 'nowmail' ); ?>"/>
        </p>
    </form>
</div>