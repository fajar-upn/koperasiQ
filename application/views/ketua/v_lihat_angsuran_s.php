<div class="content-wrapper">
<div class="container-fluid">
  <div class="card p-2">
    <div class="row mb-2">
      <div class="col text-center">
         <h2 class="text-dark"><strong>Daftar Angsuran Anggota</strong></h2>
         <h5 class="text-dark">Posisi per <b> 31 Desember <?= $tahun ?></b></h5>
      </div>     
    </div>
    <hr class="m-0 mb-2">

    <div class="row mt-2">
        <div class="col">
          <div class="row mt-2">
            <div class="col-1">
               <a role="button" href="<?= base_url('ketua/tampil_angsuran');?>" class="btn btn-primary">Kembali</a>
            </div>
            <div class="col-2">
              <form style="margin-bottom: 0;" method="post" action="<?= base_url('ketua/cetak_angsuran');?>" target="_blank">
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
                          <th width="">Total Pinjaman</th>
                          <th width="">Total Angsuran Pokok</th>
                          <th width="">Total Jasa</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="text-center">
                          <td><b><?= rupiah2($total[0]['sumtotal']) ?></b></td>
                          <td><b><?= rupiah2($total[0]['sumangsur']) ?></b></td>
                          <td><b><?= rupiah2($total[0]['sumjasa']) ?></b></td>
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
                   <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr class="table-primary">
                          <th width="10%">ID Anggota</th>
                          <th width="20%">Nama</th>
                          <th width="20%">Total Pinjaman</th>
                          <th width="20%">Angsuran Pokok</th>
                          <th width="20%">Jasa</th>
                          <th width="20%">Angsuran Ke</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($anggota as $da ) : ?>
                        <tr>
                          <td><?= $da['id_anggota'] ?></td>
                          <td><?= $da['nama'] ?></td>
                          <td><?= rupiah2($da['total_pinjaman']) ?></td>
                          <td><?= rupiah2($da['angsuran_pokok']) ?></td>
                          <td><?= rupiah2($da['jasa']) ?></td>
                          <td><?= $da['angsuran_ke'] ?></td>
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
