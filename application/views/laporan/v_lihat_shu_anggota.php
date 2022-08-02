<div class="content-wrapper">
<div class="container-fluid">
  <div class="card p-2">
    <div class="row mb-2">
      <div class="col text-center">
         <h2 class="text-dark"><strong>Laporan SHU Anggota</strong></h2>
         <h5 class="text-dark">Posisi per <b> 31 Desember <?= $tahun ?></b></h5>
      </div>     
    </div>
    <hr class="m-0 mb-2">

    <div class="row mt-2">
        <div class="col">
          <div class="row mt-2">
            <div class="col-1">
               <a role="button" href="<?= base_url('admin/shu_anggota');?>" class="btn btn-primary">Kembali</a>
            </div>
            <div class="col-2">
              <form style="margin-bottom: 0;" method="post" action="<?= base_url('admin/cetak_shu_anggota');?>" target="_blank">
                <input type="text" class="form-control" name="tahun_post" value="<?= $tahun ?>" hidden required>
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
                   <table class="table table-bordered table-hover" id="example1" width="100%" cellspacing="0">
                      <thead>
                        <tr class="table-primary">
                          <th width="">ID Anggota</th>
                          <th width="">Nama</th>
                          <th width="">Total Simpanan</th>
                          <th width="">SHU Anggota Penyimpan</th>
                          <th width="">Total Jasa</th>
                          <th width="">SHU Anggota Berjasa</th>
                          <th width="">Total SHU Anggota</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=0; foreach ($simpanan as $da ) : ?>
                        <tr>
                          <td><?= $da['id_anggota'] ?></td>
                          <td><?= $da['nama'] ?></td>
                          <td><?= rupiah($da['total_simpanan']) ?></td>
                          <td><?= rupiah($da['shu_penyimpan']) ?></td>
                          <td><?= rupiah($jasa[$i]['total_jasa']) ?></td>
                          <td><?= rupiah($jasa[$i]['shu_jasa']) ?></td>
                          <td><?= rupiah($da['shu_penyimpan']+$jasa[$i]['shu_jasa']) ?></td>
                        </tr>
                        <?php $i++; ?>
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
