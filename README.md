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

In order to create custom roles, install the Members plugin [5].


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
[12] http://www.wpmayor.com/roles-capabilities-wordpress/   <====
[13] http://codex.wordpress.org/Theme_Development  
[14] https://www.google.com/search?q=use+wordpress+as+cms&ie=utf-8&oe=utf-8#q=wordpress+custom+php+page  
