<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/favicon.png') ?>">
	<title><?= $title ?></title>
	<!-- Custom CSS -->
	<link href="<?php echo base_url('assets/extra-libs/c3/c3.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/libs/chartist/dist/chartist.min.css') ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/extra-libs/font-awesome/css/all.min.css') ?>" rel="stylesheet" />
	<!-- Datatables CSS -->
	<link href="<?= base_url('assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') ?>" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php echo base_url('assets/css/style.min.css') ?>" rel="stylesheet">


</head>

<body>
	<!-- ============================================================== -->
	<!-- Preloader - style you can find in spinners.css -->
	<!-- ============================================================== -->
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- Main wrapper - style you can find in pages.scss -->
	<!-- ============================================================== -->
	<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
		<!-- ============================================================== -->
		<!-- Topbar header - style you can find in pages.scss -->
		<!-- ============================================================== -->
		<header class="topbar" data-navbarbg="skin6">
			<nav class="navbar top-navbar navbar-expand-md">
				<div class="navbar-header" data-logobg="skin6">
					<!-- This is for the sidebar toggle which is visible on mobile only -->
					<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
					<!-- ============================================================== -->
					<!-- Logo -->
					<!-- ============================================================== -->
					<div class="navbar-brand">
						<!-- Logo icon -->
						<a href="index.html">
							<b class="logo-icon">
								<!-- Dark Logo icon -->
								<img src="<?php echo base_url('assets/images/logo-icon.png') ?>" alt="homepage" class="dark-logo" />
								<!-- Light Logo icon -->
								<img src="<?php echo base_url('assets/images/logo-icon.png') ?>" alt="homepage" class="light-logo" />
							</b>
							<!--End Logo icon -->
							<!-- Logo text -->
							<span class="logo-text">
								<!-- dark Logo text -->
								<img src="<?php echo base_url('assets/images/logo-text.png') ?>" alt="homepage" class="dark-logo" />
								<!-- Light Logo text -->
								<img src="<?php echo base_url('assets/images/logo-light-text.png') ?>" class="light-logo" alt="homepage" />
							</span>
						</a>
					</div>
					<!-- ============================================================== -->
					<!-- End Logo -->
					<!-- ============================================================== -->
					<!-- ============================================================== -->
					<!-- Toggle which is visible on mobile only -->
					<!-- ============================================================== -->
					<a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
				</div>
				<!-- ============================================================== -->
				<!-- End Logo -->
				<!-- ============================================================== -->
				<div class="navbar-collapse collapse" id="navbarSupportedContent">
					<!-- ============================================================== -->
					<!-- toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav float-left mr-auto ml-3 pl-1">
					</ul>
					<!-- ============================================================== -->
					<!-- Right side toggle and nav items -->
					<!-- ============================================================== -->
					<ul class="navbar-nav float-right">
						<!-- ============================================================== -->
						<!-- User profile and search -->
						<!-- ============================================================== -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span class="text-dark"><?= $name ?></span> <i data-feather="chevron-down" class="svg-icon"></i></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
								<a class="dropdown-item" href="javascript:void(0)"><i data-feather="user" class="svg-icon mr-2 ml-1"></i>
									Profil Saya</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?= site_url('login/logout') ?>"><i data-feather="power" class="svg-icon mr-2 ml-1"></i>
									Keluar</a>
							</div>
						</li>
						<!-- ============================================================== -->
						<!-- User profile and search -->
						<!-- ============================================================== -->
					</ul>
				</div>
			</nav>
		</header>
		<!-- ============================================================== -->
		<!-- End Topbar header -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<aside class="left-sidebar" data-sidebarbg="skin6">
			<!-- Sidebar scroll-->
			<div class="scroll-sidebar" data-sidebarbg="skin6">
				<!-- Sidebar navigation-->
				<nav class="sidebar-nav">
					<ul id="sidebarnav">
						<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url("dashboard/admin") ?>" aria-expanded="false">
								<i class="fa fa-home"></i><span class="hide-menu">Dashboard</span>
							</a>
						</li>
						<li class="list-divider"></li>
						<li class="nav-small-cap"><span class="hide-menu">Manajemen Data</span></li>

						<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'barang' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'barang' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url('barang') ?>" aria-expanded="false">
								<i class="fa fa-box-open"></i><span class="hide-menu">Barang</span>
							</a>
						</li>

						<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'biaya-lainnya' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'biaya-lainnya' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url('biaya-lainnya') ?>" aria-expanded="false">
								<i class="fa fa-boxes"></i><span class="hide-menu">Biaya Lainnya</span>
							</a>
						</li>

						<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'cluster' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'cluster' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url('cluster') ?>" aria-expanded="false">
								<i class="fas fa-cubes"></i><span class="hide-menu">Cluster Relawan</span>
							</a>
						</li>

						<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'sekolah' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'sekolah' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url('sekolah') ?>" aria-expanded="false">
								<i class="fas fa-graduation-cap"></i><span class="hide-menu">Sekolah</span>
							</a>
						</li>

						<li class="list-divider"></li>
						<li class="nav-small-cap"><span class="hide-menu">Manajemen SDM</span></li>

						<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'donatur' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'donatur' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url('donatur') ?>" aria-expanded="false">
								<i class="fas fa-user-shield"></i><span class="hide-menu">Donatur</span>
							</a>
						</li>

						<?php if ($role == 'Super Admin') { ?>
							<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'karyawan' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
								<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'karyawan' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url('karyawan') ?>" aria-expanded="false">
									<i class="fas fa-user-tie"></i><span class="hide-menu">Karyawan</span>
								</a>
							</li>
						<?php } ?>

						<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'sdm-relawan' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'sdm-relawan' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url('sdm-relawan') ?>" aria-expanded="false">
								<i class="fa fa-users"></i><span class="hide-menu">Pengolahan SDM</span>
							</a>
						</li>

						<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'relawan' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'relawan' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url('relawan') ?>" aria-expanded="false">
								<i class="fas fa-people-carry"></i><span class="hide-menu">Relawan</span>
							</a>
						</li>

						<li class="list-divider"></li>
						<li class="nav-small-cap"><span class="hide-menu">Donasi</span></li>

						<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'validasi-uang-masuk' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'validasi-uang-masuk' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url('validasi_uang_masuk') ?>" aria-expanded="false">
								<i class="fa fa-check-double"></i><span class="hide-menu">Validasi Uang Masuk</span>
							</a>
						</li>
						<li class="nav-small-cap"><span class="hide-menu">Konfirmasi</span></li>

						<li class="sidebar-item <?php echo ($this->uri->segment(1) == 'konfirmasi-kebutuhan-tahunan' || $this->uri->segment(1) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo ($this->uri->segment(1) == 'konfirmasi-kebutuhan-tahunan' || $this->uri->segment(1) == '' ? 'active' : '') ?>" href="<?php echo site_url('Bantuan_sekolah') ?>" aria-expanded="false">
								<i class="fa fa-check-double"></i><span class="hide-menu">Konfirmasi kebutuhan tahunan</span>
							</a>
						</li>
					</ul>
				</nav>
				<!-- End Sidebar navigation -->
			</div>
			<!-- End Sidebar scroll-->
		</aside>
		<!-- ============================================================== -->
		<!-- End Left Sidebar - style you can find in sidebar.scss  -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Page wrapper  -->
		<!-- ============================================================== -->
		<div class="page-wrapper">