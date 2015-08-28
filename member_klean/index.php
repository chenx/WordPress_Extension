<?php
require("../wp-load.php");

get_header();
?>

<style type="text/css">
/* These styles can be achieved instead with page class: 
  $(document).ready(function() {
      $('body').addClass('page');
  });
*/
/*
.header-image {
    display: none;
}
.site-branding {
    display: block;
}
#page {
    position: relative;
    float: right;
    margin-top:60px;
    width:75%;
}
*/
</style>

<div id="primary" class="content-area col-lg-8 col-md-8 col-sm-12 col-xs-12" style="border: 0px solid red; width: 100%">
	<main id="main" class="site-main" role="main" style="border: 0px solid blue;">

<article id="post-2" class="post-2 page type-page status-publish hentry">
	
	<header class="entry-header">
		<h1 class="entry-title">Member</h1>
	</header><!-- end header -->

	<div class="entry-content">

<?php  
if (is_user_logged_in()){
    echo "<blockquote><p>Welcome, registered user!</p></blockquote>";
    showUserInfo();
}
else {
    echo "<p>Welcome, visitor!</p>";
    //echo "<a href='../wp-login.php'>Login</a> | <a href='../wp-login.php?action=register'>Register</a>";
    echo "<a href='" . wp_login_url( "member_klean" ) . "'><span style='color: red;'>Login</span></a> | ";
    echo "<a href='../wp-login.php?action=register'><span style='color: red;'>Register</span></a>";
    // header( 'Location: http://www.mysite.com/blog/wp-login.php' ) ;
};
?>


	</div> <!-- end section entry-content -->
</article>
    </main> <!-- end site-main -->
</div> <!-- end primary -->

<script type="text/javascript">
    document.body.className += " page page-id-2 page-template-default";
</script>

<?php
//get_sidebar(); // comment out this if don't need sidebar.
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
