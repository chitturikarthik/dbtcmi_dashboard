<?php


if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
    exit();
}

?>

<header class="header">
				<div class="logo-container">
					<a href="dashboard.php" class="logo"><h4 class="font-weight-bold text-info text-uppercase cursor-pointer">dbt cmi</h4></a>
					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<!-- start: search & user box -->
				<div class="header-right">
					<span class="separator"></span>

					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="http://dbtcmi.rf.gd/images/logos/logo_white.png" alt="Joseph Doe" class="rounded-circle bg-dark" data-lock-picture="img/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name">DBT-CMI</span>
								<span class="role">Administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled mb-2">
								<li class="divider"></li>
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="?logout=1"><i class="fas fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
            <style>
                body{
                    font-family:'Inter',sans-serif;
					-ms-overflow-style: none;  /* IE and Edge */
  					scrollbar-width: none;
                }
            </style>