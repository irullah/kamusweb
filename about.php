<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body id="halaman_about">
<div style="background-color: #000b76;">
<div class="container about" id="background-biru">
    <div style="padding-top: 60px;" class="row">
        <h3 class="judul"><b>TENTANG APLIKASI</b></h3>
        <div class="col-5">
            <img class="gambar" style="margin-top:5%;" src = "assets\gambar\programming_and_web_technology_vector.png" alt="Wave"/>
        </div>
        <div class="col-6" style="margin-top:5%;" id="sekilas">
            <h4><b>Tentang Aplikasi Kamus Bahasa Madura-Indonesia Daring</b></h4>
            <p>Aplikasi Kamus Bahasa Madura-Indonesia ini merupakan kamus daring yang basisdatanya mengacu pada MadureseSet <span onclick="scrollToRef1()" id="pointer">[1]</span>, yaitu hasil digitalisasi dari Kamus Lengkap Bahasa Madura Indonesia <span onclick="scrollToRef2()" id="pointer">[2]</span> versi cetak. Aplikasi ini dibuat untuk memudahkan pencarian dan contoh penggunaan suatu kata (lema/sub lema) dalam Bahasa Madura sekaligus artinya dalam Bahasa Indonesia. Dengan demikian, aplikasi ini dapat menjadi alat penting bagi pembelajar bahasa, peneliti, penulis, dan siapa pun yang membutuhkan bantuan cepat dan akurat dalam memahami kosakata Bahasa Madura.</p>
            <br>
            <h4><b>Fitur Aplikasi Kamus Bahasa Madura-Indonesia Daring</b></h4>
            <p>Aplikasi ini memiliki daftar fitur berikut:</p>
            <ul>
                <li>Cara menuliskan karakter khusus/beraksen <span style="font-family:sans-serif">(â, è, ḍ, dan ṭ)</span> yang ada dalam Bahasa Madura</li>
                <li>Pencarian satu kata (aplikasi akan memberikan daftar saran kata yang mungkin dimaksud jika kata yang dicari tidak ada di dalam kamus <span onclick="scrollToRef3()" id="pointer">[3]</span>)</li>
                <li>Arti kata (dapat lebih dari satu jika merupakan kata homonim)</li>
                <li>Contoh penggunaan kata</li>
                <li>Keterangan kata (lema/sub lema): kelas kata, dialek, tingkatan bahasa, serapan bahasa asing, serapan bahasa daerah dan lainnya</li>
                <li>Pranala antar kata (lema/sub lema)</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-6" style="margin-top:5%;" id="sekilas">
            <h4><b>Referensi</b></h4>
            <ol>
                <li id="ref1">Ifada, N., Rachman, F.H., Syauqy, M.W.M.A., Wahyuni, S. and Pawitra, A., 2023. MadureseSet: Madurese-Indonesian Dataset. <i>Data in Brief</i>, 48, p.109035. DOI: <a href="https://doi.org/10.1016/j.dib.2023.109035">https://doi.org/10.1016/j.dib.2023.109035</a></li>
                <li id="ref2">Pawitra, A., 2009. <i>Kamus Lengkap Bahasa Madura-Indonesia</i>, Dian Rakyat.</li>
                <li id="ref3">Ifada, N., Rachman, F. H., and Wahyuni, S., 2023, December. Character-based String Matching Similarity Algorithms for Madurese Spelling Correction: A Preliminary Study, in <i>International Conference on Electrical Engineering and Informatics (ICEEI)</i> (pp. 432-437). IEEE. DOI: <a href="https://doi.org/10.1109/ICEEI59426.2023.10346716">https://doi.org/10.1109/ICEEI59426.2023.10346716</a></li>
            </ol>
        </div>
        <div class="col-4">
            <img class="gambar" src ="assets\gambar\books.png" alt="Books"/>
        </div>
    </div>
</div>
</div>
<img src = "assets/gambar/wave.svg" alt="Wave" style="padding-bottom:20px;"/>

