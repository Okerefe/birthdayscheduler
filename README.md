# Technical Test

## Getting started

In order to start your Technical Test, you will need to fork this repository.
Once forked, clone the forked version on your local machine and run:

```
composer install
```

Once composer finishes installing the dependencies, you should be able to add the Drupal site into your local development environment and tie it to a database.

The database configuration should be placed into the settings.php file located in:

``` 
docroot/sites/default/settings.php 

```

The configuration should look similar to the below options.

```
$settings['config_sync_directory'] = '../config/sync';
$settings['file_chmod_directory'] = 0775;
$settings['file_chmod_file'] = 0664;
$settings['file_public_path'] = 'sites/default/files';
$settings['file_private_path'] = 'sites/default/private';
$settings['file_temp_path'] = 'sites/default/files/tmp';
$databases['default']['default'] = [
  'database' => 'name_of_database',
  'username' => 'username_for_database',
  'password' => 'password_for_user_mentioned_above',
  'host' => 'name of host',
  'driver' => 'mysql', //If you are using mysql.
  'unix_socket' => '/Applications/MAMP/tmp/mysql/mysql.sock', //If you are using MAMP.
];
```


## Complete your tasks

You will see that the tasks range from easy to complex but do not feel discouraged as they are pretty straightforward and you will find plenty of resources out there.

## Upload the files

Use git to add your work.
We recommend you provide us with a database copy which can be placed inside the repo but is not mandatory.
Please do not forget to export your configuration files.
If you are unsure what configuration files are, please explore some of the amazing resources out there regarding this subject as configuration management is a part of day to day work as a Drupal developer.

## Share your repository with @lidius

Once you are happy with your work, please share the forked repository with @lidius.
We also recomment you send an email to your recruitment contact to let them know you are ready to be graded.

## Grading

We will get back to you with the test result as soon as we can.
Please try to solve as many of the tasks as you can.
Being unable to solve one or more of the requirements does not disqualify you.

## Best of luck!
