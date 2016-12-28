<?php 
$sql = "SELECT * FROM kategori WHERE parent = 0";
$pquery = $db->query($sql);
?>		

		<div class="wrraper home-5-area">
			<!-- Header Area -->
			<div class="header-area">
				<!-- Header logo -->
				<div class="header-logo">
					<a href="index.php"><img src="img/logo/logo.png" alt="Kedan, jual handy craft khas sumatera utara"></a>
				</div>

				<!-- Main Menu Area -->
				<div class="main-menu-area home-5-main-menu-area">
					<!-- Main Menu -->
					<div class="main-menu hidden-sm hidden-xs">
						<nav>
							<ul class="main-ul">
								<li class="sub-menu-li"><a href="index.php" class="active">Home</a></li>
								
								<!-- menu items -->
								<?php while($parent = mysqli_fetch_assoc($pquery)) : ?>
									<?php 
									$parent_id = $parent['id_kategori']; 
									$sql2 = "SELECT * FROM kategori WHERE parent = '$parent_id'";
									$cquery = $db->query($sql2);
									?>

									<li class="sub-menu-li"><a href="#" class="new-arrivals"><?php echo $parent['nm_kategori'] ?><i class="fa fa-chevron-right"></i></a>
										<ul class="sub-menu">
											<?php while($child = mysqli_fetch_assoc($cquery)): ?>
											<li><a href="#"><i class="fa fa-chevron-circle-right"></i> <span><?php echo $child['nm_kategori'] ?></span></a></li>
											<?php endwhile; ?>
										</ul>
									</li>
								<?php endwhile; ?>

								<li class="sub-menu-li"><a href="#" class="new-arrivals">Pages<i class="fa fa-chevron-right"></i></a>
									<ul class="sub-menu">
										<li><a href="blog.html"><i class="fa fa-chevron-circle-right"></i> <span>Blog</span></a></li>
										<li><a href="blog-details.html"><i class="fa fa-chevron-circle-right"></i> <span>Blog Details</span></a></li>
										<li><a href="cart.html"><i class="fa fa-chevron-circle-right"></i> <span>Cart</span></a></li>
										<li><a href="checkout.html"><i class="fa fa-chevron-circle-right"></i> <span>Checkout</span></a></li>
										<li><a href="contact.html"><i class="fa fa-chevron-circle-right"></i> <span>Contact</span></a></li>
										<li><a href="shop.html"><i class="fa fa-chevron-circle-right"></i> <span>Shop</span></a></li>
										<li><a href="shop-list.html"><i class="fa fa-chevron-circle-right"></i> <span>Shop List</span></a></li>
										<li><a href="product-details.html"><i class="fa fa-chevron-circle-right"></i> <span>Product Details</span></a></li>
										<li><a href="my-account.html"><i class="fa fa-chevron-circle-right"></i> <span>My Account</span></a></li>
										<li><a href="wishlist.html"><i class="fa fa-chevron-circle-right"></i> <span>Wishlist</span></a></li>
									</ul>
								</li>

							</ul>
						</nav>
					</div><!-- End Main Menu -->

					<!-- Start Mobile Menu -->
					<div class="mobile-menu hidden-md hidden-lg">
						<nav>
							<ul>
								<li class=""><a href="index.html">Home</a></li>
								
								<!-- menu items -->
								<?php while($parent = mysqli_fetch_assoc($pquery)) : ?>
									
									<?php 
									$parent_id = $parent['id_kategori']; 
									$sql2 = "SELECT * FROM kategori WHERE parent = '$parent_id'";
									$cquery = $db->query($sql2);
									?>
								<li><a href="#"><?php echo $parent['nm_kategori'] ?>
									<ul>
										<?php while($child = mysqli_fetch_assoc($cquery)): ?>
										<li><a href=""><?php echo $parent['nm_kategori'] ?></a></li>
										<?php endwhile; ?>
									</ul>
								</li>
								<?php endwhile; ?>

								<li class=""><a href="">Pages</a>
									<ul class="">
										<li><a href="blog.html">Blog</a></li>
										<li><a href="blog-details.html">Blog Details</a></li>
										<li><a href="cart.html">Cart</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="contact.html">Contact</a></li>
										<li><a href="shop.html">Shop</a></li>
										<li><a href="shop-list.html">Shop List</a></li>
										<li><a href="product-details.html">Product Details</a></li>
										<li><a href="my-account.html">My Account</a></li>
										<li><a href="wishlist.html">Wishlist</a></li>
									</ul>
								</li>
							</ul>
						</nav>
					</div><!-- End Mobile Menu -->
				</div>
				<!-- End Main Menu Area -->
				
				<!-- Header Search -->
				<div class="header-search">
					<form action="#" method="get">
						<input type="text" placeholder="Cari Produk......">
						<button type="button" class="btn"><i class="fa fa-search"></i></button>
					</form>
				</div>
				<!-- Header Social Icon -->
				<div class="header-social-icon">
					<ul>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#"><i class="fa fa-youtube"></i></a></li>
						<li><a href="#"><i class="fa fa-tumblr"></i></a></li>
					</ul>
				</div>
				<!-- Header Link -->
				<!-- Header Link Area -->
				<div class="header-link-area">
					<div class="header-link">
						<ul>
							<li><a href="#">Daftar</a></li>
						</ul>
					</div>
					<div class="header-link">
						<ul>
							<li><a href="#">Account <span class="caret"></span></a>
								<ul>
									<li><a href="my-account.html">My Account</a></li>
									<li><a href="wishlist.html">My Wishlist</a></li>
									<li><a href="cart.html">My Cart</a></li>
									<li><a href="checkout.html">Checkout</a></li>
									<li><a href="blog.html">Blog</a></li>
									<li><a href="my-account.html">login</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div><!-- End Header Link Area -->
				<!-- Header Cart Area-->
				<div class="header-cart-area">
					<div class="header-cart">
						<ul>
							<li>
								<a href="#">
									<i class="fa fa-shopping-cart"></i>
									<span class="my-cart">My cart (2)</span>
								</a>
								<ul>
									<li>
										<div class="cart-list">
											<div class="cart-list-item">
												<div class="cart-list-img">
													<a href="product-details.html"><img src="img/cart/c1.jpg" alt="cart" /></a>
												</div>
												<div class="cart-content">
													<a href="#">Wood Art</a>
													<p>1 x <span>Rp.200.000</span></p>
												</div>
												<div class="cart-button">
													<a href="#"><i class="fa fa-pencil"></i></a>
													<a href="#"><i class="fa fa-times"></i></a>
												</div>
											</div>
										</div>
										<div class="cart-list cart-list-two">
											<div class="cart-list-item">
												<div class="cart-list-img">
													<a href="#"><img src="img/cart/c2.jpg" alt="cart" /></a>
												</div>
												<div class="cart-content">
													<a href="#">Photo Wood</a>
													<p>1 x <span>Rp.75.000</span></p>
												</div>
												<div class="cart-button">
													<a href="#"><i class="fa fa-pencil"></i></a>
													<a href="#"><i class="fa fa-times"></i></a>
												</div>
											</div>
										</div>
										<div class="cart-subtotal">
											<p>Subtotal: <span>Rp.275.000</span></p>
										</div>
										<div class="cart-action">
											<button type="button" class="btn"><span>checkout</span> <i class="fa fa-long-arrow-right"></i></button>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div><!-- End Header Cart Area-->
			</div><!-- End Header Area -->