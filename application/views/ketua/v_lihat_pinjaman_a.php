<div class="content-wrapper">
<div class="container-fluid">
  <div class="card p-2">
    <div class="row mb-2">
      <div class="col text-center">
         <h2 class="text-dark"><strong>Daftar Pinjaman</strong></h2>
         <h4 class="text-dark"><b><?= $nama['nama'] ?></b></h4>
         <h5 class="text-dark">Posisi per <b> 31 Desember <?= $tahun ?></b></h5>
      </div>     
    </div>
    <hr class="m-0 mb-2">

    <div class="row mt-2">
        <div class="col">
          <div class="row mt-2">
            <div class="col-1">
               <a role="button" href="<?= base_url('ketua/tampil_pinjaman');?>" class="btn btn-primary">Kembali</a>
            </div>
            <div class="col-2">
              <form style="margin-bottom: 0;" method="post" action="<?= base_url('ketua/cetak_pinjaman_a');?>" target="_blank">
                <input type="text" class="form-control" name="tahun" value="<?= $tahun ?>" hidden required>
                <input type="text" class="form-control" name="id_anggota" value="<?= $nama['id_anggota'] ?>" hidden required>
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
                          <th width="10%">Bukti Transaksi</th>
                          <th width="">Tanggal Pinjam</th>
                          <th width="">Total Pinjaman</th>
                          <th width="">Lama Angsuran</th>
                          <th width="">Status Pinjaman</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($anggota as $da ) : ?>
                        <tr>
                          <td><?= $da['bukti_transaksi_p'] ?></td>
                          <td><?= $da['tanggal_pinjam'] ?></td>
                          <td><?= rupiah2($da['nominal']) ?></td>
                          <td><?= $da['lama_angsur'] ?></td>
                          <td><?= $da['status_pinjam'] ?></td>
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
