# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
    config.vm.box = "precise64"
    config.vm.box_url = "http://files.vagrantup.com/precise64.box"

    config.vm.synced_folder '.', '/var/www/mathed',
        :owner => 'vagrant',
        :group => 'www-data',
        :mount_options => ['dmode=775,fmode=664']

    config.vm.network :private_network, :ip => '192.168.10.100'
    config.vm.network :forwarded_port, :host => 8080, :guest => 80
    config.vm.network :forwarded_port, :host => 3306, :guest => 3306

    config.vm.provision :chef_solo do |chef|
        chef.cookbooks_path = "chef/cookbooks"
        chef.roles_path = "chef/roles"

        chef.add_role "database"
        chef.add_role "web"

        config = JSON.parse(File.read("#{__dir__}/config.json"))

        chef.json = {
            'database' => {
                'mysql' => {
                    'users' => [{
                        'username' => config['mysql']['username'],
                        'password' => config['mysql']['password'],
                        'databases' => [config['mysql']['database']]
                    }],
                    'databases' => [
                        config['mysql']['database']
                    ]
                }
            }
        }
    end
end
