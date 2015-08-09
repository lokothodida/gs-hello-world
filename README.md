# GetSimple CMS "Hello World" Plugin
This plugin is a redux of the [example plugin](http://get-simple.info/wiki/plugins:creation)
provided on the GetSimple [wiki](http://get-simple.info/wiki/).

The aim of this project is to provide an example plugin with the same
functionality as its predecessor, but with:

* Full documentation
* Clearer design guidelines
* Ideal structure
* Language integration
* Avoidance of polluting the global variable/function namespace
* A portable library that acts as an [SDK](https://en.wikipedia.org/wiki/Software_development_kit) or devkit

so that plugin developers can use this example as a solid starting point for
building their own (non-trivial) plugins.

# Installation
* Download [`hello_world.php`](hello_world.php) and the
[`hello_world/`](hello_world) folder to your GetSimple
installation.
* Log into your GetSimple administration panel, go to the `Plugins` tab and
enable the `Hello World` plugin.