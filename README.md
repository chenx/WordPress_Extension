# WordPress_Extension
Extension to customize WordPress as website framework.

About
=====

WordPress is a popular blogging software. It has a lot of nice-looking themes. If it can be used as website framework, then we can instantly make use of it abundant themes and avoid doing a lot of user interface work.

This project aims to extend WordPress as a general website framework. It reuses WordPress's membership/login system, role system, and themes. It then provides logged-in user page templates for different themes. Logged-in user page templates use current theme's header and footer, get logged-in user's identity and profile from WordPress built-in API, thus allow creating any custom pages and functions.

This project is based on WordPress version 4.3.


Issues to address
=================

For this purpose, one should be able to create custom roles (user groups), members of such roles may or may not be able to post blogs, but can access custom pages once log in. Several things are crucial:

1) create custom role(s).  
2) check if a user is logged in, and access user profile such as ID, login name, user name, email, user type. Based on this, one can add custom database tables and build whatever function that is desired.  
3) make use of WordPress theme in custom page.  

A study on these requirements proves fruitful. Over the past week, I was able to build a member page for 7 WordPress themes. It's very easy to extend to more themes, by taking from ten minutes to one hour.


How to use templates in this project
====================================

The projects contains a series of folders member_[theme]. Each folder is for a different theme. Right now the available themes include:

- albar
- bubbly
- flatio
- klean
- twenty thirteen
- twenty fourteen
- twenty fifteen

Albar is the theme that I started with this project. Therefore it contains more files than the rest. The other theme template folders contain:

- index.php 
- admin_bar.php
- (optional) README

But the albar theme template folder contains more files for development and experiment purposes.

In order to use the templates, follow these steps:

- Copy the theme template folder(s) to your WordPress installation root  
- In WordPress dashboard, go to Appearance -> themes, active your theme, say "albar".  
- In WordPress dashboard, go to Appearance -> Menus, in "Custom Links" panel, create a new link: 
  - URL: [site_url]/member_albar, Link Text: "Member"
  - this will appear in the "Menu Structure" panel.
  - Note: if the "Member" link already exists, you can just update its URL.
- Now visit your WordPress homepage, click on "Member" link, it'll bring you to the custom page.

That's all.


Implementation: Basics
======================

This section introduces the basics of the basics, by answer the three questions above, on how to make the minimal functions work.

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

3) Use WordPress theme in custom page.

This is easily done by including functions get_header() and get_footer().

Thus a minimal complete page template is:

```php
<?php
$SITE_ROOT = ".."; // change this accordingly.

require("$SITE_ROOT/wp-load.php");
get_header();


if (is_user_logged_in()){
    echo "<p>Welcome, registered user!</p>";
    showUserInfo();
}
else {
    echo "<p>Welcome, visitor!</p>";
    echo "<a href='$SITE_ROOT/wp-login.php'>Login</a>";
    echo " | <a href='$SITE_ROOT/wp-login.php?action=register'>Register</a>";
};


get_footer();


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
        var_dump($current_user);
    }
}
?>
```


Implementation: More Details
============================

After readnig the above section, you can make the basics work. But the custom page will still be very different from other pages in WordPress. For example, the content layout is totally different, or how about the sidebar?

This section introduces more details on how to make the nuts-and-bots work. 

### 1) Page layout

To make your custom page template user interface matching other pages of the current theme, in general, you will need to tweak the template html/css a bit.

There are two places you can look for help.

a) /wp-content/themes/[theme_directory]/page.php   
The page.php file contains the basic layout of a page of the current theme. 

b) The default first blog page.    
Check the source code of the page.


### 2) Sidebar

You may or may not want to include the sidebar for your custom page. Many of the time you want to use the entire space estate for custom functions and do not need the sidebar.

However, if you want to include sidebar, you can simply use:

```php
get_sidebar();
```

But the location of calling the function will depend on the specific theme. 

