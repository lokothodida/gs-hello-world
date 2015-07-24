<?php

// This script is executed when an admin accesses your plugin from the admin
// panel. As this is a very simple example, all it will do is display a message
// on the page (albeit sensitive to the language of the installation).
// The GSPlugin class executes this script and imports a variable named @plugin
// which allows you to access all of the methods that you would have from your
// GSPlugin instance. This allows us to use the @i18n method like so:

?>
<p><?php echo $plugin->i18n('HELLO_WORLD_ADMIN'); ?></p>
