<div class="content-wrapper">
<div class="container-fluid mb-2">
  <div class="row">
    <div class="col-lg-12">

      <div class="card p-2  shadow-sm">
        <h3 class="text-center">Tambah Angsuran</h3>
        <h3 class="text-center">"<?= $angsuran[0]['id_anggota']; ?> - (<?= $angsuran[0]['nama']; ?>)"</h3>
        <hr>
        <form action="<?= base_url('admin/insert_angsuran') ?>" method="post" name="form_tambahangsuran">
          <input type="text" class="form-control" value="<?= $angsuran[0]['id_pinjaman']; ?>" name="id_pinjaman" hidden required>
          <input type="text" class="form-control" value="<?= $angsuran[0]['id_anggota']; ?>" name="id_anggota" hidden required>
          <input type="text" class="form-control" value="<?= $angsuran[0]['bunga']; ?>" name="bunga" hidden required>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Bukti Transaksi</h5>
              <input type="text" class="form-control" value="<?= $angsuran[0]['bukti_transaksi_an']; ?>" name="bukti_transaksi_an" readonly required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Tanggal Pinjam</h5>
              <input type="date" class="form-control" value="<?= $angsuran[0]['tanggal_pinjam']; ?>" disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Periode Angsuran</h5>
              <input type="text" class="form-control" value="<?= $angsuran[0]['periode_angsuran']; ?>" name="periode_angsuran" readonly required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Total Pinjaman</h5>
              <input type="text" class="form-control" value="<?= rupiah2($angsuran[0]['nominalp']); ?>" disabled>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Jasa %</h5>
              <input type="text" class="form-control" value="<?= $angsuran[0]['jasa']; ?>" name="jasa" readonly required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Lama Angsuran</h5>
              <input type="text" class="form-control" value="<?= $angsuran[0]['lama_angsur']; ?>" name="lama_angsur" readonly required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Total Angsuran yang Dibayar</h5>
              <input type="text" class="form-control" value="<?= rupiah2($angsuran[0]['nominal']); ?>" disabled>
              <input type="text" class="form-control" value="<?= $angsuran[0]['nominal']; ?>" name="nominal" hidden required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Tanggal Mengangsur</h5>
              <input type="date" class="form-control" name="tanggal" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Keterangan</h5>
              <input type="text" class="form-control" name="keterangan" required>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" name="tambah" class="btn btn-success" style="width: 200px;">Input</button>
          </div>
          <div class="text-center mt-2">
            <a class="btn btn-primary" href="<?= base_url('admin/angsuran');?>">Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>