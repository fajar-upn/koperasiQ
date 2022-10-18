<div class="content-wrapper">
<div class="container">
  <div class="row" style="padding-top: 20px">
    <div class="col-lg-12">

      <div class="card p-2  shadow-sm">
        <h3 class="text-center">Ubah Password</h3>
        <hr>
        
        <form action="<?= base_url('anggota/proses_ubah_password'); ?>" method="post">
          <div class="form-group">
            <label for="passwordLama">Password lama</label>
            <input type="password" class="form-control" name="passwordLama" id="passwordLama" aria-describedby="passwordLama">
            <?= form_error('passwordLama','<small class="text-danger pl-3">','</small>'); ?>
          </div>
          <div class="form-group">
            <label for="passwordBaru">Password baru</label>
            <input type="password" class="form-control" id="passwordBaru" name="passwordBaru" aria-describedby="passwordBaru">
            <?= form_error('passwordBaru','<small class="text-danger pl-3">','</small>'); ?>
          </div>
          <div class="form-group">
            <label for="ulangPasswordBaru">Ulang password baru</label>
            <input type="password" class="form-control" id="ulangPasswordBaru" name="ulangPasswordBaru" aria-describedby="ulangPasswordBaru">
          </div>
          <div class="text-center">
            <button type="submit" name="tambah" class="btn btn-success" style="width: 200px;">Input</button>
          </div>
          <div class="text-center mt-2">
            <a class="btn btn-primary" href="<?= base_url('anggota/');?>">Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
