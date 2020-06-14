FROM suin/php533

WORKDIR /var/www/html/

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    composer require firebase/php-jwt

RUN ln -sf /var/log/httpd/access_log /var/log/httpd/error_log && ln -sf /dev/stdout /var/log/httpd/access_log

ADD entrypoint.sh /sbin/entrypoint.sh

EXPOSE 80 443

CMD /sbin/entrypoint.sh
