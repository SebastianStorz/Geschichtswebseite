<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goldene 20er - Quellen</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <header>
        <div class="logo">
            <a href="../index.php"><img src="../images/logo.png" alt="Logo"></a>
            <!--https://www.kindpng.com/imgv/hTxTboo_dance2-roaring-20s-hd-png-download/-->
        </div>
        <nav class="topnav">

            <div>
                <a href="../index.php">HOME</a>
            </div>
            <div>
                <a href="../wirtschaft.php">WIRTSCHAFT</a>
            </div>
            <div>
                <a href="../innenpolitik.php">INNENPOLITIK</a>
            </div>
            <div>
                <a href="../aussenpolitik.php">AUSSENPOLITIK</a>
            </div>
            <div>
                <a href="../kultur.php">KULTUR</a>
            </div>
        </nav>
        <div id="navalign">
            <div>
                <a href="#">Quellen</a>
            </div>
        </div>
    </header>

    <section>
        <div class="content">
            <div class="navcorrection"> </div>
            <div class="qtitel">
                <h1>Quellenverzeichnis</h1>
                <p>Information zu Text & Bild</p>
            </div>

            <dl>
                <dt class="dicttitle">Texte</dt>

                <?php
                //php verwendet um einfach Quellen einfügen zu können. (Ich möchte anmerken dass ich ein Genie bin - Sebastian)
                $id = 1;
                $text = fopen("./text.txt", "r");
                while ($temp = fscanf($text, "%s\t%s\t%s\t%s\t%s")) {
                    list($title, $phonetic, $dir, $websource, $date) = str_replace("_", " ", $temp);
                    $truesource = str_replace('Quelle: ', '', $websource);
                    echo <<<EOD
                        <div id="t$id">
                        <a href="$truesource" target="_blank">
                            <dt>$title<span class="phonetic">$phonetic</span></dt>
                            <dd>
                                <p>$dir</p>
                                <p>$websource</p>
                                <p>$date</p>
                            </dd>
                            </a>
                        </div>
                    EOD;
                    $id++;
                }
                fclose($text);
                ?>
            </dl>
            <dl>
                <dt class="dicttitle">Bilder</dt>
                <?php
                function thumbnail(string $source, string $destFile, int $height)
                {
                    $newImage = $destFile;
                    $srcImage = imagecreatefromjpeg($source);
                    $srcWidth = imagesx($srcImage);
                    $srcHeight = imagesy($srcImage);
                    $srcRatio = $srcHeight / $srcWidth;
                    $destWidth = $height / $srcRatio;
                    $destHeight = $height;
                    $destimg = imagecreatetruecolor($destWidth, $destHeight);
                    imagecopyresampled($destimg, $srcImage, 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight);
                    imagejpeg($destimg, $newImage);
                }

                $id = 1;
                $img = fopen("./images.txt", "r");
                while ($temp = fscanf($img, "%s\t%s\t%s\t%s\t%s")) {
                    list($source, $title, $desc, $websource, $date) = str_replace("_", " ", $temp);
                    $dest = str_replace("../images/", "./thumbnails/", $source);
                    $thumnails = scandir("./thumbnails");
                    if (!in_array(basename($dest), $thumnails)) {
                        thumbnail($source, $dest, 60);
                    }
                    $truesource = str_replace('Quelle: ', '', $websource);
                    echo <<<EOD
                        <div id="b$id">
                            <a href="$truesource" target="_blank">
                                <dt>$title</dt>
                                <dd class="imgdict">
                                    <div>
                                        <p>$desc</p>
                                        <p>$websource</p>
                                        <p>$date</p>
                                    </div>
                                    <div>
                                        <img src="$dest" alt="$title">
                                    </div>
                                </dd>
                            </a>
                        </div>
                    EOD;
                    $id++;
                }
                fclose($img);
                ?>
            </dl>
            <dl>
                <dt class="dicttitle">Videos</dt>

                <?php
                //php verwendet um einfach Quellen einfügen zu können. (Ich möchte anmerken dass ich ein Genie bin - Sebastian)
                $id = 1;
                $text = fopen("./videos.txt", "r");
                while ($temp = fscanf($text, "%s\t%s\t%s\t%s")) {
                    list($title, $dir, $websource, $date) = str_replace("_", " ", $temp);
                    $truesource = str_replace('Quelle: ', '', $websource);
                    echo <<<EOD
                        <div id="t$id">
                        <a href="$truesource" target="_blank">
                            <dt>$title</dt>
                            <dd>
                                <p>$dir</p>
                                <p>$websource</p>
                                <p>$date</p>
                            </dd>
                            </a>
                        </div>
                    EOD;
                    $id++;
                }
                fclose($text);
                ?>
            </dl>
        </div>

    </section>

    <footer>
        <div>
            <a href="./impressum.php">Impressum</a>
        </div>
        <div>
            <a href="./quellen.php">Quellen</a>
        </div>

    </footer>
    <div class="belowfooter">
        <div>
            <p>Made for IDAF by Tobias & Sebastian</p>
        </div>
    </div>
</body>

</html>