include_recipe 'php::pear'

execute 'phing install' do
    command <<-EOF
        pear channel-discover pear.phing.info
        pear install phing/phing
    EOF

    not_if 'which phing'
end