<h3 class="judul"><b>TIM PENGEMBANG APLIKASI</b></h3>
<section class="tim">
    <div class="square">
        <div class="member-block">
            <div class="member-block-image-wrap">
                <img src="assets/tim/ifada.jpg" class="member-block-image img-fluid" alt="">

                <ul class="social-icon">
                    <li class="social-icon-item">
                        <a href="mailto:noor.ifada@trunojoyo.ac.id" class="social-icon-link bi bi-envelope-fill"></a>
                    </li>
                </ul>
            </div>

            <div class="member-block-info text-center">
                <h5>Noor Ifada</h5>
            </div>
        </div>
    </div>
    <div class="square">
        <div class="member-block">
            <div class="member-block-image-wrap">
                <img src="assets/tim/fika.jpeg" class="member-block-image img-fluid" alt="Ibu Fika">

                <ul class="social-icon">
                    <li class="social-icon-item">
                        <a href="mailto:fika.rachman@trunojoyo.ac.id" class="social-icon-link bi bi-envelope-fill"></a>
                    </li>
                </ul>
            </div>

            <div class="member-block-info text-center">
                <h5 class="text-center">Fika Hastarita Rachman</h5>
            </div>
        </div>
    </div>
    <div class="square">
       
        <div class="member-block">
            <div class="member-block-image-wrap">
                <img src="assets/tim/wildan.jpeg" class="member-block-image img-fluid" alt="">

                <ul class="social-icon">
                    <li class="social-icon-item">
                        <a href="mailto:willnode@wellosoft.net" class="social-icon-link bi bi-envelope-fill"></a>
                    </li>
                </ul>
            </div>

            <div class="member-block-info text-center">
                <h5> M Wildan Mubarok Asy Syauqy</h5>
            </div>
        </div>
    </div>
    <div class="square">
        
        <div class="member-block">
            <div class="member-block-image-wrap">
                <img src="assets/tim/wahyuni.jpeg" class="member-block-image img-fluid" alt="">

                <ul class="social-icon">
                    <li class="social-icon-item">
                        <a href="mailto:s.wahyuni@trunojoyo.ac.id" class="social-icon-link bi bi-envelope-fill"></a>
                    </li>
                </ul>
            </div>

            <div class="member-block-info text-center">
                <h5>Sri Wahyuni</h5>
            </div>
        </div>
    </div>
    <div class="square">
        
        <div class="member-block">
            <div class="member-block-image-wrap">
                <img src="assets/tim/andrian.jpeg" class="member-block-image img-fluid" alt="">

            </div>

            <div class="member-block-info text-center">
                <h5>Adrian Pawitra</h5>
            </div>
        </div>
    </div>
    <div class="square">
        <div class="member-block">
            <div class="member-block-image-wrap">
                <img src="assets/tim/irul.jpg" class="member-block-image img-fluid" alt="">

                <ul class="social-icon">
                    <li class="social-icon-item">
                        <a href="mailto:moh.amirullah17@gmail.com" class="social-icon-link bi bi-envelope-fill"></a>
                    </li>
                </ul>
            </div>

            <div class="member-block-info text-center">
                <h5>Moh Amirullah</h5>
            </div>
        </div>
    </div>
    <div class="square">
        <div class="member-block">
            <div class="member-block-image-wrap">
                <img src="assets/tim/thoriq.jpeg" class="member-block-image img-fluid" alt="">

                <ul class="social-icon">
                    <li class="social-icon-item">
                        <a href="mailto:thoriq771@gmail.com" class="social-icon-link bi bi-envelope-fill"></a>
                    </li>
                </ul>
            </div>

            <div class="member-block-info text-center">
                <h5>Muhammad Fathuthoriq</h5>
            </div>
        </div>
    </div>
</section>


<!-- start footer -->
<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-muted">&copy; 2024 Universitas Trunojoyo Madura, Inc</p>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="kamus.php" class="nav-link px-2 text-muted">Kamus</a></li>
      <li class="nav-item"><a href="about.php" class="nav-link px-2 text-muted">About</a></li>
    </ul>
  </footer>
</div>
<!-- end footer -->

</body>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
    function scrollToRef1() {
        var container = document.getElementById('ref1');
        container.scrollIntoView({ behavior: 'smooth' });
    }

    function scrollToRef2() {
        var container = document.getElementById('ref2');
        container.scrollIntoView({ behavior: 'smooth' });
    }

    function scrollToRef3() {
        var container = document.getElementById('ref3');
        container.scrollIntoView({ behavior: 'smooth' });
    }
</script>
</html>