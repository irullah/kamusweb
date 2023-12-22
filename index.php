<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamus</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<!-- start navbar -->
<!-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Kamus</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <ul class="nav justify-content-end nav-underline">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
  </div>
</nav> -->
<!-- end navbar -->

<div style="background-color: #000b76;">
<div class="container">
  <div style="padding-top: 60px;" class="row">
    <div class="col-4">
        <div class="alert text-left alert-warning" style="font-family:sans-serif" role="alert">
            <h4 class="alert-heading">Petunjuk</h4>
            <p class="mb-0">Menuliskan <strong>.d</strong> berubah menjadi <strong>ḍ</strong></p>
            <p class="mb-0">Menuliskan <strong>.t</strong> berubah menjadi <strong>ṭ</strong></p>
            <p class="mb-0">Menuliskan <strong>^a</strong> berubah menjadi <strong>â</strong></p>
            <p class="mb-0">Menuliskan <strong>`e</strong> berubah menjadi <strong>è</strong><br><br>Contoh :</p>
            <ul>
                <li>
                    <strong>ro.du</strong> &rarr; <strong>roḍu</strong>
                </li>
                <li>
                    <strong>sal`e.t`eng</strong> &rarr; <strong>salèṭèng</strong>
                </li>
                <li>
                    <strong>l`eker</strong> &rarr; <strong>lèker</strong>
                </li>
                <li>
                    <strong>ad^a'</strong>  &rarr; <strong>adâ'</strong>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-8">
        <form action="" method="get">
            <h1 class="text-center " id="background-biru">Kamus Bahasa Madura - Indonesia</h1>
            <div class="input-group mb-3">
                <input name="kata" type="cari" value="<?= isset($_GET['kata']) ? strip_tags($_GET['kata']) : ''; ?>" class="form-control" placeholder="Kata" aria-label="Kata" aria-describedby="button-addon2" id="kunci" onchange="myFunction(this.value)">
                <button class="btn btn-primary" type="submit" id="button-addon2">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>
        </div>
    </div>
    </div>
