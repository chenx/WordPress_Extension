<?php
require("../wp-load.php");

get_header();
?>


<div id="primary" class="content-area">
<div id="content" class="site-content" role="main">

<article id="post-2" class="post-2 page type-page status-publish hentry" style="border: 0px solid blue;">

	<header class="entry-header">
		<h1 class="entry-title">Member</h1>
	</header><!-- .entry-header -->

	<div class="entry-content" style="border: 0px solid red;">

<?php  
if (is_user_logged_in()){
    echo "<p>Welcome, registered user!</p>";
    showUserInfo();
}
else {
    echo "<p>Welcome, visitor!</p>";
    echo "<a href='" . wp_login_url( "member_2013" ) . "'><span style='color: red;'>Login</span></a> | ";
    echo "<a href='../wp-login.php?action=register'><span style='color: red;'>Register</span></a>";
};
?>

	</div> <!-- end entry-content -->
</article>

</div> <!-- end content -->
</div> <!-- end primary -->


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
