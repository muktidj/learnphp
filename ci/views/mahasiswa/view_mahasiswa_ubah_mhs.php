<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">


            <div class="card">
                <div class="card-header">
                    Form Ubah Data MHS
                </div>
                <div class="card-body">

                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $mhs['id'];?>">
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Your Name" value="<?= $mhs['nama']; ?>">
                            <span class="text-danger"><?= form_error('nama'); ?></span>

                        </div>

                        <div class="form-group">
                            <label for="nrp">NRP</label>
                            <input type="number" class="form-control" id="nrp" name="nrp" placeholder="Your NRP" value="<?= $mhs['nrp']; ?>">
                            <span class="text-danger"><?= form_error('nrp'); ?></span>

                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Your Email" value="<?= $mhs['email'];  ?>">
                            <span class="text-danger"><?= form_error('email'); ?></span>
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan">
                                <?php foreach ($jurusan as $rowJurusan) : ?>
                                    <?php if ($rowJurusan == $mhs['jurusan']) : ?>

                                        <option value="<?= $rowJurusan; ?>" selected><?= $rowJurusan; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $rowJurusan; ?>"><?= $rowJurusan; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="ubah" class="btn btn-primary float-right">Ubah</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>