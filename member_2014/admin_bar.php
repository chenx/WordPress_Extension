<!-- This file is included only when user is logged in. -->
<!-- Ideally, this part should go in header. -->

<link rel='stylesheet' id='dashicons-css'  href='../wp-includes/css/dashicons.min.css?ver=4.2.4' type='text/css' media='all' />
<link rel='stylesheet' id='admin-bar-css'  href='../wp-includes/css/admin-bar.min.css?ver=4.2.4' type='text/css' media='all' />

<style type="text/css" media="print">#wpadminbar { display:none; }</style>
<style type="text/css" media="screen">
        html { margin-top: 32px !important; }
        * html body { margin-top: 32px !important; }
        @media screen and ( max-width: 782px ) {
                html { margin-top: 46px !important; }
                * html body { margin-top: 46px !important; }
        }
</style>

<?php
// Ideally, the part below should go right before </body>.
// But browsers recognize script and div after </html> so this would work.

if ( isset($current_user) ) {
    $user_email = $current_user->user_email;
    $display_name = $current_user->display_name;
    $username = $current_user->user_login;

    if ($display_name == '') {
        $display_user = "<span class='display-name'>$user_email</span>";
    } else if ($display_name == $username) {
        $display_user = "<span class='display-name'>$display_name</span>";
    } else {
        $display_user = "<span class='display-name'>$display_name</span><span class='username'>$username</span>";
    }
    $gravatar = md5( strtolower( trim( $user_email ) ) );
} else {
    $display_name = "unknown user";
    $display_user = "<span class='display-name'>user_email</span>";
    $gravatar = md5( strtolower( trim( "" ) ) );
}

//$logout_url = "../wp-login.php?action=logout&#038;_wpnonce=1f5b187f6a";
$logout_url = "../wp-login.php?action=logout";
//$logout_url = wp_nonce_url($logout_url, 'logout');
?>

<script type='text/javascript' src='../wp-includes/js/admin-bar.min.js?ver=4.3'></script>

	<script type="text/javascript">
		(function() {
			var request, b = document.body, c = 'className', cs = 'customize-support', rcs = new RegExp('(^|\\s+)(no-)?'+cs+'(\\s+|$)');

			request = true;

			b[c] = b[c].replace( rcs, ' ' );
			b[c] += ( window.postMessage && request ? ' ' : ' no-' ) + cs;
		}());
	</script>
			<div id="wpadminbar" class="nojq nojs">
							<a class="screen-reader-shortcut" href="#wp-toolbar" tabindex="1">Skip to toolbar</a>
						<div class="quicklinks" id="wp-toolbar" role="navigation" aria-label="Toolbar" tabindex="0">
	<ul id="wp-admin-bar-root-default" class="ab-top-menu">
		<li id="wp-admin-bar-wp-logo" class="menupop"><a class="ab-item"  aria-haspopup="true" href="../wp-admin/about.php"><span class="ab-icon"></span><span class="screen-reader-text">About WordPress</span></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-wp-logo-default" class="ab-submenu">
		<li id="wp-admin-bar-about"><a class="ab-item"  href="../wp-admin/about.php">About WordPress</a>		</li></ul><ul id="wp-admin-bar-wp-logo-external" class="ab-sub-secondary ab-submenu">
		<li id="wp-admin-bar-wporg"><a class="ab-item"  href="https://wordpress.org/">WordPress.org</a>		</li>
		<li id="wp-admin-bar-documentation"><a class="ab-item"  href="https://codex.wordpress.org/">Documentation</a>		</li>
		<li id="wp-admin-bar-support-forums"><a class="ab-item"  href="https://wordpress.org/support/">Support Forums</a>		</li>
		<li id="wp-admin-bar-feedback"><a class="ab-item"  href="https://wordpress.org/support/forum/requests-and-feedback">Feedback</a>		</li></ul></div>		</li>
		<li id="wp-admin-bar-site-name" class="menupop"><a class="ab-item"  aria-haspopup="true" href="../wp-admin/">My Site</a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-site-name-default" class="ab-submenu">
		<li id="wp-admin-bar-dashboard"><a class="ab-item"  href="../wp-admin/">Dashboard</a>		</li></ul>

	</ul>
	<ul id="wp-admin-bar-top-secondary" class="ab-top-secondary ab-top-menu">
		<li id="wp-admin-bar-search" class="admin-bar-search"><div class="ab-item ab-empty-item" tabindex="-1"><form action="../" method="get" id="adminbarsearch"><input class="adminbar-input" name="s" id="adminbar-search" type="text" value="" maxlength="150" /><label for="adminbar-search" class="screen-reader-text">Search</label><input type="submit" class="adminbar-button" value="Search"/></form></div>		</li>
		<li id="wp-admin-bar-my-account" class="menupop with-avatar"><a class="ab-item"  aria-haspopup="true" href="../wp-admin/profile.php">Howdy, <?php echo $display_name; ?><img alt='' src='http://0.gravatar.com/avatar/<?php echo $gravatar; ?>?s=26&#038;d=mm&#038;r=g' srcset='http://0.gravatar.com/avatar/<?php echo $gravatar; ?>?s=52&amp;d=mm&amp;r=g 2x' class='avatar avatar-26 photo' height='26' width='26' /></a><div class="ab-sub-wrapper"><ul id="wp-admin-bar-user-actions" class="ab-submenu">
		<li id="wp-admin-bar-user-info"><a class="ab-item" tabindex="-1" href="../wp-admin/profile.php"><img alt='' src='http://0.gravatar.com/avatar/<?php echo $gravatar; ?>?s=64&#038;d=mm&#038;r=g' srcset='http://0.gravatar.com/avatar/<?php echo $gravatar; ?>?s=128&amp;d=mm&amp;r=g 2x' class='avatar avatar-64 photo' height='64' width='64' /><?php echo $display_user; ?></a>		</li>
		<li id="wp-admin-bar-edit-profile"><a class="ab-item"  href="../wp-admin/profile.php">Edit My Profile</a>		</li>
		<li id="wp-admin-bar-logout"><a class="ab-item"  href="<?php echo $logout_url; ?>">Log Out</a>		</li></ul></div>		</li></ul>			</div>
						<a class="screen-reader-shortcut" href="<?php echo $logout_url; ?>">Log Out</a>
					</div>

