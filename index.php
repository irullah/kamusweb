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
<div class="container text-center">
  <div style="padding-top: 30px;" class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <form action="" method="get">
            <h1 >Kamus Bahasa Madura</h1>
            <div class="input-group mb-3">
                <input name="kata" type="cari" class="form-control" placeholder="Kata" aria-label="Kata" aria-describedby="button-addon2">
                <button class="btn btn-primary" type="submit" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                    Cari
                </button>
            </div>
        </form>
        </div>
        <div class="col-2"></div>
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
        // $queryMAD = mysqli_query($koneksi, "SELECT * FROM sentences WHERE language = 'MAD' and sentence LIKE '%$kata%'");
        $queryMAD = mysqli_query($koneksi, "SELECT lemmata.*, sentences.id as id_sentence, sentences.*, substitution_lemmata.*, descr_subs_lemmata.* FROM lemmata RIGHT JOIN sentences on lemmata.id = sentences.lemma_id LEFT JOIN substitution_lemmata on sentences.id = substitution_lemmata.sentence_id LEFT JOIN descr_subs_lemmata on substitution_lemmata.description = descr_subs_lemmata.key WHERE language = 'MAD' and basic_lemma LIKE ".$kata." GROUP BY lemmata.id ;");
        
        if (mysqli_num_rows($queryMAD) > 0) { 
            while ($dataMAD = mysqli_fetch_array($queryMAD)) {
                $id = $dataMAD['id_sentence'] + 1;
                // $queryIND = mysqli_query($koneksi, "SELECT * FROM sentences WHERE id = '$id'");
                $queryIND = mysqli_query($koneksi, "SELECT * FROM sentences WHERE id = '$id'");
                $dataIND = mysqli_fetch_array($queryIND);
            ?> 
            <h4><?= $dataMAD['basic_lemma'] ?></h4>
            <p><?= $dataMAD['sentence'] ?></p>
            <p><?= $dataIND['sentence'] ?></p>
        
        
        
        <?php
        } } else { ?> 
            <h4>Tidak ada data!</h4>
        <?php
        }
    }
    ?>
    </div>
    <div class="col-1"></div>
</div>

            
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>
