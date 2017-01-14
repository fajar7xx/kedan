<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="src/dist/img/avatar.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?=$user_data['nama_lengkap'];?></p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Administrator</a>
      </div>
    </div>
    <!-- search form (Optional) -->
    <!-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form> -->
    <!-- /.search form -->
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <!-- <li class="header">HEADER</li> -->
      <!-- Optionally, you can add icons to the links -->
      
      <li class="active"><a href="index.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>
      
      <!-- <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> -->
      
      <li class="treeview">
        <a href="#"><i class="fa fa-tags"></i> <span>Catalog</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="brand.php">Brand</a></li>
        <li><a href="kategori.php">Kategori</a></li>
        <li><a href="produk.php">Produk</a></li>
      </ul>
    </li>
    <?php if(punya_permisi('admin')): ?>
      <li class="active"><a href="pengguna.php"><i class="fa fa-user"></i> <span>User</span></a></li>
    <?php endif; ?>
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>