</div>
<img src = "assets/gambar/wave.svg" alt="Wave"/>
<div class="row">
    <div class="col-1"></div>
    <div class="col-10">
    <?php 
    require "koneksi.php";

    if (isset($_GET['kata'])) {
        $kata = strip_tags($_GET['kata']);
        $kata = '"'.$kata.'"';
        
        $lemma = mysqli_query($koneksi, "SELECT * FROM `lemmata` WHERE lemmata.basic_lemma = ".$kata.";");
        if (mysqli_num_rows($lemma) > 0) { 
            $data_lemma = mysqli_fetch_array($lemma);
            ?>

            <!-- start arti -->
            <div class="card" id="arti-kalimat-target">
                <div class="card-header">
                    <h4><strong>Arti</strong></h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $data_lemma["basic_lemma"] ?></h5>
                    <ol>
            <?php 
            $sentencesMAD = mysqli_query($koneksi, "SELECT lemmata.*, sentences.*, substitution_lemmata.POS, part_of_speech.description FROM lemmata RIGHT JOIN sentences on lemmata.id = sentences.lemma_id LEFT JOIN substitution_lemmata on sentences.id = substitution_lemmata.sentence_id LEFT JOIN descr_subs_lemmata on substitution_lemmata.description = descr_subs_lemmata.key LEFT JOIN part_of_speech on substitution_lemmata.POS = part_of_speech.tag WHERE language = 'MAD' and basic_lemma LIKE ".$kata." GROUP BY lemmata.id ;");

            $index_arti = 1;
            while ($dataMAD = mysqli_fetch_array($sentencesMAD)) {
                $string = $dataMAD['sentence'];
                $string = Normalisasi($string);
                $string = addLink($string, $_GET['kata'], $koneksi);
                $string = cekPos($string, $koneksi);
                $string = cekJenis($string, $koneksi);
                $string = cekKategori($string, $koneksi);

                $senetncesIND = mysqli_query($koneksi, "SELECT * FROM sentences WHERE sentences.language = 'IND' AND sentences.lemma_id = ".$dataMAD['lemma_id']." AND sentences.index = '".$dataMAD['index']."';");
                $dataIND = mysqli_fetch_array($senetncesIND);
            ?> 
                        <li><p class="card-text"><span class="arti" id="arti-<?= $index_arti ?>"><?= $string ?></span> <br> &rarr; <span id="lang-id"><?= $dataIND['sentence'] ?></span> </p></li>
        <?php $index_arti++;} ?> 
                    </ol>
                </div>
            </div> 
            <!-- end arti -->

            <br>

            <!-- start kalimat -->
            <div class="card">
                <div class="card-header">
                    <h4><strong>Contoh penggunaan kata</strong></h4>
                </div>
                <div class="card-body">
                <?php
        $index_kalimat = 1;
        $kalimat =  mysqli_query($koneksi, "SELECT lemmata.id, lemmata.basic_lemma, lemmata.pronunciation, sentences.sentence, substitution_lemmata.POS, part_of_speech.description FROM lemmata RIGHT JOIN sentences on lemmata.id = sentences.lemma_id LEFT JOIN substitution_lemmata on sentences.id = substitution_lemmata.sentence_id LEFT JOIN descr_subs_lemmata on substitution_lemmata.description = descr_subs_lemmata.key LEFT JOIN part_of_speech on substitution_lemmata.POS = part_of_speech.tag WHERE language = 'MAD' and basic_lemma LIKE ".$kata." GROUP BY lemmata.id ;");
        while ($data_kalimat = mysqli_fetch_array($kalimat)) { 
                    $pos = $data_kalimat['POS'];
                    $ket = cekKetPos($pos.".");
                    ?>
                    <h6 class="card-title" id="kalimat-<?= $index_kalimat ?>"> <b><?= $data_kalimat["basic_lemma"] ?></b><sub onclick="scrollToContent()" id="pointer">[<?= $index_kalimat ?>]</sub> 
                    <span id="tooltip">
                        <span id="tooltiptext">Kelas kata : <?= $ket." (<i>".$data_kalimat['description']."</i>)" ?></span>
                        <span><i><?= $pos ?></i></span>
                    </span>
                    </h6>
                    <ul>
                    <?php

        $kumpulan_kalimat =  mysqli_query($koneksi, "SELECT * FROM `sentences`JOIN lemmata ON lemmata.id = sentences.lemma_id WHERE sentences.language = 'MAD' AND lemmata.homonym_index = ".$index_kalimat." AND lemmata.basic_lemma = ".$kata.";");
        $baris = 1;
        
        while ($data_kumpulan_kalimat = mysqli_fetch_array($kumpulan_kalimat)) { 
            if ($kumpulan_kalimat->num_rows >= 2) {
                if ($baris >= 2){
                    $string = $data_kumpulan_kalimat['sentence'];
                    $string = Normalisasi($string);
                    $string = addLink($string, $_GET['kata'], $koneksi);
                    $string = cekPos($string, $koneksi);
                    $string = cekJenis($string, $koneksi);
                    $string = cekKategori($string, $koneksi);
                    $sentencesIND = mysqli_query($koneksi, "SELECT * FROM sentences WHERE sentences.language = 'IND' AND sentences.lemma_id = ".$data_kumpulan_kalimat['lemma_id']." AND sentences.index = '".$data_kumpulan_kalimat['index']."';");
                    $data_kalimat_ind = mysqli_fetch_array($sentencesIND);?>
                                <li><p class="card-text"><?= $string ?> <br> &rarr; <span id="lang-id"><?= $data_kalimat_ind['sentence'] ?></span></p></li>
                <?php } $baris++; }
            else {
                echo '<script>document.getElementById("kalimat-'.$index_kalimat.'").innerHTML = "";</script>';
            }
            }
            ?>
            </ul>
            <?php
        
    $index_kalimat++; } 
    ?>
                </div>
            </div> 
            <!-- end kalimat -->
            <br>
            <!-- start pengucapan -->
            <div class="card" id="card-pengucapan">
                <div class="card-header">
                    <h4><strong>Pengucapan</strong></h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= $data_lemma["basic_lemma"] ?></h5>
                    <ol>
        <?php
            $pengucapan =  mysqli_query($koneksi, "SELECT lemmata.id, lemmata.basic_lemma, lemmata.pronunciation, sentences.sentence, substitution_lemmata.POS, part_of_speech.description FROM lemmata RIGHT JOIN sentences on lemmata.id = sentences.lemma_id LEFT JOIN substitution_lemmata on sentences.id = substitution_lemmata.sentence_id LEFT JOIN descr_subs_lemmata on substitution_lemmata.description = descr_subs_lemmata.key LEFT JOIN part_of_speech on substitution_lemmata.POS = part_of_speech.tag WHERE language = 'MAD' and basic_lemma LIKE ".$kata." GROUP BY lemmata.id ;");
            $index_pengucapan = 1;
            while ($data_pengucapan = mysqli_fetch_array($pengucapan)) { 
                $pattern = "/\[([^\]]+)\]/";
                $string = $data_pengucapan['sentence'];
                preg_match($pattern, $string, $matches);
                $result = $matches[0];
                $pos = $data_pengucapan['POS'];
                $ket = cekKetPos($pos.".");
                
                ?>
                    <li><p class="card-text" ><?= $data_pengucapan['basic_lemma'] ?>
                        <span id="tooltip">
                            <span id="tooltiptext">Kelas kata : <?= $ket." (<i>".$data_pengucapan['description']."</i>)" ?></span>
                            <span><i><?= $pos ?></i></span>
                        </span> / 
                        <span id="pronunciation"><?= $result ?></span>
                    </p></li>
                <?php $index_pengucapan++; } 
                ?>
                    </ol>
                    </div>
                </div> 
                <!-- end pengucapan -->

                
                <br> 
        <?php
        } else { 
        ?> 
            <h4>Tidak ada kata <strong>"<?= $_GET['kata'] ?>"</strong>  dalam bahasa madura. Mungkin maksud Anda: </h4>
        <?php


            $kata = $_GET['kata'];
            $lemmata = mysqli_query($koneksi, "SELECT basic_lemma FROM lemmata");
            while ($data_lemmata = mysqli_fetch_array($lemmata)) {
                $lemma = $data_lemmata['basic_lemma'];
                $jarak = damerauLevenshteinDistance($kata, $lemma);
                $distances[$lemma] = $jarak;

            }
            asort($distances);
            $terdekat = array_slice($distances, 0, 10, true);
            foreach ($terdekat as $kata => $jarak) {
                echo "<a href='http://localhost/kamus/?kata=$kata'>$kata</a><br>";
            }
        }
    }
    ?>
    </div>
    <div class="col-1"></div>
</div>

<!-- start footer -->
<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">&copy; 2024 Universitas Trunojoyo Madura, Inc</p>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="http://localhost/kamus/" class="nav-link px-2 text-muted">Kamus</a></li>
      <li class="nav-item"><a href="http://localhost/kamus/about.php" class="nav-link px-2 text-muted">About</a></li>
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
        else if (val.substring(i, i+2) === ".d") 
        {
            hasil += "ḍ";
        }
        else if (val.substring(i-1, i+1) === ".d")
        {
            hasil += "";
        }
        else if (val.substring(i, i+2) === ".t") 
        {
            hasil += "ṭ";
        }
        else if (val.substring(i-1, i+1) === ".t")
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
<script>
    function scrollToContent() {
        var container = document.getElementById('arti-kalimat-target');
        container.scrollIntoView({ behavior: 'smooth' });
    }
</script>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</html>