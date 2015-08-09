# Example Pages Plugin
This is an example plugin that illustrates the following:

* Registering a plugin
* Registering plugin hooks/actions
* Making your plugin language-internationalizable with the GetSimple core
* Creating and saving multiple files of data
* Creating an interactive admin form
* Displaying success/error messages in the admin panel
* Displaying custom front-end pages

The `../example_pagess.php` file creates a [closure](http://php.net/manual/en/functions.anonymous.php) to protect the plugin's variable
declarations, and `includes` the `index.php` file.

`index.php` declares variables and helper methods, and then registers the plugin
and its actions.

`/lang/` contains the language files for the plugin.

Check out the fully documented source code for [`index.php`](index.php).
