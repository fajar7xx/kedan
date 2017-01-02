<?php
$sql = "SELECT * FROM kategori WHERE parent = 0";
$pquery = $db->query($sql);
?>

		<!-- Header Area -->
        <div class="header-area">
			<!-- Header top bar -->
			<div class="header-top-bar">
				<div class="container">
					<div class="header-top-inner">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="header-top-left">
									<!-- Header Link Area -->
									<div class="header-link-area">
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
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<div class="header-top-right">
									<!-- Header Social Icon -->
									<div class="header-social-icon">
										<ul>
											<li><a href="#"><i class="fa fa-twitter"></i></a></li>
											<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
											<li><a href="#"><i class="fa fa-facebook"></i></a></li>
											<li><a href="#"><i class="fa fa-youtube"></i></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div><!-- End Header Top bar -->
			<!-- Header bottom -->
			<div class="header-bottom">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-12">
							<!-- Header Search -->
							<div class="header-search">
								<form action="#">
									<input type="text" placeholder="Cari Produk...">
									<button type="button" class="btn"><i class="fa fa-search"></i></button>
								</form>
							</div>
						</div>
						<div class="col-md-4  col-sm-12">
							<!-- Header logo -->
							<div class="header-logo">
								<a href="index.html"><img src="img/logo/logo.png" alt="logo"></a>
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<!-- Header Cart Area-->
							<div class="header-cart-area">
								<div class="header-cart">
									<ul>
										<li>
											<a href="#">
												<i class="fa fa-shopping-cart"></i>
												<span class="my-cart">My cart</span>
												<span class="badge">2</span>
											</a>
											<ul>
												<li>
													<div class="cart-list">
														<div class="cart-list-item">
															<div class="cart-list-img">
																<a href="#"><img src="img/cart/c1.jpg" alt="cart" /></a>
															</div>
															<div class="cart-content">
																<a href="#">Etiam gravida</a>
																<p>1 x <span>$432.00</span></p>
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
																<a href="#">Etiam gravida</a>
																<p>1 x <span>$432.00</span></p>
															</div>
															<div class="cart-button">
																<a href="#"><i class="fa fa-pencil"></i></a>
																<a href="#"><i class="fa fa-times"></i></a>
															</div>
														</div>
													</div>
													<div class="cart-subtotal">
														<p>Subtotal: <span>$1,131.00</span></p>
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
						</div>
					</div>
				</div>
			</div><!-- End Header bottom -->
		</div><!-- End Header Area -->

        <!-- Main Menu Area -->
		<div class="main-menu-area entire-main-menu-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<!-- Main Menu -->
						<div class="main-menu hidden-sm hidden-xs">
							<nav>
								<ul class="main-ul">
									<li class="sub-menu-li"><a href="index.html">Home</a></li>

									<!-- menu items php -->
									<?php while($parent = mysqli_fetch_assoc($pquery)):
										$parent_id = $parent['id_kategori']; 
										$sql2 = "SELECT * FROM kategori WHERE parent = '$parent_id'";
										$cquery = $db->query($sql2);
									?>
										<li class="sub-menu-li"><a href="#"><?=$parent['nm_kategori'] ?><i class="fa fa-chevron-down"></i></a>
											<ul class="sub-menu">
												<?php while($child = mysqli_fetch_assoc($cquery)): ?>
												<li><a href="#"><i class="fa fa-chevron-circle-right"></i> <span><?php echo $child['nm_kategori'] ?></span></a></li>
												<?php endwhile; ?>
											</ul>
										</li>
									<?php endwhile; ?>
									<!-- finish menu item php -->

									<li class="sub-menu-li"><a href="#" class="new-arrivals">Pages<i class="fa fa-chevron-down"></i></a>
										<!-- Sub Menu -->
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
									<li class=""><a href="index.html">Home</a>
										<ul class="sub-menu">
											<li><a href="index-2.html">Home Page 2</a></li>
											<li><a href="index-3.html">Home Page 3</a></li>
											<li><a href="index-4.html">Home Page 4</a></li>
											<li><a href="index-5.html">Home Page 5</a></li>
											<li><a href="index-6.html">Home Page 6</a></li>
										</ul>
									</li>
									<li><a href="shop.html">Women</a>
										<ul class="">
											<li><a href="">Clother</a>
												<ul>
													<li><a href="#">Cocktail</a></li>														
													<li><a href="#">Day</a></li>
													<li><a href="#">Evening</a></li>
													<li><a href="#">Sports</a></li>
													<li><a href="#">Sexy Dress</a></li>
													<li><a href="#">Fsshion Skirt</a></li>
													<li><a href="#">Evening Dress</a></li>
													<li><a href="#">Children's Clothing</a></li>
												</ul>
											</li>
											<li><a href="#">Dress and skirt</a>
												<ul>
													<li><a href="#">Sports</a></li>														
													<li><a href="#">Run</a></li>
													<li><a href="#">Sandals</a></li>
													<li><a href="#">Books</a></li>
													<li><a href="#">A-line Dress</a></li>
													<li><a href="#">Lacy Looks</a></li>
													<li><a href="#">Shirts-T-Shirts</a></li>
												</ul>
											</li>
											<li><a href="#">shoes</a>
												<ul>
													<li><a href="#">blazers</a></li>														
													<li><a href="#">table</a></li>
													<li><a href="#">coats</a></li>
													<li><a href="#">Sports</a></li>
													<li><a href="#">kids</a></li>
													<li><a href="#">Sweater</a></li>
													<li><a href="#">Coat</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li class=""><a href="shop.html">Men</a>
										<ul class="">
											<li><a href="#">Bages</a>
												<ul>
													<li><a href="#">Bootes Bages</a></li>														
													<li><a href="#">Blazers</a></li>
													<li><a href="#">Mermaid</a></li>
												</ul>
											</li>
											<li><a href="#">Clothing</a>
												<ul>
													<li><a href="#">coats</a></li>														
													<li><a href="#">T-shirt</a></li>
												</ul>
											</li>
											<li><a href="#">lingerie</a>
												<ul>
													<li><a href="#">brands</a></li>														
													<li><a href="#">furniture</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li><a href="shop.html">Handbags</a>
										<ul class="">
											<li><a href="#">Footwear Man</a>
												<ul>
													<li><a href="#">Gold Rigng</a></li>														
													<li><a href="#">paltinum Rings</a></li>
													<li><a href="#">Silver Ring</a></li>
													<li><a href="#">Tungsten Ring</a></li>
												</ul>	
											</li>
											<li><a href="#">Footwear Womens</a>
												<ul>
													<li><a href="#">Brand Gold</a></li>														
													<li><a href="#">paltinum Rings</a></li>
													<li><a href="#">Silver Ring</a></li>
													<li><a href="#">Tungsten Ring</a></li>
												</ul>	
											</li>
											<li><a href="#">Band</a>
												<ul>
													<li><a href="#">Platinum Necklaces</a></li>														
													<li><a href="#">Gold Ring</a></li>
													<li><a href="#">silver ring</a></li>
													<li><a href="#">Diamond Bracelets</a></li>
												</ul>	
											</li>	
										</ul>
									</li>
									<li><a href="shop.html">Shoes</a>
										<ul class="">
											<li><a href="#">Rings</a>
												<ul>
													<li><a href="#">Coats & jackets</a></li>														
													<li><a href="#">blazers</a></li>
													<li><a href="#">raincoats</a></li>
												</ul>	
											</li>
											<li><a href="#">Dresses</a>
												<ul>
													<li><a href="#">footwear</a></li>														
													<li><a href="#">blazers</a></li>
													<li><a href="#">clog sandals</a></li>
													<li><a href="#">combat boots</a></li>
												</ul>	
											</li>
											<li><a href="#">Accessories</a>
												<ul>
													<li><a href="#">bootees Bags</a></li>														
													<li><a href="#">blazers</a></li>
													<li><a href="#">jackets</a></li>
													<li><a href="#">kids</a></li>
													<li><a href="#">shoes</a></li>
												</ul>	
											</li>
											<li><a href="#">Top</a>
												<ul>
													<li><a href="#">briefs</a></li>														
													<li><a href="#">camis</a></li>
													<li><a href="#">nigthwear</a></li>
													<li><a href="#">kids</a></li>
													<li><a href="#">shapewer</a></li>
												</ul>	
											</li>
										</ul>
									</li>
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
				</div>
			</div>
		</div><!-- End Main Menu Area -->
		<!-- Breadcurb Area -->
		<div class="breadcurb-area">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li><a href="#">Women</a></li>
					<li>Clother</li>
				</ul>
			</div>
		</div><!-- End Breadcurb Area -->