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

### Site building
1. Fork this repo & clone your forked repository.
2. Install Drupal and tie it to a database on your local environment.
3. Create a Content Type called "Lessons" with the following fields:
    - Description
    - Start Time & End Time
    - Useful Links
4. Create a couple of nodes of type "Lessons" (5-10 should suffice)
5. Create a view (page or block) in which to display the nodes based on the following:
    - Display fields: Title, Description, Author, Author Picture, Start Time & End Time
    - Sort result from newest to oldest
    - Add a filter option for Start Time & End Time
    - Add pagination and only display 5 elements per page
6. Install & Enable a couple of modules you think are useful onto your site (2-3 should suffice)
### Theming
7. Install & Enable a bootstrap theme
8. Create a subtheme which will extend the aboce mentioned bootstrap theme
9. Define regions so that you page will only have:
    - Header
    - Content
    - Footer
10. Style the /user/login form.
### Module Development
11. Create a custom module structure. You are free to name your module whatever you want.
    - Create a Controller in which to display, programatically, the current Day, Date, Month & Year
    - Restrict Controller access only to admin
    - Create a custom block and display it on the front page
    - Try to inject a service (let's say current path or current user) into your controller
12. Create an Admin Form programatically

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
