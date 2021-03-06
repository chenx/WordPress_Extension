# WordPress_Extension
Extension to customize WordPress as website framework.

About
=====

WordPress is a popular blogging software. It has a lot of nice-looking themes. If it can be used as website framework, then we can instantly take advantage of its versatile themes.

This project aims to extend WordPress as a general website framework in a non-invasive way. It reuses WordPress's membership/login system, role system, and themes. It provides member (logged-in user) page templates for different themes. Member page templates use current theme's header and footer, get member's identity and profile from WordPress's built-in API, thus allowing the creation of any custom functions.

This project is developed under WordPress 4.3.


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
--------------------------------------

This is easily done by including functions get_header() and get_footer().

Thus a minimal page template is:

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

For me, since a custom page does not need many of WordPress' built in functions, I extracted the Admin_bar's source code, modified it and stored it in theme template folders. That is the admin_bar.php file in this project's templates.
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

### 6) Disable "Comment" on a WordPress blog page.

If you use a WordPress blog post as "About" or similar page, you can disable the page's comment function by:

On Edit Page, click Screen Options and check the Discussion box. Then in Discussion section, uncheck "Allow comments". 

### 7) Customize user register confirmation email.

See [4]. 


### 8) Captcha

There are many Captcha plugins. "<a href="https://wordpress.org/support/view/plugin-reviews/goodbye-captcha">Goodbye Captcha</a>" seems to be a good one, which avoids spam but does not really use any captcha image, thus making the interface more clean.


### 9) Hide "Member" menu link if user is not logged in.

Of course you can dig into wordpress code and don't emit the "Member" link when the user is not logged in.

Another easy approach is to hide it using javascript like this:

```php
<?php if (! is_user_logged_in()) { ?>
<script type="text/javascript">
function hideMemLink() {
    var menu = document.getElementById('menu-menu-1'); // Use the enclosing div's id accordingly.
    if (menu === null) return;

    var nodes = menu.getElementsByTagName('li');
    for (var i = 0, n = nodes.length; i < n; ++ i) {
        var item = nodes[i];
        if (item.innerHTML.indexOf('Member') > 0) {
            item.style.display = 'none';
            break;
        }
    }
}

hideMemLink();
</script>
<?php } ?>
```

Just include this at the end of /wp-content/themes/[theme]/footer.php, then every page will do this check.

Note when you do this, the login url will be the default one of WordPress, might be in the sidebar's Meta category. The default page after login will be dashboard. If you want the default redirect page be member's homepage, you can modify file /wp-includes/general-template.php, in function wp_login_url(), change 

```php
$login_url = site_url('wp-login.php', 'login');
```

to

```php
$login_url = site_url('wp-login.php?&redirect_to=[member_homepage_url]', 'login');
```


### 10) Customize header

Function get_header() is in /wp-includes/general-template.php,  
which includes: wp-includes/theme-compat/header.php,  
which calls wp_head() in turn.  
Function wp_head() is in /wp-includes/general-template.php, and calls  do_action( 'wp_head' );  
do_action() is in /wp-includes/plugin.php, which then is hard to trace.  

Function wp_head() is defined as:

```php
function wp_head() {
        /**
         * Print scripts or data in the head tag on the front end.
         *
         * @since 1.5.0
         */
        do_action( 'wp_head' );
}
```

To insert custom header to head section, you can define $custom_header and add to the top of function wp_head():

```php
$custom_header = '<script type="text/javascript" src="../js/jquery.min.js"></script>';
```

```php
function wp_head() {
        /**
         * For custom code.
         */
        global $custom_header;
        if ( isset($custom_header) ) { print $custom_header; }

        /**
         * Print scripts or data in the head tag on the front end.
         *
         * @since 1.5.0
         */
        do_action( 'wp_head' );
}
```


### 11) Customize footer

Similar to header, custom footer can be added to wp_footer(), which is defined in /wp-includes/general-template.php.

```php
function wp_footer() {
        /**
         * Print scripts or data before the closing body tag on the front end.
         *
         * @since 1.5.1
         */
        do_action( 'wp_footer' );
}
```

Define and add $custom_footer below, which will be right before the &lt;/body&gt; tag.

```php
function wp_footer() {
        /**
         * Print scripts or data before the closing body tag on the front end.
         *
         * @since 1.5.1
         */
        do_action( 'wp_footer' );

        /**
         * For custom code.
         */
        global $custom_footer;
        if ( isset($custom_footer) ) { print $custom_footer; }
}
```


### 12) CSS Styles

Albar has a default "vertical-align: baseline;" css setting in style.css. This causes much trouble in display, especially for floating elements in table. This can be overriden by:

```css
td  { vertical-align: middle !important; }
```

Font size of entire page can be similarly overriden:

```css
table, td, body { font-size: 12px !important; }
```

