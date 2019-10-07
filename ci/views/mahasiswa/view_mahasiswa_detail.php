<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">

            <div class="card">
                <h5 class="card-header"><?= $title; ?></h5>
                <div class="card-body">
                    <h5 class="card-title"><?= $mhs['nama']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?= $mhs['email']; ?></h6>
                    <p class="card-text"><?= $mhs['nrp'] ?></p>
                    <p class="card-text"><?= $mhs['jurusan'] ?></p>
                    <a href="<?= base_url('mahasiswa'); ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>

        </div>
    </div>
</div>