<?php
$request = $_POST;
echo nowMail_validate_options($request);
global $nowMailSettings;
?>
<div class="wrap">
    <h2>
		<?php _e( 'Now Mail Settings', 'nowmail' ); ?>
    </h2>
    <form action="" method="post" enctype="multipart/form-data" name="nowmail_form">
        <table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="nowmail-from"><?php _e( 'From', 'nowmail' ); ?></label>
				</th>
				<td>
					<input type="text" id="nowmail-from" name="nowmail_from" value="<?php echo $nowMailSettings["from"]; ?>" class="regular-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="nowmail-fromname"><?php _e( 'From Name', 'nowmail' ); ?></label>
				</th>
				<td>
					<input type="text" id="nowmail-fromname" name="nowmail_fromname" value="<?php echo $nowMailSettings["fromname"]; ?>" class="regular-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="nowmail-host"><?php _e( 'SMTP Host', 'nowmail' ); ?></label>
				</th>
				<td>
					<input type="text" id="nowmail-host" name="nowmail_host" value="<?php echo $nowMailSettings["host"]; ?>" class="regular-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="nowmail-smtpsecure"><?php _e( 'SMTP Secure', 'nowmail' ); ?></label>
				</th>
				<td>
					<select class="" name="nowmail_smtpsecure" id="nowmail-smtpsecure">
						<option value="" <?php if ( $nowMailSettings["smtpsecure"] == '' ) { ?> selected="selected"<?php } ?>><?php _e( 'None', 'nowmail' ); ?></option>
						<option value="ssl" <?php if ( $nowMailSettings["smtpsecure"] == 'ssl' ) { ?> selected="selected"<?php } ?>><?php _e( 'SSL', 'nowmail' ); ?></option>
                        <option value="tls" <?php if ( $nowMailSettings["smtpsecure"] == 'tls' ) { ?> selected="selected"<?php } ?>><?php _e( 'TLS', 'nowmail' ); ?></option>
                        <option value="tls/ssl" <?php if ( $nowMailSettings["smtpsecure"] == 'tls/ssl' ) { ?> selected="selected"<?php } ?>><?php _e( 'TLS/SSL', 'nowmail' ); ?></option>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="nowmail-port"><?php _e( 'SMTP Port', 'nowmail' ); ?></label>
				</th>
				<td>
					<input type="text" id="nowmail-port" name="nowmail_port" value="<?php echo $nowMailSettings["port"]; ?>" class="regular-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="nowmail-auth-yes"><?php _e( 'SMTP Authentication', 'nowmail' ); ?></label>
				</th>
				<td>
					
					<label for="nowmail-auth-yes">
						<input id="nowmail-auth-yes" name="nowmail_smtpauth" type="radio" value="yes" <?php if ( $nowMailSettings["smtpauth"] == 'yes' ) { ?> checked="checked"<?php } ?> />
						<?php _e( 'Yes', 'nowmail' ); ?>
					</label>&nbsp;
					<label for="nowmail-auth-no">
						<input id="nowmail-auth-no" name="nowmail_smtpauth" type="radio" value="no" <?php if ( $nowMailSettings["smtpauth"] == 'no' || $nowMailSettings["smtpauth"] == '' ) { ?> checked="checked"<?php } ?> />
						<?php _e( 'No', 'nowmail' ); ?>
					</label>
					
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="nowmail-username"><?php _e( 'Username', 'nowmail' ); ?></label>
				</th>
				<td>
					<input type="text" id="nowmail-username" name="nowmail_username" value="<?php echo $nowMailSettings["username"]; ?>" class="regular-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="nowmail-password"><?php _e( 'Password', 'nowmail' ); ?></label>
				</th>
				<td>
					<input type="password" id="nowmail-password" name="nowmail_password" value="<?php echo $nowMailSettings["password"]; ?>" class="regular-text" />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="nowmail-deactivate"><?php _e( 'Delete Options', 'nowmail' ); ?></label>
				</th>
				<td>
					<input type="checkbox" id="nowmail-deactivate" name="nowmail_deactivate" value="yes" <?php if ( $nowMailSettings["deactivate"] == 'yes' ) {
			echo 'checked="checked"';
		} ?> />
					<label for="nowmail-deactivate"><?php _e( 'Delete options while deactivate this plugin.', 'nowmail' ); ?></label>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="hidden" name="nowmail_update" value="update" />
			<input type="submit" class="button-primary" name="Submit" value="<?php _e('Save Changes'); ?>" />
		</p>
	</form>
</div>