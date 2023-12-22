<?php
//koneksi ke database
$host = "localhost";
$user = "mbkm";
$pass = "123";
$database = "madureseset";

$koneksi = mysqli_connect($host,$user,$pass,$database);

function cekKetPos($pos) {
    $pos = $pos;
    if ($pos == "a.") {
        $ket = "Adjektiva";
    } elseif ($pos == "Adv.") {
        $ket = "Adverbia";
    } elseif ($pos == "Pron.") {
        $ket = "Pronomina";
    } elseif ($pos == "n.") {
        $ket = "Nomina";
    } elseif ($pos == "Num.") {
        $ket = "Numeralia";
    } elseif ($pos == "P.") {
        $ket = "Partikel";
    } elseif ($pos == "Pron persona pertama jamak.") {
        $ket = "Pronomina persona pertama jamak";
    } elseif ($pos == "Pron persona pertama tunggal.") {
        $ket = "Pronomina persona pertama tunggal";
    } elseif ($pos == "Pron persona tunggal.") {
        $ket = "Pronomina persona tunggal";
    } elseif ($pos == "v.") {
        $ket = "Verba";
    }
    return $ket;
}

function cekPos($string, $koneksi) {
    $pos = mysqli_query($koneksi, "SELECT * FROM `part_of_speech`");
    while ($dataPos = mysqli_fetch_array($pos)) {
        $substring = $dataPos["tag"].".";
        $description = $dataPos['description'];
        if (strpos($string, $substring) !== false) {
            if (strpos($string, "Pron.") !== false) {
                $description = "Pronoun";
                $substring = "Pron.";
            }
            $ket = cekKetPos($substring);
            $string = str_replace($substring, "
            <span id='tooltip'>
                <span id='tooltiptext'>Kelas kata : $ket (<i>$description</i>)</span>
                <i>$substring</i>
            </span>
            ", $string);
            break;
        }
    }
    return $string;
}

function cekJenis($string, $koneksi) {
    $pos = mysqli_query($koneksi, "SELECT * FROM `descr_sentences`");
    while ($dataPos = mysqli_fetch_array($pos)) {
        $substring = "{".$dataPos["key"]."}";
        $description = $dataPos['description'];
        if (strpos($string, $substring) !== false) {
            if ($substring == "{Ki}") {
                $ket = "Kiasan";
            } elseif ($substring == "{Krm}") {
                $ket = "Karmina";
            } elseif ($substring == "{Pb}") {
                $ket = "Peribahasa";
            } elseif ($substring == "{Ptn}") {
                $ket = "Pantun";
            }
            $string = str_replace($substring, "
            <span id='tooltip'>
                <span id='tooltiptext'>Jenis kalimat : $ket (<i>$description</i>)</span>
                <b>$substring</b>
            </span>
            ", $string);
        }
    }
    return $string;
}

function cekKategori($string, $koneksi) {
    $pos = mysqli_query($koneksi, "SELECT * FROM `descr_subs_lemmata`");
    while ($dataPos = mysqli_fetch_array($pos)) {
        $substring = "{".$dataPos["key"]."}";
        $description = $dataPos['description'];
        if (strpos($string, $substring) !== false) {
            if ($dataPos['category'] == "speech level") {
                $kategori = "Tingkatan bahasa";
                if ($substring == "{L}") {
                    $ket = "Lumrah";
                } elseif ($substring == "{T}") {
                    $ket = "Tengah";
                } elseif ($substring == "{AT}") {
                    $ket = "Halus/tinggi";
                } elseif ($substring == "{A}") {
                    $ket = "Halus";
                }
                $string = str_replace($substring, "
                <span id='tooltip'>
                    <span id='tooltiptext'>$kategori : $ket (<i>$description</i>)</span>
                    <b>$substring</b>
                </span>
                ", $string);
            } elseif ($dataPos['category'] == "foreign loanword" || $dataPos['category'] == "local loanword" ) {
                $kategori = "Bahasa serapan";
                if ($substring == "{Ar}") {
                    $ket = "Arab";
                } elseif ($substring == "{Bld}") {
                    $ket = "Belanda";
                } elseif ($substring == "{Cin}") {
                    $ket = "Cina";
                } elseif ($substring == "{Ind}") {
                    $ket = "Indonesia";
                } elseif ($substring == "{Ing}") {
                    $ket = "Inggris";
                } elseif ($substring == "{Lt}") {
                    $ket = "Latin";
                } elseif ($substring == "{Port}") {
                    $ket = "Portugis";
                } elseif ($substring == "{Prc}") {
                    $ket = "Perancis";
                } elseif ($substring == "{Tml}") {
                    $ket = "Tamil";
                } elseif ($substring == "{Fam}") {
                    $ket = "Famili";
                } elseif ($substring == "{Tml}") {
                    $ket = "Persia";
                } elseif ($substring == "{Jw}") {
                    $ket = "Jawa";
                } elseif ($substring == "{Skrt}") {
                    $ket = "Sansekerta";
                }
                $string = str_replace($substring, "
                <span id='tooltip'>
                    <span id='tooltiptext'>$kategori : $ket (<i>$description</i>)</span>
                    <b>$substring</b>
                </span>
                ", $string);
            } else {
                $kategori = "Dialek";
                $string = str_replace($substring, "
                <span id='tooltip'>
                    <span id='tooltiptext'>$kategori : $description</span>
                    <b>$substring</b>
                </span>
                ", $string);
            }
            
        }
    }
    return $string;
}

function Normalisasi($string) {
    $string = preg_replace('/\[[^\]]*\]/', '', $string);
    $string = preg_replace('/\d+/', '', $string);
    return $string;
}

function damerauLevenshteinDistance($string1, $string2) {
    $string1Length = mb_strlen($string1);
    $string2Length = mb_strlen($string2);

    $matrix = array();
    for ($i = 0; $i <= $string1Length; $i++) {
        $matrix[$i] = array();
        for ($j = 0; $j <= $string2Length; $j++) {
            $matrix[$i][$j] = 0;
        }
    }

    for ($i = 0; $i <= $string1Length; $i++) {
        $matrix[$i][0] = $i;
    }
    for ($j = 0; $j <= $string2Length; $j++) {
        $matrix[0][$j] = $j;
    }



    for ($i = 1; $i <= $string1Length; $i++) {
        for ($j = 1; $j <= $string2Length; $j++) {
            $cost = (mb_substr($string1, $i - 1, 1) == mb_substr($string2, $j - 1, 1)) ? 0 : 1;

            $matrix[$i][$j] = min(
                $matrix[$i - 1][$j] + 1, // Penghapusan
                $matrix[$i][$j - 1] + 1, // Penyisipan
                $matrix[$i - 1][$j - 1] + $cost // Penggantian
            );

            if ($i > 1 && $j > 1 &&
                mb_substr($string1, $i - 1, 1) == mb_substr($string2, $j - 2, 1) &&
                mb_substr($string1, $i - 2, 1) == mb_substr($string2, $j - 1, 1)) {
                $matrix[$i][$j] = min($matrix[$i][$j], $matrix[$i - 2][$j - 2] + $cost);
            }
        }
    }

    return $matrix[$string1Length][$string2Length];
}

function addLink($string, $basic, $koneksi) {
    $array1 = explode(",", $string);
    $resultString = "";
    $index = 0;
    foreach ($array1 as $element1) {
        if ($index >= 1) {
            $resultString .= ",";
            $array2 = explode(" ", $element1);
            foreach ($array2 as $element2) {
                if (strpos($element2, "{") !== true) {
                    $replaced = str_replace(['(', ')'], '', $element2);
                    $resultQ = '"'.$replaced.'"';
                    $posLemma = mysqli_query($koneksi, "SELECT basic_lemma FROM `lemmata` WHERE `lemmata`.`basic_lemma` = $resultQ");
                    if ($posLemma->num_rows > 0) {
                        while ($data = mysqli_fetch_array($posLemma)) {
                            if ($basic != $data['basic_lemma']) {
                                $element2 = str_replace($replaced, '<a href="http://localhost/kamus/?kata='.$data['basic_lemma'].'">'.$replaced.'</a>', $element2);?>
                                <?php
                                break;
                            }
                        }  
                    } else {
                        $pos = mysqli_query($koneksi, "SELECT `lemmata`.`basic_lemma` FROM `substitution_lemmata` JOIN `sentences` on `sentences`.`id` = `substitution_lemmata`.`sentence_id` JOIN lemmata on `lemmata`.`id` = `sentences`.`lemma_id` WHERE subs_lemma = $resultQ");
                        if ($pos->num_rows > 0) {
                            while ($data = mysqli_fetch_array($pos)) {
                                if ($basic != $data['basic_lemma']) {
                                    $element2 = str_replace($replaced, '<a href="http://localhost/kamus/?kata='.$data['basic_lemma'].'">'.$replaced.'</a>', $element2);?>
                                    <?php
                                    break;
                                }
                            }
                        }
                    }
                    $resultString .= $element2 . " ";
                }

            }
        } else {
            $resultString .= $element1 . " ";
        }
        $index++;
    }

    $resultString = rtrim($resultString);
    return $resultString;
}
?>