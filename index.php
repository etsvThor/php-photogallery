<?php
/**
 * Jeroen van Oorschot 2017
 * Reads a list of folders, and shows its subfolders as hyperlinks to photo.php.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Photo index</title>
    <link href="css/metro.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>

<div class="margin20">
    <h1>Photo index</h1>
    <div class="accordion" data-role='accordion'>
        <?php
        $allfolders = glob('pictures/*', GLOB_ONLYDIR);
        $numfolders = count($allfolders);
        //look if there is a file named 'desc.txt' that contains the descriptions for each image
        if ($numfolders == 0) {
            echo 'No folders';
        } else {
            for ($f = 0; $f < $numfolders; $f++) {
                $thismainfolder = $allfolders[$f];
                ?>
                <div class="frame">
                    <div class="heading"><?php echo $thismainfolder; ?></div>
                    <li class="content"><?php
                        $subfolders = glob($thismainfolder . '/*', GLOB_ONLYDIR);
                        $numsubfolders = count($subfolders);
                        if ($numsubfolders == 0) {
                            echo 'No subfolders';
                        } else {
                            echo '<ul>';
                            for ($s = 0; $s < $numsubfolders; $s++) {
                                ?>
                                <li><a href="photo.php?main=<?php echo $f; ?>&amp;sub=<?php echo $s; ?>"
                                            title="<?php echo $subfolders[$s]; ?>"><?php echo $subfolders[$s]; ?></a></li>
                                <?php
                            }
                            echo '</ul>';
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/metro.min.js"></script>


</body>
</html>
