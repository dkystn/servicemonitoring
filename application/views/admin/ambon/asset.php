<div class="container mb-5" style="width: 80%;">
        <div class="row">
        <?php
            $fileUrl = base_url() . 'assets/excel/format soal excel.xlsx';
            $gambar = base_url() . 'assets/images/excel.jpg';
            ?>
            <div class="col-lg-6 mb-2">
                <div class="card" style="width: 18rem;">
                <img src="<?php echo $gambar; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">File Format Excel Soal</h5>
                        <p class="card-text">Petunjuk Penggunaan Ada Di File Excel</p>
                        <a href="<?php echo $fileUrl; ?>" download class="btn btn-danger">Download</a>
                    </div>
                </div>
            </div>
        </div>
</div>


<!---Container Fluid-->