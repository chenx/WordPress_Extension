# WordPress_Extension
Extension to customize WordPress for MIS development.

About
=====

This project aims to extend WordPress as a general website framework. It makes use of WordPress's membership/login system, role system, and themes. It then provide member homepage templates for different themes. Member homepages are user defined custom php pages that uses current theme's header and footer, gets current user's identity and profile from WordPress built-in API, thus allowing creating any custom pages and functions.


Movitation
==========

WordPress is a popular blogging software. It has a lot of nice-looking themes. If it can be used as website framework, then we can instantly make use of it abundant themes and avoid doing a lot of user interface work.

For this purpose, one should be able to create custom roles (user groups), members of such roles may or may not be able to post blogs, but can access custom pages once log in. Several things are crucial:

1) create custom role(s).  
2) check if a user is logged in, and access user profile such as ID, login name, user name, email, user type. Based on this, one can add custom database tables and build whatever function that is desired.  
3) make use of WordPress theme in custom page.  

A study on these requirements proves fruitful. Over the past week, I was able to build a member page for 7 WordPress themes. It's very easy to extend to more themes, by taking from ten minutes to one hour.


How-to
======

1) Create custom roles
----------------------

For WordPress roles system, see [7-12]. Basically, there are 6 built-in roles.

In order to create custom roles, install the Members plugin [5].

However, there is a limitation that each user is restricted to just one role. In a more flexible design, such as in the ASP.NET membership/role/profile system, there is a user table, a role table, and a user_role table joining the two, which allows a user to have multiple roles. A possible fix is to create custom role table and user_role table, thus implementing this capability oneself.

2) Check user login status, and obtain user profile
---------------------------------------------------

In order to use WordPress built-in API, just include the "wp_load.php" file:

```php
require($SITE_ROOT . "/wp-load.php");
```

Then you can access if a user is logged in by the function is_user_logged_in():

```php
if (is_user_logged_in()){
    showUserInfo();
}
```

Next, to access user identity and profile, use the global $current_user variable:

```php
function showUserInfo() {
    global $current_user;
    if ( isset($current_user) ) {
        echo "Login: " . $current_user->user_login . "<br/>";
        echo "ID: " . $current_user->ID . "<br/>";
        echo "Firstname: " . $current_user->user_firstname . '<br/>';
        echo "Email: " . $current_user->user_email . "<br/>";
        echo "Caps[\"administrator\"]: " . $current_user->caps["administrator"] . "<br/>";
        echo "<br/>";
        echo "var_dump(\$current_user):<br/>";
        echo "<br/>";
        var_dump($current_user); // this shows all available user profile variables.
    }
}
```



Summary
=======

 - Shows how to check if a user is logged in, and retrieval user information.
 - Shows how to include header/footer of current theme.
 - To add custom links, go to Appearance -> Menus -> Custom Links
 - To allow user register, see [3] below.
 - It seems Wordpress allows each user to have one role only. That's less flexible than .NET membership, which allows each user to have any roles.
 - To change default user registeration email, see [4].
 - To allow manage user roles, use the Members plugin [5].
 - To disable comments/discussion on a per-page basis:
 - On Edit Page, click Screen Options and check the Discussion box. Then in Discussion section, uncheck "Allow comments".
 - To add a forum, see .
 - Note: installed themes are in wp-content/themes/
 - Note: to imitate other page's layout, see theme's page.php.
 - Note: to customize page title, see wp-includes/post-template.php function get_the_title().


References
===========

[1] http://codex.wordpress.org/Function_Reference/wp_get_current_user  
[2] https://web-design-weekly.com/snippets/load-a-different-header-in-wordpress/  
[3] http://www.wpbeginner.com/beginners-guide/how-to-allow-user-registration-on-your-wordpress-site/  
[4] https://wordpress.org/plugins/welcome-email-editor/  
[5] https://wordpress.org/plugins/members/  
[6] <a href="http://codex.wordpress.org/Function_Reference/wp_login_url">wordpress - redirect to target page after log in</a>  
[7] https://codex.wordpress.org/Roles_and_Capabilities  
[8] http://torquemag.io/5-wordpress-plugins-manage-user-roles/  
[9] http://stackoverflow.com/questions/12992650/wordpress-plugin-for-authentication-and-authorization  
[10] http://www.paulund.co.uk/handling-wordpress-user-roles  
[11] http://stackoverflow.com/questions/8413560/wordpress-add-custom-roles-as-well-as-remove-default-roles  
[12] http://www.wpmayor.com/roles-capabilities-wordpress/   
[13] http://codex.wordpress.org/Theme_Development  
[14] https://www.google.com/search?q=use+wordpress+as+cms&ie=utf-8&oe=utf-8#q=wordpress+custom+php+page  
