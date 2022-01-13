<br><br><br>
    <div class="container text-center" style="margin: 2em auto;">
    <h2 class="tex-center">Surat Permohonan</h2>

  </div>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="container">
            <!-- general form elements -->
          <div class="box box-primary" style="width:94%;">
            <!-- /.box-header -->
            <!-- form start -->
            <div class="container">
            <form action="<?=base_url('user/proses_datamasuk_insert')?>" role="form" method="post">
              <?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:91%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?php echo $this->session->flashdata('msg_berhasil');?>
               </div>
              <?php } ?>

              <?php if(validation_errors()){ ?>
              <div class="alert alert-warning alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Warning!</strong><br> <?php echo validation_errors(); ?>
             </div>
            <?php } ?>

            <div class="box-body">
                <div class="form-group form-group-lg" style="display:inline-block;">
                  <button type="reset" class="btn btn-basic" name="btn_reset" style="width:100px;"><i class="fa fa-eraser" aria-hidden="true"></i> Reset</button>
                </div>

                <div class="form-group form-group-lg">
                <label for="the_insured" style="margin-left:0px;display:inline;">1. Nama Tertanggung</label>
                  <select class="form-control" name="the_insured" style="margin-left:150px;width:50%;display:inline">
                    <option value="">Pilih</option>
                    <option value="fiberHome">PT. FiberHome Technologies Indonesia and/or BAKTI 
                      (Badan Aksesibilitas Telekomunikasi dan Informasi)</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="form-group form-group-lg">
                <label for="a_fiberHome" style="margin-left:0px;display:inline;">2. Alamat</label>
                  <select class="form-control" name="a_fiberHome" style="margin-left:230px;width:50%;display:inline">
                    <option value="">Pilih</option>
                    <option value="a_fiberHome">APL Tower, Jakarta Barat, RT.12/RW.6, Grogol, Grogol Petamburan, West Jakarta City, 
                      Jakarta 11440</option>
                    <option value="Lainnya">Lainnya</option>
                  </select>
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">3. Jenis Barang yang Dikirim, Quantity</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="provinsi" style="margin-left:0px;display:inline;">4. Pengiriman Melalui (Pilih, Darat Laut Perairan Udara)</label>
                  <input type="text" name="provinsi" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>

                <div class="form-group form-group-lg">
                  <label for="desa" style="margin-left:0px;display:inline;">Darat</label>
                  <input type="text" name="desa" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="kecamatan" style="margin-left:0px;display:inline;">a. Jenis Alat Angkut (Pilih, Truck / Pickup / Container / Lainnya</label>
                  <input type="text" name="kecamatan" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="nama_Barang" style="margin-left:0px;display:inline;">b. Plat Nomer</label>
                  <input type="text" name="nama_Barang" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="paket" style="margin-left:0px;display:inline;">c. Usia Kendaraan</label>
                  <input type="text" name="paket" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="batch_" style="margin-left:0px;display:inline;">d. No. SIM / Registrasi</label>
                  <input type="text" name="batch_" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">e. Pengemudi</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>

                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">Laut</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">a. Nama Kapal</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">b. Jenis Kapal</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">c. Usia Kapal</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">d. GRT Kapal</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>

                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">Udara</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">a. Jenis Pesawat</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">b. No. AWB (Pilih, Cargo Penumpang Helicopter Charter</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">5. Dari (Tempat Pemberangkatan)</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">Tujuan Akhir</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">6. Tanggal Keberangkatan</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">7. Batch Pertanggungan / Nilai Barang yang Diangkut</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
                <div class="form-group form-group-lg">
                  <label for="site_id" style="margin-left:0px;display:inline;">8. Lampiran Data Pendukung (-Bill of Landing [B/L], Letter of Credit [L/C], Invoice, Packing List, Delivery Order [DO]</label>
                  <input type="text" name="site_id" style="margin-left:150px;width:50%;display:inline;" class="form-control">
                </div>
            
              <!-- /.box-body -->
              <div class="box-footer" style="width:93%;">
                <a type="button" class="btn btn-default" style="width:10%;margin-right:26%" onclick="history.back(-1)" name="btn_kembali"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
                <button type="submit" style="width:20%" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i> Submit</button>
              </div>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#tabel_barangmasuk').DataTable();
  });
</script>
