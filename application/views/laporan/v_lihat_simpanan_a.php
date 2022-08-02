<div class="content-wrapper">
<div class="container-fluid">
  <div class="card p-2">
    <div class="row mb-2">
      <div class="col text-center">
         <h2 class="text-dark"><strong>Daftar Simpanan</strong></h2>
         <h4 class="text-dark"><b><?= $anggota[0]['nama'] ?></b></h4>
         <h5 class="text-dark">Posisi per <b> 31 Desember <?= $tahun ?></b></h5>
      </div>     
    </div>
    <hr class="m-0 mb-2">

    <div class="row mt-2">
        <div class="col">
          <div class="row mt-2">
            <div class="col-1">
               <a role="button" href="<?= base_url('admin/tampil_simpanan');?>" class="btn btn-primary">Kembali</a>
            </div>
            <div class="col-2">
              <form style="margin-bottom: 0;" method="post" action="<?= base_url('admin/cetak_simpanan_a');?>" target="_blank">
                <input type="text" class="form-control" name="tahun" value="<?= $tahun ?>" hidden required>
                <input type="text" class="form-control" name="id_anggota" value="<?= $anggota[0]['id_anggota'] ?>" hidden required>
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
                        <tr class="table-primary">
                          <th width="">Total Simpanan Pokok</th>
                          <th width="">Total Simpanan Wajib</th>
                          <th width="">Total Simpanan Sukarela</th>
                          <th width="">Total Tabungan Lebaran</th>
                          <th width="">Total Simpanan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($anggota as $da ) : ?>
                        <tr>
                          <td><b><?= rupiah($da['simpanan_pokok']) ?></b></td>
                          <td><b><?= rupiah($da['simpanan_wajib']) ?></b></td>
                          <td><b><?= rupiah($da['simpanan_sukarela']) ?></b></td>
                          <td><b><?= rupiah($da['simpanan_lebaran']) ?></b></td>
                          <td><b><?= rupiah($da['simpanan_pokok']+$da['simpanan_wajib']+$da['simpanan_sukarela']+$da['simpanan_lebaran']) ?></b></td>
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

        <div class="row mt-2 ">

          <div class="col">
          <div class="card p-2">
            <div class="row">
              <div class="col">
                  <div class="table-responsive">
                   <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                      <thead>
                        <tr class="table-primary">
                          <th width="">Bukti Transaksi</th>
                          <th width="">Saldo</th>
                          <th width="">Jenis Simpanan</th>
                          <th width="">Tanggal</th>
                          <th width="10%">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($anggota1 as $da ) : ?>
                        <tr>
                          <td><?= $da['bukti_transaksi_s'] ?></td>
                          <td><?= rupiah($da['saldo']) ?></td>
                          <td><?= $da['jenis_simpanan'] ?></td>
                          <td><?= $da['tanggal'] ?></td>
                          <td><a href="<?= base_url(); ?>admin/editsimpanan/<?= $da['id_simpanan']; ?>" class="btn-sm btn-success"><i class="fa fa-pen"></i></a>
                            <a href="<?= base_url(); ?>admin/hapussimpanan/<?= $da['id_simpanan'];?>" class="btn-sm btn-danger ml-1"><i class="fa fa-trash"></i></a>
                          </td>
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
