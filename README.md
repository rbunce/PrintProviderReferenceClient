Introduction
============

InkRouter's PHP Print Provider Reference Client is reference for implementing a PHP service to accept and update orders from InkRouter


Requirements
============

This requires:

- PHP 5.5.x and up
- PHP5-curl

Installation
============

- Download source
- Unpack downloaded zip in any directory in your project (for example /path/to/your/project/libs/InkRouterPrintProvider)
- Setup Apache to use the /web directory

    <VirtualHost *:80>
        ServerName %insert domain used%
        ServerAlias %insert domain used%

        DocumentRoot %PATH_TO_DIR%/web

        <Directory %PATH_TO_DIR%/web>
            Options FollowSymLinks
            AllowOverride None
            Require all granted

        </Directory>
    </VirtualHost>

    <IfModule mod_ssl.c>
    <VirtualHost *:443>
        ServerName %insert domain used%
        ServerAlias %insert domain used%

        DocumentRoot %PATH_TO_DIR%/web

        <Directory %PATH_TO_DIR%/web>
            Options FollowSymLinks
            AllowOverride None
            Require all granted
        </Directory>

        #   SSL Engine Switch:
        #   Enable/Disable SSL for this virtual host.
        SSLEngine on

        #   A self-signed (snakeoil) certificate can be created by installing
        #   the ssl-cert package. See
        #   /usr/share/doc/apache2.2-common/README.Debian.gz for more info.
        #   If both key and certificate are stored in the same file, only the
        #   SSLCertificateFile directive is needed.
        SSLCertificateFile    /etc/ssl/certs/ssl-cert-snakeoil.pem
        SSLCertificateKeyFile /etc/ssl/private/ssl-cert-snakeoil.key

    </VirtualHost>
    </IfModule>

- Setup configs in /app/config/config.php from info in InkRouter portal

      'inkrouter_client_id' => '',
      'inkrouter_base_url' => '',
      'inkrouter_api_key' => ''

Workflow
==================

There exist 3 routes to Receive orders and updates and 1 route to send updates

- Route with POST to format "/order" to receive new orders
- Route with PUT to format "/order/{reference}" to receive order updates
- Route with PUT to format "/order/{reference}/status" to receive status updates
- Route to send update form "/sendUpdate"


