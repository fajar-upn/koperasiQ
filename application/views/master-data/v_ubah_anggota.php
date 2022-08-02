<div class="content-wrapper">
<div class="container-fluid mb-2">
  <div class="row">
    <div class="col-lg-12">

      <div class="card p-2  shadow-sm">
        <h3 class="text-center">Ubah Data Anggota</h3>
        <hr>

        <form action="<?= base_url().'/admin/ubahAnggotaProses/'.$anggota['id_anggota']; ?>" method="post" name="form_ubahanggota" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>ID Anggota</h5>
              <input type="text" class="form-control" name="id_anggota" value="<?= $anggota['id_anggota']; ?>" readonly>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Nama Anggota</h5>
              <input type="text" class="form-control" name="nama" value="<?= $anggota['nama']; ?>" maxlength="50" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Alamat</h5>
              <textarea class="form-control" name="alamat" maxlength="150" rows="5" required><?= $anggota['alamat']; ?></textarea>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Upload Foto</h5>
              <!-- <input type="file" name="userfile" class="form-control" size="20" required> -->
              <div class="custom-file mb-3 col-md-4">
                <input type="file" name='foto' class="form-control custom-file-input" value="<?= $anggota['foto']; ?>" size=20 id="foto">
                <label class="custom-file-label" for="foto">Choose file...</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Email</h5>
              <input type="text" class="form-control" name="email" value="<?= $anggota['email']; ?>" maxlength="100" required>
            </div>
          </div>
          <!-- <div class="form-row">
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
          </div> -->
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>role</h5>
              <input type="text" class="form-control" value="<?= $anggota['role']; ?>" name="role" maxlength="10" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h5>Status Anggota</h5>
              <select class="form-control" name="status" required>
                <option selected><?= $anggota['status']; ?></option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
              </select>
            </div>
          </div>
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