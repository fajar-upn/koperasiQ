<div class="content-wrapper">
<div class="container-fluid">

<?php if ($this->session->flashdata('pesan_sukses')) : ?>
      <div class="row">
        <div class="col-8">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <div class="col-6">
              Angsuran<strong> Berhasil</strong> <?= $this->session->flashdata('pesan_sukses'); ?>
               
          </div>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
        </div>
        
        </div>
      </div>
    <?php endif ?>
</div>

<div class="container-fluid mb-2">
  <div class="row">
    <div class="col">
      <h1 class="h3 mb-0 text-gray-800">Tambah Angsuran</h1>
    </div>
  </div>
  <div class="row mt-2">
    <div class="col-lg-6">

      <div class="card p-2  shadow-sm">
        <h4 class="text-center">Pilih Anggota</h4>
        <hr>
        <form action="<?= base_url('admin/tambah_angsuran') ?>" method="post">
          <div class="form-row">
            <div class="form-group col-lg-12">
              <h6>ID Anggota</h6>
              <select class="form-control" name="id_pinjaman" required>
                <option value="">Pilih Anggota</option>
                <?php foreach ($anggota as $d) {?>
                <option value="<?= $d['id_pinjaman']; ?>"><?= $d['id_anggota']; ?> - (<?= $d['nama']; ?>)</option>
              <?php }?>
              </select>
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