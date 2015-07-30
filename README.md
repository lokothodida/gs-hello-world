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
* Download [`hello_world.php`](public/plugins/hello_world.php) and the
[`hello_world/`](public/plugins/hello_world) folder to your GetSimple
installation.
* Log into your GetSimple administration panel, go to the `Plugins` tab and
enable the `Hello World` plugin.

# Using the Development Environment
## Installation
1. Install [VirtualBox](https://www.virtualbox.org/)
2. Install [Vagrant](https://www.vagrantup.com/)
3. Install [Vagrant Host Manager](https://github.com/smdahlen/vagrant-hostmanager)
by running:

    ```
    $ vagrant plugin install vagrant-hostmanager
    ```

4. Clone this repository to any desired folder:

    ```
    $ git clone https://github.com/lokothodida/gs-hello-world
    ```

5. Go into the directory and checkout the `php-5.3` branch:

    ```
    $ cd gs-hello-world
    $ git checkout php-5.3
    ```

## Usage

1. In the cloned folder, run `vagrant up`
2. Go to `get-simple.dev/` in your browser to see the development site. Log into
the admin panel at `get-simple.dev/admin/` with username `admin` and password `demo123`
3. Test out the plugin(s).
4. To turn off the VM, run `vagrant halt`. To destroy the VM, run `vagrant destroy`.
