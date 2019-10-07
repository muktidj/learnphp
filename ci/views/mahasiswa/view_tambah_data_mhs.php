<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">


            <div class="card">
                <div class="card-header">
                    Form Tambah Data MHS
                </div>
                <div class="card-body">

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Your Name">
                            <span class="text-danger"><?= form_error('nama'); ?></span>

                        </div>

                        <div class="form-group">
                            <label for="nrp">NRP</label>
                            <input type="number" class="form-control" id="nrp" name="nrp" placeholder="Your NRP">
                            <span class="text-danger"><?= form_error('nrp'); ?></span>

                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Your Email">
                            <span class="text-danger"><?= form_error('email'); ?></span>
                        </div>

                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" id="jurusan" name="jurusan">
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Sistem Komputer">Sistem Komputer</option>
                            </select>
                        </div>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">Tambah</button>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>