<div class="content-wrapper">
<div class="container-fluid">
  <div class="card p-2">
    <div class="row mb-2">
      <div class="col text-center">
         <h2 class="text-dark"><strong>Daftar Pinjaman Anggota</strong></h2>
         <h5 class="text-dark">Posisi per <b> 31 Desember <?= $tahun ?></b></h5>
      </div>     
    </div>
    <hr class="m-0 mb-2">

    <div class="row mt-2">
        <div class="col">
          <div class="row mt-2">
            <div class="col-1">
               <a role="button" href="<?= base_url('admin/tampil_pinjaman');?>" class="btn btn-primary">Kembali</a>
            </div>
            <div class="col-2">
              <form style="margin-bottom: 0;" method="post" action="<?= base_url('admin/cetak_pinjaman');?>" target="_blank">
                <input type="text" class="form-control" name="tahun" value="<?= $tahun ?>" hidden required>
                <button type="submit" class="btn btn-secondary"><i class="fa fa-file-pdf"></i> Cetak</button>  
              </form>
           </div>
         </div>
       </div>
     </div>
 </div>

<div class="row mt-2 ">

          <div class="col">
          <div class="card p-2">
            <div class="row">
              <div class="col">
                  <div class="table-responsive">
                   <table class="table table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr class="table-primary text-center">
                          <th width="">Total Pinjaman Posisi Per 31 Desember <?= $tahun ?></th>
                          <th width="">Total Sisa Pinjaman Posisi Per 31 Desember <?= $tahun ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="text-center">
                          <td><b><?= rupiah2($total[0]['sumtotal']) ?></b></td>
                          <td><b><?= rupiah2($total[0]['sumsisa']) ?></b></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
        <div class="row mt-2 ">

          <div class="col">
          <div class="card p-2">
            <div class="row">
              <div class="col">
                  <div class="table-responsive">
                   <table class="table table-bordered table-hover" id="example1" width="100%" cellspacing="0">
                      <thead>
                        <tr class="table-primary">
                          <th width="10%">ID Anggota</th>
                          <th width="20%">Nama</th>
                          <th width="30%">Alamat</th>
                          <th width="20%">Total Pinjaman</th>
                          <th width="20%">Sisa Pinjaman</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($anggota as $da ) : ?>
                        <tr>
                          <td><?= $da['id_anggota'] ?></td>
                          <td><?= $da['nama'] ?></td>
                          <td><?= $da['alamat'] ?></td>
                          <td><?= rupiah($da['total_pinjaman']) ?></td>
                          <td><?= rupiah($da['sisa_pinjaman']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
