# Hello World Example Plugin
This is an example plugin that illustrates the following:

* Registering a plugin
* Registering plugin hooks/actions
* Making your plugin language-internationalizable with the GetSimple core

The `../hello_world.php` file creates a [closure](http://php.net/manual/en/functions.anonymous.php) to protect the plugin's variable
declarations, and `includes` the `index.php` file.

`index.php` declares variables and helper methods, and then registers the plugin
and its actions.

`/lang/` contains the language files for the plugin.

Check out the fully documented source code for [`index.php`](index.php).
