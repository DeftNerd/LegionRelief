# config valid only for Capistrano 3.1
lock '3.4.0'

set :application, 'larabrain.com'
set :repo_url, 'git@github.com:wjgilmore/larabrain.git'

# Default branch is :master
# ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }.call

# Default deploy_to directory is /var/www/my_app
set :deploy_to, '/home/wjgilmorecom/larabrain.com'

set :tmp_dir, '/home/wjgilmorecom/tmp'

# Default value for :scm is :git
set :scm, :git

# Default value for :log_level is :debug
set :log_level, :debug

# Default value for keep_releases is 5
set :keep_releases, 3

namespace :deploy do

  desc "Build"
  after :updated, :build do
      on roles(:app) do
          within release_path  do
            execute :composer, "install --no-dev --quiet" # install dependencies
            execute :chmod, "u+x artisan" # make artisan executable
            execute "ln -nfs #{shared_path}/.env #{release_path}/.env"
            execute "rm #{release_path}/public/.htaccess"
            execute "ln -nfs #{shared_path}/.htaccess #{release_path}/public/.htaccess"
            execute :php, "artisan migrate --force" # run migrations
          end
      end
  end

  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :touch, release_path.join('tmp/restart.txt')
    end
  end

  after :publishing, :restart

  after :restart, :clear_cache do
    on roles(:web), in: :groups, limit: 3, wait: 10 do
      # Here we can do anything such as:
      # within release_path do
      #   execute :rake, 'cache:clear'
      # end
    end
  end

end
