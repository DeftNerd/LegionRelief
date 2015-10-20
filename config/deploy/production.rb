role :app, %w{wjgilmorecom@larabrain.com}
role :web, %w{wjgilmorecom@larabrain.com}
role :db,  %w{wjgilmorecom@larabrain.com}

set :ssh_options, {
    forward_agent: true,
    auth_methods: %w(publickey),
    user: 'wjgilmorecom'
}
