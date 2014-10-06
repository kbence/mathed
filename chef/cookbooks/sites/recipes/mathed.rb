apache_vhost do
  host 'mathed.dev'
  public_root '/var/www/mathed/webroot'
end

# db patching

execute 'patch database' do
  command <<-EOF
    cd /var/www/mathed && php tools/dbpatcher/dbpatcher.php
  EOF
end
