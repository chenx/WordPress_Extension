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

 - http://codex.wordpress.org/Function_Reference/wp_get_current_user
 - https://web-design-weekly.com/snippets/load-a-different-header-in-wordpress/
 - http://www.wpbeginner.com/beginners-guide/how-to-allow-user-registration-on-your-wordpress-site/
 - https://wordpress.org/plugins/welcome-email-editor/
 - https://wordpress.org/plugins/members/
 - wordpress - redirect to target page after log in 
