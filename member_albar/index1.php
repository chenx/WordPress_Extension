<?php
require("../wp-load.php");

//define('WP_USE_THEMES', false);
//require('../wp-blog-header.php');
//include("../wp-content/themes/albar/header.php");
get_header();
//include_once("../wp-includes/admin-bar.php");
//show_admin_bar( true );
//echo is_admin_bar_showing(); // 1
//echo function_exists("show_admin_bar"); // 1
//get_sidebar();
//get_template_part('pageheader');
?>

    <div class="page-header">
        <div class="site-container">
            <h1>Member</h1>
            <div class="cx-breadcrumbs">
                                    
                            </div>
            <div class="clearboth"></div>
        </div>
    </div>

<style type="text/css" media="screen">
/* For the underline under menu item. */
.current-menu-item a {
    border-bottom: 2px solid #4965A0;
}
</style>


<div style="margin: 20px;">

<?php  
if (is_user_logged_in()){
    echo "<p>Welcome, registered user!</p>";
    showUserInfo();
    include("admin_bar.php");
}
else {
    echo "Welcome, visitor!";
?>

<div style="margin: 20px;">
<a href="../wp-login.php"><span style="color: red;">Login</span></a> |
<a href="../wp-login.php?action=register"><span style="color: red;">Register</span></a>
</div>

<?php
    // header( 'Location: http://www.mysite.com/blog/wp-login.php' ) ;
};
?>

</div><!-- end of content -->

<?php
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
