LARAVEL_PROJECT_WORKDIR=/home/books/bookmanager
NGINX_CONF_FILE=/etc/nginx/conf.d/books.conf

cd $LARAVEL_PROJECT_WORKDIR && git checkout . && git pull origin master --rebase
# Copy the Nginx configuration file
cp $LARAVEL_PROJECT_WORKDIR/docker/nginx/prod.conf $NGINX_CONF_FILE

# migrate the database
cd $LARAVEL_PROJECT_WORKDIR && make laravel-migrate
# clear the cache
cd $LARAVEL_PROJECT_WORKDIR && make laravel-cache-clear

# restart the Nginx server
systemctl restart nginx
