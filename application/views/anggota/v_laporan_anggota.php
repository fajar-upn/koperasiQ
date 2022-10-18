<div class="content-wrapper">
<div class="container-fluid">

<?php if ($this->session->flashdata('pesan_sukses')) : ?>
      <div class="row">
        <div class="col-8">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <div class="col-6">
              Data Simpanan<strong> Berhasil</strong> <?= $this->session->flashdata('pesan_sukses'); ?>
          </div>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
        </div>
        
        </div>
      </div>
<?php elseif ($this->session->flashdata('pesan_error')) : ?>
      <div class="row">
        <div class="col-8">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <div class="col-6">
              Data Simpanan<strong> Gagal</strong> <?= $this->session->flashdata('pesan_error'); ?> 
          </div>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
        </div>
        
        </div>
      </div>

<?php endif; ?>
</div>

<div id="sformulir1" class="container mb-2">
  <div class="row">
    <div class="col-lg-6 mt-3">
      <div class="card p-2 shadow-sm">
        <h4 class="text-center">Lihat Simpanan </h4>
        <hr>
        <form action="<?= base_url('anggota/lihat_simpanan_anggota') ?>" method="post">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h6>Masukkan Tahun Simpanan</h6>
              <input type="text" class="form-control" name="tahun" onkeypress="return hanyaAngka(event)" required>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" name="tambah" class="btn btn-success" style="width: 200px;">Input</button>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-6 mt-3">
    <div class="card p-2 shadow-sm">
        <h4 class="text-center">Lihat Angsuran</h4>
        <hr>
        <form action="<?= base_url('anggota/lihat_angsuran_anggota') ?>" method="post">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h6>Masukkan Tahun Angsuran</h6>
              <input type="text" class="form-control" name="tahun" onkeypress="return hanyaAngka(event)" required>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" name="tambah" class="btn btn-success" style="width: 200px;">Input</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="sformulir2" class="container mb-2">
  <div class="row">
    <div class="col-lg-6">

      <div class="card p-2 shadow-sm">
        <h4 class="text-center">Lihat Pinjaman</h4>
        <hr>
        <form action="<?= base_url('anggota/lihat_pinjaman_anggota') ?>" method="post">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h6>Masukkan Tahun Pinjaman</h6>
              <input type="text" class="form-control" name="tahun" onkeypress="return hanyaAngka(event)" required>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" name="tambah" class="btn btn-success" style="width: 200px;">Input</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


</div>
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script>
  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }
</script>
<script>
//   $(document).ready(function() {
//   $("#formButton").click(function() {
//     $("#sformulir").toggle();
//   });
// });

</script>