Note that if you do not use sidebar, the content div may not span the entire page width. To make the content div wider, you can add attribute "style='width:100%;'" to the content div.


### 3) Admin_bar (Toolbar)

The Admin_bar (Toolbar) is a dark bar at the top of page, which provides nagivation to WordPress functions (Site dashboard and navigation, post functions etc.) and current user functions (links to profile, logout). It is independent from themes, and is built-in WordPress. 

For me, since a custom page does not need many of WordPress' build in functions, I extracted the Admin_bar's source code, modified it and stored it in theme template folders. That is the admin_bar.php file in this project's templates.
admin_bar.php is included in the index.php template file.

The Admin_bar will appear on every page one the user is logged in. If you have your customized navigation, and do not want Admin_bar, you can disable it and make it disappear by this:

In /wp-content/themes/[theme_directory]/function.php, add this to the end of the file:

```php
show_admin_bar(false);
```

There are abundant online document for more details on this.

### 4) Allow user to register

By default WordPress does not allow user register, only admin can add user.

To enable user register, go to WordPress dashboard -> "Settings" -> "General", and check "Membership: Anyone can register".


### 5) Customize default redirect after login.

By default, after log into WordPress, the user is redirected to dashboard. When you provide Login link on "Member" page, and want the user to redirected to the Member page once logged in, you can do this:

```php
echo "<a href='" . wp_login_url( "member_albar" ) . "'>Login</a>";
```

Or you can hardcode it in html as:

```html
<a href="/wp-login.php?redirect_to=member_albar">Login</a>
```

### 6) Disable "Comments" on a WordPress blog page.

If you use a WordPress blog post as "About" or similar page, you can disable the page's comment function by:

On Edit Page, click Screen Options and check the Discussion box. Then in Discussion section, uncheck "Allow comments". 

### 7) To customize default user registeration email, see [4]. 


Implementation: Create new templates
====================================

Now you want to roll out templates for your desired themes, the following are instructions and tips on how.

First of all, you can copy an existing template in this project, and start from it.

Second, different themes will use different page layouts. You can find out by checking a) /wp-content/themes/[theme_directory]/page.php, or b) an example page of this theme. Then you apply these to your index.php and admin_bar.php. This can include the specific javascript and css files for your theme, and page div's for your theme's page layout.

More tweaking may be needed sometimes. 

For example, a blog page of WordPress may contain this body tag:

```html
<body class="page page-id-2 page-template-default logged-in admin-bar no-customize-support">
```

But for your custom page, the body tag will be like this (generated in get_header() function):

```html
<body class="logged-in admin-bar no-customize-support">
```

Missing 3 classes "page", "page-id-2", "page-template-default" may or may not produce user interface difference. If they do, you may either find out those missing css definitions and include them in your index.php, or you may want to include the code below at the end of index.php, to trigger css changes after the page is loaded:

```html
<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // Note probably not all classes are needed, so test and comment out unnecessary ones.
    $('body').addClass('page');
    $('body').addClass('page-id-2');
    $('body').addClass('page-template-default');
});
</script>
```


Future work
===========

More considerations can include:

- Use a "Login" link instead of "Member".
  - Issue: but then since the WordPress menu keeps the same after logged in, how to hide/change the "Login" text?
- Use of multi-level menu.
- Customize register email.
- Hide Admin_bar, then how to provide custom nagivation alternative?
- How to allow social media register?
  - [14] seems to provide some clue, but needs more investigation.



Summary
=======

This project:

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


License
=======

Apache/BSD/MIT/GPLv2


Author
======

X. Chen  
Created On: August 21, 2015  
Last Modified: August 26, 2015  


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
[14] https://wordpress.org/plugins/miniorange-login-openid/
[14] https://www.google.com/search?q=use+wordpress+as+cms&ie=utf-8&oe=utf-8#q=wordpress+custom+php+page  
[15] https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet


