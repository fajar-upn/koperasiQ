<div class="content-wrapper">
<div class="container-fluid">
  <div class="card p-2">
    <div class="row mb-2">
      <div class="col text-center">
         <h2 class="text-dark"><strong>Daftar Simpanan Anggota</strong></h2>
         <h5 class="text-dark">Posisi per <b> 31 Desember <?= $tahun ?></b></h5>
      </div>     
    </div>
    <hr class="m-0 mb-2">

    <div class="row mt-2">
        <div class="col">
          <div class="row mt-2">
            <div class="col-1">
               <a role="button" href="<?= base_url('ketua/tampil_simpanan');?>" class="btn btn-primary">Kembali</a>
            </div>
            <div class="col-2">
              <form style="margin-bottom: 0;" method="post" action="<?= base_url('ketua/cetak_simpanan');?>" target="_blank">
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
                        <tr class="table-primary">
                          <th width="">Total Simpanan Pokok</th>
                          <th width="">Total Simpanan Wajib</th>
                          <th width="">Total Simpanan Sukarela</th>
                          <th width="">Total Tabungan Lebaran</th>
                          <th width="">Total Simpanan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><b><?= rupiah($total[0]['tsimpanan_pokok']) ?></b></td>
                          <td><b><?= rupiah($total[0]['tsimpanan_wajib']) ?></b></td>
                          <td><b><?= rupiah($total[0]['tsimpanan_sukarela']) ?></b></td>
                          <td><b><?= rupiah($total[0]['tsimpanan_lebaran']) ?></b></td>
                          <td><b><?= rupiah($total[0]['tsimpanan_pokok']+$total[0]['tsimpanan_wajib']+$total[0]['tsimpanan_sukarela']+$total[0]['tsimpanan_lebaran']) ?></b></td>
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
                          <th width="">ID Anggota</th>
                          <th width="">Nama</th>
                          <th width="">Simpanan Pokok</th>
                          <th width="">Simpanan Wajib</th>
                          <th width="">Simpanan Sukarela</th>
                          <th width="">Tabungan Lebaran</th>
                          <th width="">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($anggota as $da ) : ?>
                        <tr>
                          <td><?= $da['id_anggota'] ?></td>
                          <td><?= $da['nama'] ?></td>
                          <td><?= rupiah($da['simpanan_pokok']) ?></td>
                          <td><?= rupiah($da['simpanan_wajib']) ?></td>
                          <td><?= rupiah($da['simpanan_sukarela']) ?></td>
                          <td><?= rupiah($da['simpanan_lebaran']) ?></td>
                          <td><?= rupiah($da['simpanan_pokok']+$da['simpanan_wajib']+$da['simpanan_sukarela']+$da['simpanan_lebaran']) ?></td>
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
