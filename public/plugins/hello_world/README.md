# Folder Structure
## /
Nothing in particular needs to go here except the `register.php` file and stray
PHP files that don't seemto fit elsewhere.

## /css
CSS Stylesheets

## /js
External Javascript `.js` files

## /img
Images

# /lang
Plugin language files

# /backend
PHP files relating to the administration panel

# /frontend
PHP files relating to the front-end user

# /lib
PHP classes, traits and interfaces
In particular, the main `GSPlugin` class (which is used for registering and
handling the plugin) is kept here. `GSPlugin` is part of the [Plugin SDK]().
