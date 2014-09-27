
define :apache_vhost, :action => :create, :host => nil, :public_root => nil do
  raise "Missing host for apache_vhost!" if params[:host].nil?
  raise "Missing public_root for apache_vhost!" if params[:public_root].nil?

  vhost_file = "/etc/apache2/sites-available/#{params[:host]}"
  vhost_link = "/etc/apache2/sites-enabled/#{params[:host]}"

  template vhost_file do
    cookbook 'apache2'
    source "apache_vhost.erb"
    variables({
      :host => params[:host],
      :public_root => params[:public_root],
    })
  end

  link vhost_link do
    to vhost_file
  end
end
