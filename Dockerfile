FROM alpine:3.18
MAINTAINER yes!nteractive - https://github.com/yesinteractive/mocktainer

# Install modules and updates
RUN apk update \
    && apk --no-cache add \
        openssl \
        apache2 \
        apache2-ssl \
        apache2-http2 \
        unzip \
    # Install PHP 8 from community
    && apk --no-cache add \
        php81 \
        php81-apache2 \
        php81-common \
        php81-ctype \
        php81-curl \
        php81-json \
        php81-mbstring \
        php81-opcache \
        php81-openssl \
        php81-session \
        php81-sockets \
        # If you need memcached, you'll need to install it separately
        memcached \
    && rm /var/cache/apk/* \

    # Rest of the configuration remains the same
    && sed -i -e 's/Group apache/Group www-data/g' /etc/apache2/httpd.conf \
    && sed -i -e 's/LoadModule ssl_module lib\/apache2\/mod_ssl.so/LoadModule ssl_module modules\/mod_ssl.so/g' /etc/apache2/conf.d/ssl.conf \
    && sed -i -e 's/LoadModule socache_shmcb_module lib\/apache2\/mod_socache_shmcb.so/LoadModule socache_shmcb_module modules\/mod_socache_shmcb.so/g' /etc/apache2/conf.d/ssl.conf \
    && sed -i 's/LoadModule http2_module/\#LoadModule http2_module/' /etc/apache2/conf.d/http2.conf \
    && sed -i -e 's/#LoadModule rewrite_module modules\/mod_rewrite.so/LoadModule rewrite_module modules\/mod_rewrite.so/g' /etc/apache2/httpd.conf \
    && mkdir /app && chown -R apache:apache /app \
    && sed -i -e 's/\/var\/www\/localhost\/htdocs/\/app/g' /etc/apache2/httpd.conf \
    && sed -i -e 's/\/var\/www\/localhost\/htdocs/\/app/g' /etc/apache2/conf.d/ssl.conf \
    && sed -i -e 's/Listen 80/Listen 8100/g' /etc/apache2/httpd.conf \
    && sed -i -e 's/443/8143/g' /etc/apache2/conf.d/ssl.conf \
    && mkdir /etc/apache2/conf.d/custom \
    && echo '' >> /etc/apache2/httpd.conf \
    && echo 'IncludeOptional /etc/apache2/conf.d/custom/*.conf' >> /etc/apache2/httpd.conf \
    && sed -i 's#AllowOverride None#AllowOverride All#' /etc/apache2/httpd.conf \
    && sed -i -e 's/ServerRoot \/var\/www/ServerRoot \/etc\/apache2/g' /etc/apache2/httpd.conf \
    && mv /var/www/modules /etc/apache2/modules \
    && mv /var/www/run /etc/apache2/run \
    && mv /var/www/logs /etc/apache2/logs \
    && rm -rf /var/www/* \
    && echo '<?php phpinfo(); ?>' >  /app/phpinfo.php \
    && wget https://github.com/yesinteractive/mocktainer/archive/master.zip -P /app  \
    && unzip /app/master.zip -d /app \
    && rm -rf /app/master.zip \
    && cp -r /app/mocktainer-master/. /app \
    && rm -rf /app/mocktainer-master

WORKDIR /app

# Export http and https
EXPOSE 8100 8143

# Run apache in foreground
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]