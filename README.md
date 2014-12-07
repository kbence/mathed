MathED online TeX editor
========================

Installation
------------

### Prerequisites

* Unix-based operating system
* ImageMagick
* Apache 2
* MySQL
* PHP 5+ w/ mysql libraries
* (La)Tex distribution (e.g. tex-live)

### Setting up

Clone the mathed repository somewhere.

    $ git clone https://github.com/kbence/mathed.git

Create a vhost similar to the following:

    <Virtualhost *:80>
        ServerName example.com
        DocumentRoot MATHED_ROOT/webroot
    </VirtualHost>

where ```MATHED_ROOT``` is the root directory of the

Set up MySQL with a new database, create a user with a password.

```sql
CREATE DATABASE mathed;
CREATE USER `mathed`%`localhost` IDENTIFIED BY 'strong password';
```

Copy and edit ```config.example.json```, change the MySQL database, username and password.

Reload Apache to activate the new configuration.
