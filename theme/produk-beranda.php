<?php  
// sebagai pengingat saja
// $varSqql = "select * from tabelDB WHERE columdb = 1";


$sql = "SELECT * FROM produk WHERE featured = 1";
$featured = $db->query($sql);
?>

<!-- Product area duplikat-->
			<div class="brand-products-area">
				<div class="container">
					<div class="row">
						<h2 style="text-align: center;">Jelajahi produk khas sumatera utara lainnya</h2><hr>
						<div class="col-md-12">
							<!-- Tab Content -->
							<div class="tab-content">
								<div class="tab-pane active" id="shop-product">
									<!-- sementara dimatikan karena masih ada bug pada browser yang berbede tampilan jadi berantahkan, untuk itu hanya baru bisa pada tampilan GOOGLE-CHROME yang lainnya masih belum nih. -->
									<!-- <div class="row tab-content-row"> -->

										<!-- Start Single Product Column -->
										<?php while($product = mysqli_fetch_assoc($featured)) : ?>
											<!--?php var_dump($product); ?-->
										<div class="col-md-3 col-sm-3">
											<div class="single-product">
												<div class="single-product-img">
													<a href="#"><img class="primary-img" src="<?php echo $product['image']; ?>" alt="<?php echo $product['nm_produk']; ?>"></a>
												</div>
												<div class="single-product-content">
													<div class="product-content-head">
														<h2 class="product-title"><a href="#"><?php echo $product['nm_produk']; ?></a></h2>
														<p class="product-price"><?php echo  rupiah($product['harga']) ; ?></p>
													</div>
													<div class="product-bottom-action">
														<div class="product-action">
															<div class="action-button">
																<button class="btn" type="button">BELI SEKARANG</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<?php endwhile; ?>
										<!-- End Single Product Column -->
									<!-- </div> -->
								</div>
							</div>
							<!-- End Tab Content -->
						</div>
					</div>
				</div>
			</div>
			<!-- End Product area -->