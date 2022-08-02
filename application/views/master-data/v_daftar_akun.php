<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="h3 mb-0 text-gray-800">Daftar Akun</h1>
          </div>
        </div>
        <div class="row">
    
            <?php if ($this->session->flashdata('pesan_sukses')) : ?>
              
                <div class="col-6">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                      Data Akun<strong> Berhasil </strong> <?= $this->session->flashdata('pesan_sukses'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                </div>
            
        <?php endif; ?>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row mt-2">
                  <div class="col">
                    <div class="row mt-2">
                      <div class="col-2">
                         <a role="button" href="<?= base_url();?>admin/tambah_daftarakun" class="btn btn-success" style="width: 100%;">Tambah Data</a>
                      </div>
                      <div class="col-2">
                         <a role="button" href="<?= base_url();?>admin/cetak_daftarakun" class="btn btn-secondary" target="_blank"><i class="fa fa-file-pdf"></i> Cetak</a>
                     </div>
                   </div>
                 </div>
               </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="table-primary">
                      <th width="">Kode Akun</th>
                      <th width="">Akun Perkiraan</th>
                      <th width="">Pos Akun</th>
                      <th width="">Pos Laporan</th>
                      <th width="">Saldo Normal</th>
                      <th width="10%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                        <?php foreach ($daftar_akun as $da ) : ?>
                        <tr>
                          <td><?= $da['kode_akun']?></td>
                          <td><?= $da['akun'] ?></td>
                          <td><?= $da['pos_akun'] ?></td>
                          <td><?= $da['pos_laporan'] ?></td>
                          <td><?= $da['saldo_normal'] ?></td>
                          <td class="d-flex align-items-center">
                            <a href="<?= base_url(); ?>admin/ubahDaftarakun/<?= $da['kode_akun']; ?>" class="btn-sm btn-success"><i class="fa fa-pen"></i></a>
                            <a href="<?= base_url(); ?>admin/hapusDaftarakun/<?= $da['kode_akun'];?>" class="btn-sm btn-danger ml-1"><i class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

