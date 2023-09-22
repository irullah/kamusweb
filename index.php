<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Translate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <ul class="nav justify-content-end nav-underline">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Active</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
        </ul>
  </div>
</nav>

<div style="background-color: #0099ff;">
<div class="container">
  <div style="padding-top: 60px;" class="row">
    <div class="col-3">
        <div class="alert text-left alert-warning" role="alert">
            <h4 class="alert-heading">Petunjuk</h4>
            <p class="mb-0">Menuliskan <strong>^a</strong> berubah menjadi <strong>â</strong></p>
            <p class="mb-0">Menuliskan <strong>`e</strong> berubah menjadi <strong>è</strong><br><br>Contoh :</p>
            <ul>
                <li>
                    <strong>l`eker</strong> &rarr; <strong>lèker</strong>
                </li>
                <li>
                    <strong>ad^a'</strong>  &rarr; <strong>adâ'</strong>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-9">
        <form action="" method="get">
            <h1 class="text-center" >Kamus Bahasa Madura - Indonesia</h1>
            <div class="input-group mb-3">
                <input name="kata" type="cari" class="form-control" placeholder="Kata" aria-label="Kata" aria-describedby="button-addon2" id="kunci" onchange="myFunction(this.value)">
                <button class="btn btn-primary" type="submit" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    Cari
                </button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200"><path fill="#0099ff" fill-opacity="1" d="M0,128L120,122.7C240,117,480,107,720,90.7C960,75,1200,53,1320,42.7L1440,32L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"></path></svg>
