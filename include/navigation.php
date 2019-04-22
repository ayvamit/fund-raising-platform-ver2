<header class="default-header" id="header">
				<div class="container">
					<div class="header-wrap">
						<div class="header-top d-flex justify-content-between align-items-center">
							<div class="logo">
								<a href="#home"><img src="img/logo.png" alt=""></a>
							</div>
							<div class="main-menubar d-flex align-items-center" id="nav-menu-container">
								<nav>
									<a href="afterloginindex.php">Home</a>
									<a href="afterlogin.php">Dashboard</a>						
																		
									<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {?>
        								<a href="logout.php">Logout</a>
     								<?php } else { ?>
        								<a href="login.php">Login</a>
      								<?php } ?>				
								</nav>								
							</div>
						</div>
					</div>
				</div>
			</header>