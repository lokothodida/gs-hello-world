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
You can use this repository as a development environment to test this plugin and
any that you develop. It comes with:

* PHP 5.5+
* GetSimple 3.3.6 (`username: admin`, `password: demo123`)

You will not need to set up a development server on your native machine (e.g.
a LAMP/WAMP stack) if you use this environment.

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

## Troubleshooting

### Ubuntu/Debian
* If your terminal gives you this message:
    ```
    It appears your machine doesn't support NFS, or there is not an
    adapter to enable NFS on this machine for Vagrant. Please verify
    that `nfsd` is installed on your machine, and try again. If you're
    on Windows, NFS isn't supported. If the problem persists, please
    contact Vagrant support.
    ```
    Then make sure that you have the `nsf-common` installed:

    ```
    sudo apt-get install nfs-common
    ```

## Thanks
* [GetSimpleCMS](https://github.com/GetSimpleCMS/) for the great CMS
* [scotch-io](https://github.com/scotch-io/) for the [Scotch Box](https://github.com/scotch-io/scotch-box) Vagrant setup
