# Description
Laravel with vagrant without homestead, valet, Laradock...
Trouble shooting during start up
Try to use some function

# composer
https://getcomposer.org/download/
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer

# php - required package
sudo yum install --enablerepo=remi,remi-php73 php-pecl-zip state=latest
It was already added in the recipe file.
Ref-> https://qiita.com/don-bu-rakko/items/e0006a59d3714cecfbde

# Laravel
Ref-> https://laravel.com/docs/7.x
composer global require laravel/installer

composer global about
/home/vagrant/.config/composer/vendor/bin/laravel

sudo vi ~/.bashrc
and fox it as below
PATH=$PATH:$HOME/.local/bin:$HOME/bin:/home/vagrant/.config/composer/vendor/bin/

top page: http://192.168.33.11/laraproject/public/

- DocumentRoot
 /etc/httpd/conf/httpd.conf
DocumentRoot "/var/www/html" -> DocumentRoot "/var/www/html/laraProject/public/"
sudo systemctl restart httpd
ref -> https://qiita.com/Larkpop36/items/1991d5fd33759f3fc643


# Trouble shooting
- web page is not displayed
Apche log /var/log/httpd/error_log -> .../vendor/autoload.php is not existed
    Execute it in the project directly
    composer update
    ref-> https://mokabuu.com/it/php/%E3%80%90php%E3%80%91laravel%E3%81%A7-vendor%E4%BB%A5%E4%B8%8B%E3%81%AE%E3%83%87%E3%82%A3%E3%83%AC%E3%82%AF%E3%83%88%E3%83%AA%E3%81%8C%E8%A6%8B%E3%81%A4%E3%81%8B%E3%82%89%E3%81%AA%E3%81%84%E6%99%82

Apche log /var/log/httpd/error_log -> permission denied
    Vagrantfile 775 -> 777
    config.vm.synced_folder "./", "/var/www/html", :mount_options => ["dmode=777", "fmode=777"]

- 500 server error
Laravel log .../storage/logs/laravel.jog -> o application encryption key has been specified
cp .env.example .env
php artisan key:generate
php artisan config:clear
add .env into .gitignore
ref -> https://www.kabanoki.net/2524/
reg -> https://laravel10.wordpress.com/2015/02/13/laravel%e3%81%ae%e3%82%a4%e3%83%b3%e3%82%b9%e3%83%88%e3%83%bc%e3%83%ab/#more-13 (and other setup)

- Routing does not work
It does not work when new route is created.
Fix httpd.conf to add AllowOverride All
 /etc/httpd/conf/httpd.conf
ref -> https://qiita.com/msht0511/items/b32122413745d0a3d50a
