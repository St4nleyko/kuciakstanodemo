Laravel 9 required versions
Node: '^14.18.0 || >=16.0.0'  for vitejs
PHP 8+


after downloading repo, create .env and accordingly add configs
commands to be run for installation
1 install dependencies
composer install
2 update dependencies
composer update
3 node packages
npm install
4 unique appkey
php artisan key:generate
5 if needed, connect to git repository
  git init
  git add.
  git commit -m 'nameofcommitmessage'
  git remote add origin https://github.com/username/new_repo
  git push -u origin master



To run:
php artisan migrate
php artisan serve
npm run dev



additional info :
on Migration : user is created with superAdmin role -- for credentials contact developers
additional role admin is created for admins of the website who can manage users -> this role must be assigned by superAdmin
