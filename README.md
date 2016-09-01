The application
============================

This is a php command line application lists the amount of banner ads for the user whose email adress is modulebugbear@randomthings.com. The list is grouped by date.


Configuration
------------

The only required configuration is founded in MyPDO.php file.
```php
    const PARAM_host='localhost';
    const PARAM_port='3306';
    const PARAM_db_name='goldman';
    const PARAM_user='root';
    const PARAM_db_pass='';
```


Using
------------

To run application use the following command in the command line inside the application folder.
```command line
    php App.php
```