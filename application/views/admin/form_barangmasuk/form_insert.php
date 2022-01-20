<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CRUD Database | Data Masuk</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/web_admin/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>assets/datetimepicker/css/bootstrap-datetimepicker.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('admin')?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>JIS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">PT <b> Jasmine</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php foreach($avatar as $a){?>
              <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="user-image" alt="User Image">
              <?php } ?>
              <span class="hidden-xs"><?=$this->session->userdata('name')?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php foreach($avatar as $a){ ?>
                <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="img-circle" alt="User Image">
                <?php } ?>

                <p>
                  <?=$this->session->userdata('name')?> - Web Developer
                  <small>Last Login: <?=$this->session->userdata('last_login')?></small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?= base_url('admin/profile')?>" class="btn btn-default btn-flat"><i class="fa fa-cogs" aria-hidden="true"></i> Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?= base_url('admin/sigout')?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i> Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php foreach($avatar as $a){ ?>
          <img src="<?php echo base_url('assets/upload/user/img/'.$a->nama_file)?>" class="img-circle" alt="User Image">
          <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?=$this->session->userdata('name')?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?= base_url('admin')?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
          <!-- <ul class="treeview-menu">
            <li><a href="<?php echo base_url()?>assets/web_admin/index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="<?php echo base_url()?>assets/web_admin/index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> -->
        </li>

        <li class="treeview active">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?= base_url('admin/form_barangmasuk')?>"><i class="fa fa-circle-o"></i> Tambah Data Masuk</a></li>
            <li><a href="<?= base_url('admin/form_satuan')?>"><i class="fa fa-circle-o"></i> Tambah Paket Barang</a></li>
          </ul>
        </li>
        <li class="treeview ">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('admin/tabel_barangmasuk')?>"><i class="fa fa-circle-o"></i> Tabel Data Masuk</a></li>
            <li><a href="<?= base_url('admin/tabel_barangkeluar')?>"><i class="fa fa-circle-o"></i> Tabel Data Keluar</a></li>
            <li><a href="<?= base_url('admin/tabel_satuan')?>"><i class="fa fa-circle-o"></i> Tabel Satuan</a></li>
          </ul>
        </li>
        <li>
        <li class="header">LABELS</li>
        <li>
          <a href="<?php echo base_url('admin/profile')?>">
         <i class="fa fa-cogs" aria-hidden="true"></i> <span>Profile</span></a>
        </li>
        <li>
          <a href="<?php echo base_url('admin/users')?>">
         <i class="fa fa-fw fa-users" aria-hidden="true"></i> <span>Users</span></a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Input Data Masuk
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Data Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" style="">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="container">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-archive" aria-hidden="true"></i> Tambah Data Masuk</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="container">
              <div id="user_message" style="display:inline-block"></div>
              <form id="form_insert_site" method="post" autocomplete="off" accept-charset="utf-8"style="width:95%;margin-left:10px">   
                <div>                
                  <label for="dummy_id" style="display:none;">ID</label>
                  <input type="text" name="dummy_id" style="margin-left:37px;width:20%;display:none;" class="form-control" readonly="readonly" value="<?=random_string('alpha', 10);?><?=random_string('sha1');?>">
                </div>  
                
		            <div class="form-group form-group-lg">
                  <label for="site_id">1. Nama Tertanggung</label>
                  <select class="form-control" name="the_insured">
                    <option value="">Pilih</option>
                    <option value="fiberHome">PT. FiberHome Technologies Indonesia and/or BAKTI 
                      (Badan Aksesibilitas Telekomunikasi dan Informasi)</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
               
                <div class="form-group form-group-lg">
                  <label for="site_id">2. Alamat</label>
                  <select class="form-control" name="a_fiberHome">
                    <option value="">Pilih</option>
                    <option value="a_fiberHome">APL Tower, Jakarta Barat, RT.12/RW.6, Grogol, Grogol Petamburan, West Jakarta City, 
                      Jakarta 11440</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>

                <div class="form-group form-group-lg">
                  <label for="site_id">3. Jenis Barang yang Dikirim</label>
                  <input type="text" name="site_id" style="margin-left:15px;width:50%;display:inline;" class="form-control" placeholder="Jenis Barang">
                  <label for="qty" style="margin-left:20px;width:13%">Quantity</label>
                  <input type="number" name="qty" style="width:12%;margin-left:-80px;display:inline;" class="form-control" id="qty" placeholder="@ pcs">
                </div>

                <table id="cart_table" class="table table-sm table-stripped table-hover">
                    <thead>
                        <tr>
                            <th width="80%">3. Jenis Barang yang Dikirim</th>
                            <th width="20%">Quantity</th>
                            <th width="5%"></th>
                        </tr>
                        <tr>
                        </tr> 
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="txtTitle[]" placeholder="Jenis Barang" required="required" class="form-control"/>
                                </div>
                            </td> 
                            <td>
                                <div class="form-group">
                                    <input type="number" name="txtDescription[]" class="form-control" placeholder="@ pcs" required="required"/>
                                </div>
                            </td>
                            
                            <td>
                                <button id="addItem" name="addItem" type="button" class="btn btn-success btn-block btn-sm add_button"><i style="color:#fff" class="fa fa-plus-circle"></i></button>
                                <button id="removeItem" name="removeItem" type="button" class="btn btn-danger btn-block btn-sm remove_button"><i style="color:#fff;" class="fa fa-trash-o"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-center">
                                <input type="submit" id="btnSave" name="btnSave" value="Create" class="btn btn-md btn-success" />
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
              </form>
            </div>
          </div>
          
          <!-- /.box -->

          <!-- Form Element sizes -->

          <!-- /.box -->


          <!-- /.box -->

          <!-- Input addon -->

          <!-- /.box -->

            </div>
        <!--/.col (left) -->
        <!-- right column -->
        <!-- <div class="col-md-6">
          <!-- Horizontal Form -->

          <!-- /.box -->
          <!-- general form elements disabled -->

          <!-- /.box -->

          </div>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
       <b>Version</b> 1
    </div>
    <strong>Copyright &copy; <?=date('Y')?></strong>
  </footer>

   
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url()?>assets/web_admin/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url()?>assets/web_admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url()?>assets/web_admin/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url()?>assets/web_admin/dist/js/adminlte.min.js"></script>
  <script src="<?php echo base_url()?>assets/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url()?>assets/web_admin/dist/js/demo.js"></script>

  <script type="text/javascript">
      $(".form_datetime").datetimepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayBtn: true,
        pickTime: false,
        minView: 2,
        maxView: 4,
      });
  </script>

  <script src="<?php echo base_url("assets/js/jquery.min.js");?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        var i = 1, max = 50;
        var cartTable = {
            options: {
                table: "#cart_table"
            },
            initialize: function() {
                this.setVars().events();
            },
            setVars: function() {
                this.$table = $(this.options.table);
                this.$totalLines = $(this.options.table).find('tr').length - 1;
                return this;
            },
            updateLines: function() {
                var totalLines = $(this.options.table).find('tr').length - 1;
                if (totalLines == 1) {
                    $('.add_button').show();
                    $('.remove_button').hide();
                }
                return this;
            },
            events: function() {
                var _self = this;
                _self.updateLines();
                this.$table.on('click', 'button.add_button', function(e) {
                    e.preventDefault();
                    if(max > i) {
                        var $tr = $(this).closest('tr');
                        var $clone = $tr.clone();
                        $clone.find(':text').val('');
                        $tr.after($clone);
                        if (_self.setVars().$totalLines > 1) {
                            $('.remove_button').show();
                            $('.add_button').show();
                        }
                        i++;
                    }
                }).on('click', 'button.remove_button', function(e) {
                    if (i > 1) {
                        e.preventDefault();
                        var $tr = $(this).closest('tr');
                        $tr.remove();
                        //if have delete last button with button add visible, add another button to last tr
                        if (_self.setVars().$totalLines > 1) {
                            _self.$table.find('tr:last').find('.add').show();
                        }
                        i--;
                    }
                });

                return this;
            }
        };

        function initializeCartTable() {
            cartTable.initialize();
        }
        window.addEventListener('load', initializeCartTable, false);
    </script>

    <script>
        var display_bill_table = "";
        $(document).ready(function() {

            display_bill_table = $('#display_bill_table').DataTable({
                "ajax": {
                    url : '<?php echo base_url("main/get_display_bills"); ?>',
					type : 'GET'
                },
            });

            $('#display_bill_table tbody').on( 'click', 'button', function () {
                if(this.name == "btnDelete") {
                    var isDelete = confirm("Once you delete the Bill, it will remove permanantly.");
                    if(isDelete) {
                        delete_bill(this.id);
                    } 
                }
            });

            $('#form_insert_site').submit(function(e) {
                e.preventDefault();
                var data = $("#form_insert_site").serialize();
                $.ajax({
                    type:"POST",
                    url:'<?php echo base_url("main/add_to_cart"); ?>',
                    data: data,
                    success: function(data) {
                        $("#user_message").html(data);
                        $(":text").val('');
                        display_bill_table.ajax.reload();
                    },
                });
            });
            //end

            $('#cart_table').keyup(function(e) {
                calculate_total();
            });
        });

        function delete_bill(id) {
            $.ajax({
                    type:"POST",
                    url:'<?php echo base_url("main/delet_single_bill"); ?>',
                    data: {_id:id},
                    success: function(data) {
                        $("#user_message").html(data);
                        display_bill_table.ajax.reload();
                    },
                });
        }

        function calculate_total() {
            var grand_total = 0;
            $('#cart_table> tbody> tr').each(function(index, tr) { 
                var sum = 0;
                var amount = count = 0;
                $(this).find('.combat').each(function(inner_index) {
                    if(inner_index == 0) count = $(this).val();               
                    if(inner_index == 1) amount = $(this).val();     
                    if(amount != 0 && count != 0) {
                        sum = parseFloat(count) * parseFloat(amount);;
                    }
                });
                $('.forTotal',this).val(sum); 
                grand_total += sum; 
            });
            $("#txtGrandTotal").val(grand_total);
        }
    </script>
  </body>

  
  </html>
