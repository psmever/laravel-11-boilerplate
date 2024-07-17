#!/bin/bash

line=$(head -n 1 /etc/hosts)
line2=$(echo $line | awk '{print $2}')
#echo "$line $line2.localdomain" >> /etc/hosts

sed -i -e 's/^file_uploads =.*/file_uploads = On/' \
           -e 's/^allow_url_fopen =.*/allow_url_fopen = On/' \
           -e 's/^short_open_tag =.*/short_open_tag = On/' \
           -e 's/^memory_limit =.*/memory_limit = 256M/' \
           -e 's/^cgi.fix_pathinfo =.*/cgi.fix_pathinfo = 0/' \
           -e 's/^upload_max_filesize =.*/upload_max_filesize = 10240M/' \
           -e 's/^post_max_size =.*/post_max_size = 10240M/' \
           -e 's/^max_execution_time =.*/max_execution_time = 360/' \
           -e 's/^;date.timezone =.*/date.timezone = Asia\/Seoul/' \
           /etc/php/8.2/fpm/php.ini
