<?php
// untuk tampilan grid
$sql = "SELECT * FROM produk WHERE deleted = 0 ORDER BY nm_produk";
$produkQuery = $db->query($sql);

// untuk tampilan list
$sqlTlist = "SELECT * FROM produk WHERE deleted = 0 ORDER BY nm_produk";
$produkListquery = $db->query($sqlTlist);
?>
		<!-- Shop Product Area -->
		<div class="shop-product-area">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-12">
						<!-- Shop Product Left -->
						<div class="shop-product-left">
							<!-- Shop Layout Area -->
							<div class="shop-layout-area">
								<div class="layout-title">
									<h2>Kategori</h2>
								</div>
								<div class="layout-list">
									<ul>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Cocktail</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Day</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Evening</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Sport</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Sexy dress</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Fashion skirt</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Evening dress</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Children's Clothing</a></li>
									</ul>
								</div>
							</div><!-- End Shop Layout Area -->
							<!-- Price Filter Area -->
							<div class="price-filter-area shop-layout-area">
								<div class="price-filter">
									<div class="layout-title">
										<h2>Price</h2>
									</div>
									<div id="slider-range"></div>
									<p>
									  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
									</p>
									<button class="btn btn-default">Filter</button>
								</div>
							</div><!-- End Price Filter Area -->
							<!-- Shop Layout Area -->
							<div class="shop-layout-area">
								<div class="layout-title">
									<h2>Brand</h2>
								</div>
								<div class="layout-list">
									<ul>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Adidas</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Chanel</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>DKNY</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Dolce</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Gabbana</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Nike</a></li>
										<li><a href="#"><i class="fa fa-plus-square-o"></i>Vogue</a></li>
									</ul>
								</div>
							</div><!-- End Shop Layout Area -->
							<!-- Shop Layout Area -->
							<div class="shop-layout-area">
								<div class="popular-tag">
									<h2>Popular Tags</h2>
									<div class="tag-list">
										<ul>
											<li><a href="#">Clothing</a></li>
											<li><a href="#">accessories</a></li>
											<li><a href="#">fashion</a></li>
											<li><a href="#">footwear</a></li>
											<li><a href="#">good</a></li>
											<li><a href="#">kid</a></li>
											<li><a href="#">Men</a></li>
											<li><a href="#">Women</a></li>
										</ul>
									</div>
									<div class="tag-action">
										<ul>
											<li><a href="#">View all tags</a></li>
										</ul>
									</div>
								</div>
							</div><!-- End Shop Layout Area -->
						</div><!-- End Shop Product Left -->
					</div>

					<div class="col-md-9 col-sm-12">
						<!-- Shop Product Right -->
						<div class="shop-product-right">
							<div class="product-tab-area">
								<!-- Tab Bar -->
								<div class="tab-bar">
									<div class="tab-bar-inner">
										<ul class="nav nav-tabs" role="tablist">
											<li class="active"><a href="#shop-product" data-toggle="tab"><i class="fa fa-th-large"></i>Grid</a></li>
											<li><a href="#shop-list" data-toggle="tab"><i class="fa fa-th-list"></i>List</a></li>
										</ul>
									</div>
									<div class="toolbar">
										<div class="sorter">
											<div class="sort-by">
												<label>Sort By</label>
												<select>
													<option value="position">Position</option>
													<option value="name">Name</option>
													<option value="price">Price</option>
												</select>
												<a href="#"><i class="fa fa-long-arrow-up"></i></a>
											</div>
										</div>
										<div class="pager-list">
											<div class="limiter">
												<label>Show</label>
												<select>
													<option value="9">12</option>
													<option value="12">15</option>
													<option value="24">18</option>
													<option value="36">36</option>
												</select>
												per page
											</div>
										</div>
									</div>
								</div><!-- End Tab Bar -->

								<!-- Tab Content -->
								<div class="tab-content">
									<div class="tab-pane active" id="shop-product">
										<div class="row tab-content-row">

											<!-- Start Single Product Column -->
											<?php while($produk = mysqli_fetch_assoc($produkQuery)): ?>
											<div class="col-md-4 col-sm-4">
												<div class="single-product">
													<div class="single-product-img">
														<a href="#"><img class="primary-img" src="<?= $produk['image']; ?>" alt="<?=$produk['nm_produk']; ?>"></a>
													</div>
													<div class="single-product-content">
														<div class="product-content-head">
															<h2 class="product-title"><a href="#"><?php echo $produk['nm_produk']; ?></a></h2>
															<p class="product-price"><?php echo  rupiah($produk['harga']) ; ?></p>
														</div>
														<div class="product-bottom-action">
															<div class="product-action">
																<div class="action-button">
																	<button class="btn" type="button">Beli Sekarang</button>
																</div>
<!-- 																<div class="action-view">
																	<button type="button" class="btn" data-toggle="modal" data-target="#productModal"><i class="fa fa-search"></i>Quick view</button>
																</div> -->
															</div>
														</div>
													</div>
												</div>
											</div>
											<?php endwhile; ?>
											<!-- End Single Product Column -->
										</div>
									</div>

									<div class="tab-pane" id="shop-list">
										<!-- Single Shop -->
										<?php while($produkList = mysqli_fetch_assoc($produkListquery)): ?>
										<div class="single-shop single-product">
											<div class="row">
												<div class="col-md-4 col-sm-4">
													<div class="single-product-img">
														<a href="#"><img class="primary-img" src="<?= $produkList['image']; ?>" alt="<?= $produkList['nm_produk']; ?>"></a>
													</div>
												</div>
												<div class="col-md-8 col-sm-8">
													<div class="single-shop-content">
														<div class="shop-content-head fix">
															<h1><a href="#"><?=$produkList['nm_produk']; ?></a></h1>
														</div>
														<div class="shop-content-bottom">
															<div class="product-details">
																<p><?=$produkList['deskripsi']; ?></p>
															</div>
															<div class="product-price">
																<p class="product-price"><?=rupiah($produkList['harga']) ; ?></p>
															</div>
														</div>
														<div class="product-bottom-action">
															<div class="product-action">
																<div class="action-button">
																	<button class="btn" type="button">Beli Sekarang</button>
																</div>
																<!-- <div class="action-view">
																	<button type="button" class="btn" data-toggle="modal" data-target="#productModal"><i class="fa fa-search"></i>Quick view</button>
																</div> -->
															</div>
														</div>
													</div>
												</div>
											</div>
										</div><!-- End Single Shop -->
										<?php endwhile; ?>
									</div>
								</div><!-- End Tab Content -->

								<!-- Tab Bar -->
								<div class="tab-bar">
									<div class="toolbar">
										<div class="sorter">
											<div class="sort-by">
												<label>Sort By</label>
												<select>
													<option value="position">Position</option>
													<option value="name">Name</option>
													<option value="price">Price</option>
												</select>
												<a href="#"><i class="fa fa-long-arrow-up"></i></a>
											</div>
										</div>
										<div class="pages">
											<strong>Page:</strong>
											<ol>
												<li class="current">1</li>
												<li><a href="#">2</a></li>
												<li><a title="Next" href="#"><i class="fa fa-arrow-right"></i></a></li>
											</ol>
										</div>
									</div>
								</div><!-- End Tab Bar -->
							</div>
						</div><!-- End Shop Product Left -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Shop Product Area -->