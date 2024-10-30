<?php

function _livechat_helper_siteid_created_info()
{
	echo '<div class="updated installed_ok"><p><strong>Your live chat site id has been created! Please install the <a href="http://www.live2support.com/downloads/" target="_blank">Live2support live chat application</a> and start chatting!</strong></p></div>';
}


function _livechat_helper_l2scode_info()
{
		if (is_active_widget (null, 'l2s_widget', true))
		{
			echo '<div class="updated info installed_ok"><p><strong>Your live chat button is installed properly. <span class="help">(<a href="widgets.php">manage widgets</a>)</span> </strong></p></div>';
		}
		else
		{
			// Check if theme supports Widgets
			if (LIVECHAT_WIDGETS_ENABLED)
			{
				echo '<div class="updated info"><p><strong>To install your live chat button, go to <a href="widgets.php">Widgets</a> page.  </strong></p></div>';
			}
			else
			{
				echo '<div class="updated info"><p><strong>To install your live chat button, <a href="?page=livechat_chat_button">click here</a>.  </strong></p></div>';
			}
		}
}

function _livechat_helper_saved_info()
{
	if (isset($_GET['updated']))
	{
		echo '<div class="updated"><p><strong>Settings saved.</strong></p></div>';
	}
}

function _livechat_settings()
{
?>
<div class="wrap">
<h2>Live chat software for Wordpress</h2>

<?php
if (get_option('livechat_siteid_created_flag') == '1')
{
	delete_option('livechat_siteid_created_flag');
	_livechat_helper_siteid_created_info();
	//_livechat_helper_monitoring_code_info();
	_livechat_helper_l2scode_info();
}
else
{
	//_livechat_helper_monitoring_code_info();
	_livechat_helper_l2scode_info();
	_livechat_helper_saved_info();
}
?>
<div class="metabox-holder" id="livechat_already_have" style="display:block">
	<div class="postbox">
	<h3>Download application</h3>
	<div class="postbox_content">
	<p>Download the live chat application and start chatting with your customers!</p>
	<p><a href="http://www.live2support.com/downloads/" target="_blank" class="awesome blue">Download application</a></p>
	</div>
	</div>
</div>

<?php 
}
?>