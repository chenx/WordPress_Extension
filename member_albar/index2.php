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
//get_template_part('pageheader');
?>



<style type="text/css" media="screen">
/* For the underline under menu item. */
.current-menu-item a {
    border-bottom: 2px solid #4965A0;
}

/* For left/right panels.
   From: http://cssauh.com/xc/wordpress/wp-content/themes/albar/style.css?ver=1.6.6 
*/
.content-area {
    box-shadow: 1px 0 0 #eaeaea;
    width: 74.2%;
    float: left;
    padding: 30px 20px 20px 20px;
}
.widget-area {
    margin: 0;
    padding: 25px 20px 0px 20px; /* top right bottom left */
    box-shadow: 1px 0 0 #eaeaea inset;
}
.widget {
	margin: 0 0 1.5em;
}
.widget_search input {
	border: 0 none;
    box-shadow: 0 0 1px #888 inset;
    padding: 3% 3% 2.5%;
    width: 94%;
	outline: none;
}
.page-header .site-container {
    padding: 0 20px;
    box-sizing: border-box;
    max-width: 1240px;
}

.widget-title {
    padding-top: 5px;
}
</style>


<!-- page header -->
<div class="page-header">
    <div class="site-container">
        <h1>Member</h1>
        <div class="cx-breadcrumbs"></div>
        <div class="clearboth"></div>
    </div>
</div>



<div class="site-body site-pad">
        <div class="site-container">

                <div id="primary" class="content-area" style="border: 0px solid blue;">


<?php
if (is_user_logged_in()){
    echo "<p>Welcome, registered user!</p>";
    showUserInfo();
    include("admin_bar.php");
}
else {
    echo "<p>Welcome, visitor!</p>";
    // header( 'Location: http://www.mysite.com/blog/wp-login.php' ) ;
    echo "<a href='../wp-login.php'>Login</a> | <a href='../wp-login.php?action=register'>Register</a>";
};
?>


                </div><!-- #primary -->

                <?php get_sidebar(); ?>

        </div>
</div>



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
