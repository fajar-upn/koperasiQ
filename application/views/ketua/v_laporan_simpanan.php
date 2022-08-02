<style type="text/css">
  #sformulir{
  display: none;
}
#sformulir1{
  display: none;
}
</style>

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

<div style="margin-bottom: 1%;" class="container col">
  <a id="formButton1" href="#" class="btn-sm"><i class="fa fa-eye"></i> Lihat Semua Simpanan Anggota</a>
</div>

<div id="sformulir1" class="container-fluid mb-2">
  <div class="row">
    <div class="col-lg-6">

      <div class="card p-2  shadow-sm">
        <h4 class="text-center">Lihat Semua Simpanan Anggota</h4>
        <hr>
        <form action="<?= base_url('ketua/lihat_simpanan_all') ?>" method="post">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h6>Masukkan Tahun Anggaran</h6>
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

<div style="margin-top: 3%;margin-bottom: 1%;" class="container col">
  <a id="formButton" href="#" class="btn-sm"><i class="fa fa-eye"></i> Lihat Simpanan Per Anggota</a>
</div>

<div id="sformulir" class="container-fluid mb-2">
  <div class="row">
    <div class="col-lg-6">

      <div class="card p-2  shadow-sm">
        <h4 class="text-center">Lihat Simpanan Per Anggota</h4>
        <hr>
        <form action="<?= base_url('ketua/lihat_simpanan_a') ?>" method="post">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h6>Masukkan ID Anggota</h6>
              <select class="form-control" name="id_anggota" required>
                <option value="">Pilih Anggota</option>
                <?php foreach ($anggota as $d) {?>
                <option value="<?= $d['id_anggota']; ?>"><?= $d['id_anggota']; ?> - (<?= $d['nama']; ?>)</option>
              <?php }?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h6>Masukkan Tahun Anggaran</h6>
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
  $(document).ready(function() {
  $("#formButton").click(function() {
    $("#sformulir").toggle();
  });
});

  $(document).ready(function() {
  $("#formButton1").click(function() {
    $("#sformulir1").toggle();
  });
});
</script>