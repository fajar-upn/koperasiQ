<div class="content-wrapper">
<div class="container" style="padding-top:20px">
  <div class="card p-2">
    <div class="row mb-2">
      <div class="col text-center">
         <h2 class="text-dark"><strong>Daftar Angsuran <?= $user ?></strong></h2>
         <h5 class="text-dark">Posisi per <b> 31 Desember <?= $tahun ?></b></h5>
      </div>     
    </div>
    <hr class="m-0 mb-2">

    <div class="row mt-2">
        <div class="col">
          <div class="row mt-2">
            <div class="col-1">
               <a role="button" href="<?= base_url('anggota/tampil_simpanan');?>" class="btn btn-primary">Kembali</a>
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
    </div>
</div>
