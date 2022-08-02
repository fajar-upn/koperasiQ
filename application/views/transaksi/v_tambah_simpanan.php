<div class="content-wrapper">
<div class="container-fluid mb-2">
  <div class="row">
    
    <?php if ($this->session->flashdata('pesan_sukses')) : ?>
      
        <div class="col-6">
          <div class="alert alert-success alert-dismissible fade show" role="alert">
              Simpanan<strong> Berhasil </strong> <?= $this->session->flashdata('pesan_sukses'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>
        </div>
    
<?php endif; ?>
  </div>
  <div class="row">
    <div class="col-lg-12">

      <div class="card p-2  shadow-sm">
        <h3 class="text-center">Tambah Simpanan</h3>
        <hr>
        <form action="<?= base_url('admin/tambah_simpanan') ?>" method="post" name="form_tambahsimpanan">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>ID Anggota</h5>
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
              <h5>Rp. Total Simpanan</h5>
              <input type="text" class="form-control" name="saldo" onkeypress="return hanyaAngka(event)" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Jenis Simpanan</h5>
              <select class="form-control" name="jenis" required>
                <option value="">Pilih Simpanan</option>
                <option value="Simpanan Pokok">Simpanan Pokok</option>
                <option value="Simpanan Wajib">Simpanan Wajib</option>
                <option value="Simpanan Sukarela">Simpanan Sukarela</option>
                <option value="Tabungan Lebaran">Tabungan Lebaran</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Tanggal</h5>
              <input type="date" class="form-control" name="tanggal" required>
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
<script>
  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }
</script>