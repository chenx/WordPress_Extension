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


<section id="content" class="first clearfix" role="main">
<div class="page-container">
		
<article id="post-2" class="post-2 page type-page status-publish hentry" role="article">
    <div class="singlebox">
	
	<header class="article-header">
		<h1 class="post-title">Member</h1>
	</header><!-- end header -->

	<section class="entry-content clearfix">

<?php  
if (is_user_logged_in()){
    echo "<blockquote><p>Welcome, registered user!</p></blockquote>";
    showUserInfo();
}
else {
    echo "<p>Welcome, visitor!</p>";
    //echo "<a href='../wp-login.php'>Login</a> | <a href='../wp-login.php?action=register'>Register</a>";
    echo "<a href='" . wp_login_url( "member_bubbly" ) . "'><span style='color: red;'>Login</span></a> | ";
    echo "<a href='../wp-login.php?action=register'><span style='color: red;'>Register</span></a>";
    // header( 'Location: http://www.mysite.com/blog/wp-login.php' ) ;
};
?>


	</section> <!-- end section entry-content -->
    </div>
</article>
</div> <!-- end page-container -->
</section> <!-- end section content -->


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
