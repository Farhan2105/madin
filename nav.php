 <div class="col-md-3 left_col">
     <div class="left_col scroll-view">
         <div class="navbar nav_title" style="border:0;">
             <a href="<?php echo base_url('aktivitas'); ?>" class="site_title"><i class="fa fa-home"></i><span> Madrasah Diniyah</span></a>
         </div>

         <div class="clearfix"></div>
         <!-- menu profile quick info -->
         <div class="profile clearfix">
             <div class="profile_pic">
                 <img src="<?php echo base_url(); ?>assets/image/mdnj2.png" alt="" class="img-circle profile_img">
             </div>
             <div class="profile_info">
                 <span>Selamat Datang</span>
                 <h2><?= nama_session(); ?></h2>
             </div>
         </div>

         <br />

         <!-- sidebar menu -->
         <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
             <div class="menu_section">
                 <h3>Menu</h3>
                 <!-- <h3>Administrator</h3> -->
                 <ul class="nav side-menu ">
                     <li><a href="<?php echo base_url('administrator'); ?>"><i class="fa fa-laptop"></i> Dashboard </a></li>
                     <!-- <h3>Piket</h3> -->
                     <?php if ($this->session->userdata('level') == 1) { ?>
                         <li><a href="<?php echo base_url('item_guru'); ?>"><i class="fa fa-bar-chart"></i> Data Guru </a></li>

                         <li><a href="<?php echo base_url('jadwal_pelajaran'); ?>"><i class="fa fa-newspaper-o"></i> Jadwal Pelajaran </a></li>

                         <li><a href="<?php echo base_url('absensi_guru'); ?>"><i class="fa fa-database"></i> Absensi Guru </a></li>
                         <li><a><i class="fa fa-bar-chart-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a href="<?php echo base_url('b_lap_guru'); ?>">Kehadiran Guru</a></li>
                                 <li><a href="<?php echo base_url('bisyaroh'); ?>">Bisyaroh</a></li>
                             </ul>
                         </li>


                         <!-- <li><a href="<?php echo base_url('bisyaroh'); ?>"><i class="fa fa-envelope-o"></i> Bisyaroh Guru </a></li> -->

                         <li><a href="<?php echo base_url('laporan_user'); ?>"><i class="fa fa-tasks"></i> Bisyaroh </a></li>

                         </br>
                         <h3>Pengaturan</h3>
                         </br>
                         <li><a><i class="fa fa-edit"></i>Administrasi
                                 <span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a href="<?php echo base_url('lembaga'); ?>">Daftar Lembaga</a></li>
                                 <li><a href="<?php echo base_url('kelas'); ?>">Daftar Kelas</a></li>
                                 <li><a href="<?php echo base_url('daftar'); ?>">Daftar Mepel</a></li>
                                 <li><a href="<?php echo base_url('jam_masuk'); ?>">Jam Masuk</a></li>
                                 <li><a href="<?php echo base_url('c_status'); ?>">Status Madin</a></li>
                                 <li><a href="<?php echo base_url('c_priode'); ?>">Tahun Priode</a></li>
                                 <li><a href="<?php echo base_url('jab_tunj'); ?>">Jabatan & Tunj</a></li>
                                 <li><a href="<?php echo base_url('daftar_tunj'); ?>">Nominal & Gapok</a></li>
                             </ul>
                         </li>
                         </h3>
                         </br>
                         <li><a href="<?php echo base_url('administrator/backup_db'); ?>"><i class="fa fa-undo"></i>Back Up<span class="label label-success pull-right">Database</span></a></li>


                     <?php } else if ($this->session->userdata('level') == 2) { ?>

                         <li><a href="<?php echo base_url('jadwal_pelajaran'); ?>"><i class="fa fa-newspaper-o"></i> Jadwal Pelajaran </a></li>

                         <li><a href="<?php echo base_url('absensi_guru'); ?>"><i class="fa fa-database"></i> Absensi Guru </a></li>
                         <li><a><i class="fa fa-bar-chart-o"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                             <ul class="nav child_menu">
                                 <li><a href="<?php echo base_url('b_lap_guru'); ?>">Kehadiran Guru</a></li>
                             </ul>
                         <li><a href="<?php echo base_url('laporan_user'); ?>"><i class="fa fa-tasks"></i> Bisyaroh </a></li>
                     <?php } else { ?>
                         <li><a href="<?php echo base_url('laporan_user'); ?>"><i class="fa fa-tasks"></i> Bisyaroh </a></li>

                     <?php } ?>
                 </ul>
             </div>
         </div>
         <!-- /sidebar menu -->
         <!-- /menu footer buttons -->
     </div>
     <!-- /menu footer buttons -->
 </div>

 <!-- top navigation -->
 <div class="top_nav">
     <div class="nav_menu">
         <nav>
             <div class="nav toggle">
                 <a id="menu_toggle"><i class="fa fa-bars"></i></a>
             </div>

             <ul class="nav navbar-nav navbar-right">
                 <li class="">
                     <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                         <img src="<?= base_url(); ?>assets/upload/<?= $this->session->userdata('gambar'); ?>" alt="">
                         <?= $this->session->userdata('nama'); ?>
                         <span class="fa fa-angle-down"></span>
                     </a>
                     <ul class="dropdown-menu dropdown-usermenu pull-right">
                         <li>
                             <a href="<?= base_url(); ?>administrator/edit_password">
                                 Ubah Password
                             </a>
                         </li>
                         <li><a href="<?= base_url(); ?>login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                     </ul>
                 </li>
             </ul>
         </nav>
     </div>
 </div>
 <!-- /top navigation -->