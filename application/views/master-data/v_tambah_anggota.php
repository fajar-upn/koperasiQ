<div class="content-wrapper">
<div class="container-fluid mb-2">
  <div class="row">
    <div class="col-lg-12">

      <div class="card p-2  shadow-sm">
        <h3 class="text-center">Tambah Data Anggota</h3>
        <hr>
        <form action="<?= base_url('admin/tambah_anggota') ?>" method="post" name="form_tambahanggota" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>ID Anggota</h5>
              <input type="text" class="form-control" name="id_anggota" value="<?= $id_anggota; ?>" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Nama Anggota</h5>
              <input type="text" class="form-control" name="nama" maxlength="50" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Alamat</h5>
              <textarea class="form-control" name="alamat" maxlength="150" rows="5" required></textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Upload Foto</h5>
              <!-- <input type="file" name="userfile" class="form-control" size="20" required> -->
              <div class="custom-file mb-3 col-md-4">
                <input type="file" name='foto' class="form-control custom-file-input" size=20 id="foto" required>
                <label class="custom-file-label" for="foto">Choose file...</label>
              </div>
            </div> 
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Email</h5>
              <input type="text" class="form-control" name="email" maxlength="100" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Password</h5>
              <input type="password" class="form-control" name="password" maxlength="50" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Confirm Password</h5>
              <input type="password" class="form-control" name="confirm_password" maxlength="50" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>role</h5>
              <input type="text" class="form-control" name="role" maxlength="10" required>
            </div>
          </div>
          <input type="text" class="form-control" name="status" value="Aktif" required hidden>
          <div class="text-center">
            <button type="submit" name="tambah" class="btn btn-success" style="width: 200px;">Input</button>
          </div>
          <div class="text-center mt-2">
            <a class="btn btn-primary" href="<?= base_url('admin/data_anggota');?>">Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>