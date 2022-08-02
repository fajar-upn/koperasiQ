<div class="content-wrapper">
<div class="container-fluid mb-2">
  <div class="row mt-2">
    <div class="col-lg-6">

      <div class="card p-2  shadow-sm">
        <h4 class="text-center">Lihat SHU Anggota</h4>
        <hr>
        <form action="<?= base_url('ketua/shu_anggota') ?>" method="post">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h6>Masukkan Tahun Anggaran</h6>
              <input type="text" class="form-control" name="tahun_post" onkeypress="return hanyaAngka(event)" required>
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