<div class="row">
    <div class="col-1"></div>
    <div class="col-10">
    <?php 
    require "koneksi.php";

    if (isset($_GET['kata'])) {
        $kata = '"'.$_GET['kata'].'"';
        
        $lemma = mysqli_query($koneksi, "SELECT * FROM `lemmata` WHERE lemmata.basic_lemma = ".$kata.";");
        if (mysqli_num_rows($lemma) > 0) { 
            $data_lemma = mysqli_fetch_array($lemma);
            ?>

            <!-- start arti -->
            <div class="card">
                <div class="card-header">
                    <h4><strong>Arti</strong></h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $data_lemma["basic_lemma"] ?></h5>
                    <ul>
            <?php 
            $sentencesMAD = mysqli_query($koneksi, "SELECT * FROM lemmata JOIN sentences ON sentences.lemma_id = lemmata.id WHERE sentences.language = 'MAD' AND lemmata.basic_lemma = ".$kata." GROUP BY lemmata.id;");
        
            while ($dataMAD = mysqli_fetch_array($sentencesMAD)) {
                $senetncesIND = mysqli_query($koneksi, "SELECT * FROM sentences WHERE sentences.language = 'IND' AND sentences.lemma_id = ".$dataMAD['lemma_id']." AND sentences.index = '".$dataMAD['index']."';");
                $dataIND = mysqli_fetch_array($senetncesIND);
            ?> 
                        <li>
                            <p class="card-text"><?= $dataMAD['sentence'] ?> <br> &rarr; <i style="color: blue; "><?= $dataIND['sentence'] ?></i> </p>
                        </li>
        <?php } ?> 
                    </ul>
                </div>
            </div> 
            <!-- end arti -->
            
            <br>

            <!-- start pengucapan -->
            <div class="card">
                <div class="card-header">
                    <h4><strong>Pengucapan</strong></h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $data_lemma["basic_lemma"] ?></h5>
                    <ul>
        <?php
            $pengucapan =  mysqli_query($koneksi, "SELECT lemmata.id, lemmata.basic_lemma, lemmata.pronunciation, sentences.sentence, substitution_lemmata.POS FROM lemmata RIGHT JOIN sentences on lemmata.id = sentences.lemma_id LEFT JOIN substitution_lemmata on sentences.id = substitution_lemmata.sentence_id LEFT JOIN descr_subs_lemmata on substitution_lemmata.description = descr_subs_lemmata.key WHERE language = 'MAD' and basic_lemma LIKE ".$kata." GROUP BY lemmata.id ;");
            while ($data_pengucapan = mysqli_fetch_array($pengucapan)) { ?>
                        <li>
                            <p class="card-text"><?= $data_pengucapan['basic_lemma'] ?>  <?= $data_pengucapan['POS'] ?>. / <?= $data_pengucapan['pronunciation'] ?></p>
                        </li>
                <?php } 
                ?>
                    </ul>
                    </div>
                </div> 
                <!-- end pengucapan -->

                <br>

                <!-- start kalimat -->
                <div class="card">
                    <div class="card-header">
                        <h4><strong>Kalimat</strong></h4>
                    </div>
                    <div class="card-body">
                    <?php
            $index = 1;
            $kalimat =  mysqli_query($koneksi, "SELECT lemmata.id, lemmata.basic_lemma, lemmata.pronunciation, sentences.sentence, substitution_lemmata.POS FROM lemmata RIGHT JOIN sentences on lemmata.id = sentences.lemma_id LEFT JOIN substitution_lemmata on sentences.id = substitution_lemmata.sentence_id LEFT JOIN descr_subs_lemmata on substitution_lemmata.description = descr_subs_lemmata.key WHERE language = 'MAD' and basic_lemma LIKE ".$kata." GROUP BY lemmata.id ;");
            while ($data_kalimat = mysqli_fetch_array($kalimat)) { ?>
                        <h5 class="card-title"><?= $index ?>. <?= $data_kalimat["basic_lemma"] ?>  <?= $data_kalimat['POS'] ?></h5>
                        <ul>
                        <?php

            $kumpulan_kalimat =  mysqli_query($koneksi, "SELECT * FROM `sentences`JOIN lemmata ON lemmata.id = sentences.lemma_id WHERE sentences.language = 'MAD' AND lemmata.homonym_index = ".$index." AND lemmata.basic_lemma = ".$kata.";");
            $baris = 1;
            while ($data_kumpulan_kalimat = mysqli_fetch_array($kumpulan_kalimat)) { 
                if ($baris >= 2){
                $sentencesIND = mysqli_query($koneksi, "SELECT * FROM sentences WHERE sentences.language = 'IND' AND sentences.lemma_id = ".$data_kumpulan_kalimat['lemma_id']." AND sentences.index = '".$data_kumpulan_kalimat['index']."';");
                $data_kalimat_ind = mysqli_fetch_array($sentencesIND);?>
                            <li>
                                <?= $data_kumpulan_kalimat['sentence'] ?> <br> &rarr; <i style="color: blue; "><?= $data_kalimat_ind['sentence'] ?></i>
                            </li>
                <?php } $baris++; }
                ?>
                </ul>
                <?php
            
        $index++; } 
        ?>
                    </div>
                </div> 
                <!-- end kalimat -->
                <br> 
        <?php
        } else { ?> 
            <h4>Tidak ada data!</h4>
        <?php
        }
    }
    ?>
    </div>
    <div class="col-1"></div>
</div>

<!-- start footer -->
<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">&copy; 2022 Company, Inc</p>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
    </ul>
  </footer>
</div>
<!-- end footer -->

</body>
<script>
function myFunction(val) {
    val = val.toLowerCase()
    let hasil = "";

    for (let i = 0; i < val.length; i++) 
    {
        if (val.substring(i, i+2) === "^a") 
        {
            hasil += "â";
        }
        else if (val.substring(i-1, i+1) === "^a")
        {
            hasil += "";
        }
        else if (val.substring(i, i+2) === "`e") 
        {
            hasil += "è";
        }
        else if (val.substring(i-1, i+1) === "`e")
        {
            hasil += "";
        }
        else 
        {
            hasil += val.substring(i, i+1);
        }
    }
    document.getElementById("kunci").value = hasil;
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>
