<?php
require("../wp-load.php");

get_header();
?>


<div id="main-content" class="main-content">
    <div id="primary" class="content-area" style="border: 0px solid blue;">
        <div id="content" class="site-content" role="main">

    <article id="post-2" class="post-2 page type-page status-publish hentry">
	<header class="entry-header"><h1 class="entry-title">Member</h1></header><!-- .entry-header -->
	<div class="entry-content">

<?php
if (is_user_logged_in()){
    echo "<p>Welcome, registered user!</p>";
    showUserInfo();
}
else {
    echo "<p>Welcome, visitor!</p>";
    echo "<a href='" . wp_login_url( "member_2014" ) . "' title='Login'>Login</a> | <a href='../wp-login.php?action=register'>Register</a>";
};
?>

        </div>
    </article>

    <!-- Content also can go here (outside article tag) in custom style. -->

                </div><!-- #content -->
        </div><!-- #primary -->
        <?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->


<?php
get_sidebar();
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
