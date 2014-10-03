package 'mysql-server'
package 'mysql-client'

databases = node['database']['mysql']['databases']
users = node['database']['mysql']['users']

def mysql_query(sql)
end

databases.each do |db|
    execute "create database #{db}" do
        command <<-EOF
            echo "CREATE DATABASE IF NOT EXISTS #{db}" | mysql
        EOF
    end
end

users.each do |user|
    username = user['username']
    password = user['password']
    databases = user['databases']

    execute "create user #{username}" do
        command <<-EOF
            echo "CREATE USER '#{username}' IDENTIFIED BY '#{password}'" | mysql
        EOF

        not_if <<-EOF
            echo "SELECT user FROM mysql.user WHERE user = '#{username}'" | sudo mysql | tail -n +2 | grep #{username}
        EOF
    end

    if databases.class == Array
        databases.each do |db|
            execute "grant access on #{db} to #{username}" do
                command <<-EOF
                    echo "GRANT ALL ON #{db}.* TO #{username}" | mysql
                EOF
            end
        end
    end
end