For table cellspacing: "&lt;table cellspacing=2&gt;", CSS equivalent is (see http://stackoverflow.com/questions/339923/set-cellpadding-and-cellspacing-in-css):

```css
table { 
    border-spacing: 2px;
    border-collapse: separate;
}
```

In Albar theme, hyperlinks have no text-decoration. Assume all you links are in table, then hyperlink format can be recovered by:

```css
table a {
    color: blue !important;
    text-decoration: underline !important;
}
```


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

Or you could add the classes in pure javascript [15]:

```html
<script type="text/javascript">
    document.body.className += " page page-id-2 page-template-default";
    // or this:
    // document.body.classList.add("page");
    // document.body.classList.add("page-id-2");
    // document.body.classList.add("page-template-default");
</script>
```


Misc Stuff
==========

- WordPress configurations are in: /wp-config.php
  - from here you can get database name/user/password etc.

- WordPress database tables are named as: wp_[table_name].
  - it could be like wp_[key]_[table_name], e.g., on a bluehost installation.

- WordPress tables include:

 | Tables_in_wordpress (total 11)  |
 |---------------------------------|
 | wp_commentmeta             |
 | wp_comments                |
 | wp_links                   |
 | wp_options                 |
 | wp_postmeta                |
 | wp_posts                   |
 | wp_term_relationships      |
 | wp_term_taxonomy           |
 | wp_terms                   |
 | wp_usermeta                |
 | wp_users                   |

- WordPress options are stored in wp_options.

- A theme is stored in wp_options like this:  

 | option_id | option_name      | option_value             | autoload |
 |-----------|------------------|--------------------------|----------|
 |       165 | theme_mods_albar |  (see below for value)   | yes      |
  
  - where option_value is like: a:2:{i:0;b:0;s:18:"nav_menu_locations";a:2:{s:7:"primary";i:2;s:9:"main-menu";i:2;}}

- wp_options rows relevant to theme are:

 | option_name                   |
 |-------------------------------|
 | template                      |
 | stylesheet                    |
 | _site_transient_theme_roots   |
 | current_theme                 |
 | _site_transient_update_themes |

  - template, sytelsheet and current_theme values are the name of the current theme.

- Users are stored in wp_users. 

- User role is stored in wp_usermeta as wp_user_level, with a value from 0 to 10.
  - Another relevant field is in table wp_options: wp_options.wp_user_roles

- To change theme template, go to /wp-content/themes/[theme].
  - To change homepage, modify home.php
  - To change header/footer, modify header.php and footer.php
  - For page layout, check page.php
  - For more about a theme, read README.txt

- Move WordPress to another folder.

  There is no need to backup entire site and move things. A simple, light-weight procedure is [16]:

  1. Go to admin panel: Settings > General
  2. Change the two URI addresses, click on "Save Changes". This will show an error page, but it's fine.
  3. Open your SSH/FTP client (or other site admin tool) and move the WP folder
  4. Now open your blog at the new location, go to Settings > General, click on "Save Changes".
  5. Go to Settings > Permalinks, click on "Save Changes", this is supposed to recreate all .htaccess rules.

- Add social media share function. 

  The simple script to insert for the sharing panel can be obtained from [17]. It just needs to insert this script anywhere between the body tags in your site.

  Say you are using the twenty twelve theme, just edit this file: /wp-content/themes/twentytwelve/footer.php
Add the script before the close body tag. That's all.

- Add custom menu
  - One way is to modify /wp-content/themes/[theme]/header.php, and add custom menu here. 
  - In theory you can do anything with the menu here.
  - If using this menu, then you can disable WordPress menu.
    - in dashboard, Appearance -> Menus -> Menu Structure, and click on "Delete Menu".

- Customize user register email
  - can change /wordpress/wp-includes/pluggable.php function wp_new_user_notification(). See [18].
  - for multiple site, seems should use: wpmu_signup_user_notification [18]
  - there are also some plugins to customize email format, like in nice html format.
  
- Popular WordPress plugins. See [19].


WordPress bugs
==============

- In admin dashboard "Comments" page, click on "Screen Options" on upper right corner, "Number of items per page" can be as high as 999. But then if you try to apply a "Bulk Action", it's report error: "Request-URI Too Large: The requested URL's length exceeds the capacity limit for this server".


Future work
===========

More considerations:

- Use of multi-level menu.
  - One way is in "Misc Stuff" above.
- Use a "Login" link instead of "Member".
  - Issue: but then since the WordPress menu keeps the same after logged in, how to hide/change the "Login" text?
  - If use custom menu as in "Misc Stuff" above, this is not a problem.
- Hide Admin_bar, then how to provide custom nagivation alternative?
  - If use custom menu as in "Misc Stuff" above, this is not a problem.
- How to allow social media register?
  - [14] seems to provide some clue, but needs more investigation.
- User profile
  - Right now register only needs username, email and password.
  - User can be asked to provide more profile details later.


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
Last Modified: August 27, 2015  


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
[15] http://stackoverflow.com/questions/507138/how-do-i-add-a-class-to-a-given-element   
[16] http://wordpress.org/support/topic/moving-wordpress-to-another-folder   
[17] http://jiathis.com/   
[18] http://wordpress.stackexchange.com/questions/15304/how-to-change-the-default-registration-email-plugin-and-or-non-plugin   
[19] http://www.webnethosting.net/top-10-recommended-and-must-have-wordpress-plugins/   
[20] https://www.google.com/search?q=use+wordpress+as+cms&ie=utf-8&oe=utf-8#q=wordpress+custom+php+page   
[21] https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet   


