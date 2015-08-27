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

<section id="main-content">
    <div class="container">
        <div class="row" style="border: 0px solid red;">
            <!-- Can change this section to use "width: 100%;" if sidebar is not used. -->
            <section class="col-sm-12 col-md-8 col-lg-9 content" style="border: 0px solid blue;">

<article id="post-2" class="article post-2 page type-page status-publish hentry">
	
	<header class="article-header">
		<h3 class="h3"><a href="#">Member</a></h3>
	</header><!-- end header -->

	<div class="article-body">

<?php  
if (is_user_logged_in()){
    echo "<blockquote><p>Welcome, registered user!</p></blockquote>";
    showUserInfo();
}
else {
    echo "<p>Welcome, visitor!</p>";
    //echo "<a href='../wp-login.php'>Login</a> | <a href='../wp-login.php?action=register'>Register</a>";
    echo "<a href='" . wp_login_url( "member_flatio" ) . "'><span style='color: red;'>Login</span></a> | ";
    echo "<a href='../wp-login.php?action=register'><span style='color: red;'>Register</span></a>";
    // header( 'Location: http://www.mysite.com/blog/wp-login.php' ) ;
};
?>


	</div> <!-- end article-body -->
</article>
            </section>

<?php
// comment out this if don't need sidebar.
// Then, if want content span entire width (including the width of sidebar),
// change <section> under <div class="row"> to use "width: 100%".
get_sidebar(); // comment out this if don't need sidebar.
?>

        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- end main-content -->


<?php
get_footer();
if (is_user_logged_in()) { include("admin_bar.php"); }


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
