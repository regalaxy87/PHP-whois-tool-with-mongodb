# whois-finder-mongodb
#1-Step : Server Configuraion : CentOS 6.7 x64


NOTE : Please change whois-finder.com to your domain name

1 - Nginx and PHP-FPM : 


sudo yum install epel-release
sudo yum install nginx -y
sudo yum install php-fpm -y
sudo vi /etc/php.ini

Find the line, cgi.fix_pathinfo=1, and change the 1 to 0.

cgi.fix_pathinfo=0



2- add your domain with SSL cert : 

sudo vi /etc/nginx/conf.d/default.conf


server {
       listen    	80;
       server_name 	whois-finder.com *.whois-finder.com;
       return 301 	https://www.$server_name$request_uri;
  }
   server {

    listen    443;
	ssl    on;
	ssl_certificate    /usr/share/nginx/html/whois-finder.com/cert_chain.crt;
    	ssl_certificate_key    /usr/share/nginx/html/whois-finder.com/server.key;
	server_name whois-finder.com www.whois-finder.com;

	   if ($bad_referer) {
	    return 444;
	   }
	    if ($http_user_agent ~* LWP::Simple|BBBike|wget|curl|telnet) {
		    return 403;
	     }
    location / {

        root   /usr/share/nginx/html/whois-finder.com/;
        index index.php  index.html index.htm;
         try_files $uri $uri/ =404;
        #if (!-e $request_filename){
        rewrite ^/([^/]*)$ /whois.php?domain=$1;
       # }
    }

    error_page  404              /404.html;
    location = /404.html {
        root   /usr/share/nginx/html;
    }

    error_page   500 502 503 504  /50x.html;
    location = /50x.html {
        root   /usr/share/nginx/html;
    }

    # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    #
    location ~ \.php$ {
        root           /usr/share/nginx/html;
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param SCRIPT_FILENAME /usr/share/nginx/html/whois-finder.com$fastcgi_script_name;
        include        fastcgi_params;

    }
}

3- change group from apache to nginx : 

sudo vi /etc/php-fpm.d/www.conf

[...]
; Unix user/group of processes
; Note: The user is mandatory. If the group is not set, the default user's group
;	will be used.
; RPM: apache Choosed to be able to access some dir as httpd
user = nginx
; RPM: Keep a group allowed to write in log dir.
group = nginx
[...]


4 - Install MongoDB : 

create a file using this commad :

vi /etc/yum.repos.d/mongodb-org-3.2.repo


4- 1 : insert the following :

[mongodb-org-3.2]
name=MongoDB Repository
baseurl=https://repo.mongodb.org/yum/redhat/$releasever/mongodb-org/3.2/x86_64/
gpgcheck=0
enabled=1

4 - 2 : save the file 

4 - 3 : install mongoDB : 

sudo yum install -y mongodb-org


4 - 4 : Configure SELinux

vi /etc/selinux/config

SELINUX=disabled
Set SELinux to permissive mode in /etc/selinux/config by changing the SELINUX setting to permissive .
SELINUX=permissive


5 - Add PHP Mongo Driver :  

yum install openssl-devel

yum -y install gcc php-pear php-devel

pear config-set php_dir /usr/lib64/php/modules

pecl install mongo

vi /etc/php.ini

add the extension : extension=mongo.so

also enable short tag : short_open_tag = On

Finally enable session php : chmod -R 777 /var/lib/php/session

6 - Restart All Services : 

service nginx restart
service php-fpm restart
service mongod restart



#2-Step : whois-finder configuration

unzip the files downloaded

1- Paypal

Your Paypal API : (to receive payment)

edit : /dashboard/pages/order_process.php

define('CLIENT_ID', 'AczIJVqg1MPK3ItForTYH_o9A-G8fIUb8nDbcoN7tPHeK2m5ec6Fu78dA-yFiuDfc_o314DP1KGcnev5'); //change it to your PayPal client ID
define('CLIENT_SECRET', 'ED8dxaMsZcwfP0FBq4Mk34GAhgozzYCMSJJBCtps4JjCMlwrykbMI0CmFN1UW_2gQNCjYVwJWZ_B0veK'); //change it to PayPal Secret


2 - Mongo Tables :

connect to your server : 

root@centos: mongo

use domain
use users
use tb_addurl
use tb_messages
use tb_payment
use tb_clicks


3 - initialize dates for premium plan :

https://www.whois-finder.com/dashboard/pages/admin/initializedates.php


4 - Demo Front End :

https://www.whois-finder.com/signin.php

email : user250@example.com
pass  : 123456



5 - Demo Back End (Admin) :

https://www.whois-finder.com/dashboard/pages/admin.php

email : admin@admin.com
pass  : admin

Google Adsense
