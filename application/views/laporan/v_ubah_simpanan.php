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
        <h3 class="text-center">Ubah Simpanan</h3>
        <hr>
        <form action="<?= base_url('admin/ubah_simpanan') ?>" method="post" name="form_ubahsimpanan">
          <input type="text" class="form-control" value="<?= $anggota['id_simpanan'] ?>" name="id_simpanan" hidden>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Bukti Transaksi</h5>
              <input type="text" class="form-control" value="<?= $anggota['bukti_transaksi_s'] ?>" name="bukti_transaksi_s" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>ID Anggota</h5>
              <input type="text" class="form-control" value="<?= $anggota['id_anggota'] ?>" name="id_anggota" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Rp. Total Simpanan</h5>
              <input type="text" class="form-control" value="<?= $anggota['saldo'] ?>" name="saldo" onkeypress="return hanyaAngka(event)" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Jenis Simpanan</h5>
              <select class="form-control" name="jenis" required>
                <option value="<?= $anggota['jenis_simpanan'] ?>"><?= $anggota['jenis_simpanan'] ?></option>
                <option value="Simpanan Pokok">Simpanan Pokok</option>
                <option value="Simpanan Wajib">Simpanan Wajib</option>
                <option value="Simpanan Sukarela">Simpanan Sukarela</option>
                <option value="Simpanan Lebaran">Simpanan Lebaran</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Tanggal</h5>
              <input type="date" class="form-control" value="<?= $anggota['tanggal'] ?>" name="tanggal" required>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" name="tambah" class="btn btn-success" style="width: 200px;">Input</button>
          </div>
          <div class="text-center mt-2">
            <a class="btn btn-primary" href="<?= base_url('admin/tampil_simpanan');?>">Kembali</a>
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