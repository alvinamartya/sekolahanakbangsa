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
	<link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">


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
						<a href="<?= site_url('/') ?>">
							<!--End Logo icon -->
							<!-- Logo text -->
							<span class="logo-text ml-4">
								<!-- dark Logo text -->
								<img src="<?php echo base_url('assets/images/logo-sab-red.png') ?>" alt="homepage" class="dark-logo sab-logo" />
								<!-- Light Logo text -->
								<img src="<?php echo base_url('assets/images/logo-sab-red.png') ?>" class="light-logo sab-logo" alt="homepage" />
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
						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'dashboard' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'dashboard' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url("dashboard/admin") ?>" aria-expanded="false">
								<i class="fa fa-home"></i><span class="hide-menu">Dashboard</span>
							</a>
						</li>
						<li class="list-divider"></li>
						<li class="nav-small-cap"><span class="hide-menu">Manajemen Data</span></li>

						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'barang' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'barang' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('barang') ?>" aria-expanded="false">
								<i class="fa fa-box-open"></i><span class="hide-menu">Barang</span>
							</a>
						</li>

						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'biaya-lainnya' || strtolower($this->uri->segment(1)) == 'biaya_lainnya' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'biaya-lainnya' || strtolower($this->uri->segment(1)) == 'biaya_lainnya' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('biaya-lainnya') ?>" aria-expanded="false">
								<i class="fa fa-boxes"></i><span class="hide-menu">Biaya Lainnya</span>
							</a>
						</li>

						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'cluster' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'cluster' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('cluster') ?>" aria-expanded="false">
								<i class="fas fa-cubes"></i><span class="hide-menu">Cluster Relawan</span>
							</a>
						</li>

						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'sekolah' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'sekolah' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('sekolah') ?>" aria-expanded="false">
								<i class="fas fa-graduation-cap"></i><span class="hide-menu">Sekolah</span>
							</a>
						</li>

						<li class="list-divider"></li>
						<li class="nav-small-cap"><span class="hide-menu">Manajemen SDM</span></li>

						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'donatur' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'donatur' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('donatur') ?>" aria-expanded="false">
								<i class="fas fa-user-shield"></i><span class="hide-menu">Donatur</span>
							</a>
						</li>

						<?php if ($role == 'Super Admin') { ?>
							<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'karyawan' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
								<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'karyawan' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('karyawan') ?>" aria-expanded="false">
									<i class="fas fa-user-tie"></i><span class="hide-menu">Karyawan</span>
								</a>
							</li>
						<?php } ?>

						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'sdm-relawan' || strtolower($this->uri->segment(1)) == 'sdm_relawan' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'sdm-relawan' || strtolower($this->uri->segment(1)) == 'sdm_relawan' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('sdm_relawan') ?>" aria-expanded="false">
								<i class="fa fa-users"></i><span class="hide-menu">Pengolahan SDM</span>
							</a>
						</li>

						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'relawan' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'relawan' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('relawan') ?>" aria-expanded="false">
								<i class="fas fa-people-carry"></i><span class="hide-menu">Relawan</span>
							</a>
						</li>

						<li class="list-divider"></li>
						<li class="nav-small-cap"><span class="hide-menu">Donasi</span></li>

						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'validasi-uang-masuk' || strtolower($this->uri->segment(1)) == 'validasi_uang_masuk' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'validasi-uang-masuk' || strtolower($this->uri->segment(1)) == 'validasi_uang_masuk' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('validasi_uang_masuk') ?>" aria-expanded="false">
								<i class="fa fa-check-double"></i><span class="hide-menu">Validasi Uang Masuk</span>
							</a>
						</li>
						<li class="nav-small-cap"><span class="hide-menu">Konfirmasi</span></li>

						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'bantuan-sekolah' || strtolower($this->uri->segment(1)) == 'bantuan_sekolah' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'bantuan-sekolah' || strtolower($this->uri->segment(1)) == 'bantuan_sekolah' || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('bantuan_sekolah') ?>" aria-expanded="false">
								<i class="fa fa-check-double"></i><span class="hide-menu">Konfirmasi kebutuhan tahunan</span>
							</a>
						</li>

						<li class="sidebar-item <?php echo (strtolower($this->uri->segment(1)) == 'kebutuhan-tahunan' || strtolower($this->uri->segment(1)) == 'kebutuhan_tahunan' || strtolower($this->uri->segment(1)) == '' ? 'active selected' : '') ?>">
							<a class="sidebar-link <?php echo (strtolower($this->uri->segment(1)) == 'kebutuhan-tahunan' || strtolower($this->uri->segment(1)) == 'kebutuhan_tahunan'  || strtolower($this->uri->segment(1)) == '' ? 'active' : '') ?>" href="<?php echo site_url('kebutuhan-tahunan/data') ?>" aria-expanded="false">
								<i class="fa fa-calendar"></i><span class="hide-menu">Kebutuhan Tahunan</span>
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