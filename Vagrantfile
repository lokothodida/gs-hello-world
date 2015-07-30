# -*- mode: ruby -*-
# vi: set ft=ruby :

ip_address = "192.168.33.10"
project_name = "get-simple"

Vagrant.configure("2") do |config|

    #config.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=666"] }

    config.hostmanager.enabled = true
    config.hostmanager.manage_host = true
    config.vm.define project_name do |node|
      node.vm.box = "scotch/box"
      node.vm.network :private_network, ip: ip_address
      node.vm.hostname = project_name + ".local"
      node.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=666"] }
      node.hostmanager.aliases = [ project_name + ".dev" ]
    end

end
