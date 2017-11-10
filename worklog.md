# Step 0
Install mysql-server

Install php

Install vsftpd

Install WordPress


# Step 1

Install VideoGo WP-theme

Enable debugging






## Errors & Fix

- > Fatal error: Uncaught Error: Class 'DOMDocument' not found in /data/www/wp2/wp-content/themes/videogo/functions.php:137 Stack trace: #0 /data/www/wp2/wp-content/themes/videogo/framework/videogo_functions.php(29): videogo_get_themeoption_value('videogo_footer_...', 'general_setting...') #1 /data/www/wp2/wp-content/themes/videogo/functions.php(72): include_once('/data/www/wp2/w...') #2 /data/www/wp2/wp-settings.php(424): include('/data/www/wp2/w...') #3 /data/www/wp2/wp-config.php(95): require_once('/data/www/wp2/w...') #4 /data/www/wp2/wp-load.php(37): require_once('/data/www/wp2/w...') #5 /data/www/wp2/wp-blog-header.php(13): require_once('/data/www/wp2/w...') #6 /data/www/wp2/index.php(17): require('/data/www/wp2/w...') #7 {main} thrown in /data/www/wp2/wp-content/themes/videogo/functions.php on line 137

  Fix:
  ```
  sudo apt-get install php-xml
  sudo service apache2 restart
  ```

- > Aqua-Resizer return (unknown) img url

    Fix:
    ```
    sudo apt-get install php7.0-gd
    sudo systemctl restart apache2
    ```
    
- > no enough memory

Fix:
https://www.centos.org/docs/5/html/5.2/Deployment_Guide/s2-swap-creating-file.html

## Speed up

- > Remove google fonts
// TODO

- > modify links /js/css

```
./wp-content/themes/videogo/functions.php:629:          wp_enqueue_script('videogo-js-video-player', VIDEOGO_PATH_URL.'/frontend/js/video-player.js', false, '1.0', true);


```


```
./wp-includes/script-loader.php:183:    $scripts->add( 'jquery-core', '/wp-includes/js/jquery/jquery.js', array(), '1.12.4' );
```

```
./wp-content/themes/videogo/framework/script_handler.php:163:           wp_enqueue_style('videogo_bootstrap',VIDEOGO_PATH_URL.'/frontend/css/bootstrap.css');
```