<html>
<head>
    <title>Waldur foto archief</title>
    <link href="css/lightbox.css" rel="stylesheet">
    <link href="css/metro.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

</head>
<body>
<div id="container">

    <?php
    /**
     * Jeroen van Oorschot 2017
     */

    if (isset($_GET['main']) && isset($_GET['sub'])) {
    /* Mainfolder is obtained as directory index of the root folder '/pictures/'
       Subfolder is obtained as directory index of the folders in the mainfolder.
       Photos are pulled from 'pictures/mainfolder/subfolder/*.jpg'.
       */
        $m = $_GET['main'];
        $n = $_GET['sub'];
        if(is_numeric($n) and is_numeric($n) and $m>=0 and  $n >=0 ){

            $mainfolders = glob('pictures/*', GLOB_ONLYDIR);
            $thismainfolder = (array_values($mainfolders))[$m];

            $subfolders = glob($thismainfolder . '/*', GLOB_ONLYDIR);
            $thissubfolder = (array_values($subfolders))[$n];
            ?>
            <h1>Waldur foto archief</h1>
            <a href="index.php" title="back" class="button">Terug</a>
            <div class="imgblock"><h3><?php echo $thissubfolder; ?></h3>
                <?php
                //$filenames is an array of all filenames in 'location' with .jpg as extension
                //Glob is a function to obtain all files in a specified folder ($location), with a specified filename (*, so not specified here) and extension (.jpg)

                $filenames = glob($thissubfolder . '/*.jpg');
                $filenames = (array_values($filenames));
                $numimgs = count($filenames);
                //look if there is a file named 'desc.txt' that contains the descriptions for each image
                if ($numimgs == 0) {
                    echo 'Geen foto\'s';
                } else {
                    $alt = "";
                    $desconpage = "";
                    $style = "";
                    for ($pic = 0; $pic < $numimgs; $pic = $pic + 2) {
                        //build the html for this img. The first image is the large one 800*600px, the second is the small one 200*150px.
                        //this works if every image has a unique name, and is both in small and large format in the folder.
                        //Both image start with the same filename, but the small one ends with a 's' and the large one ends with 'l'
                        // Because $filenames is in alphabetic order, the large one is just in front of the small one
                        $largeimgsrc = $filenames[$pic];
                        $smallimgsrc = $filenames[$pic + 1];

                        $alt = $thissubfolder;
                        $desconpage = NULL;
                        $title = NULL;
                        echo "
                    <a href=\"$largeimgsrc\" data-lightbox=\"$thismainfolder\" $title>
                        <div class=\"floatimg\" $style>
                                <img src=\"$smallimgsrc\" alt=\"$alt\"	 />
                        </div>
                    </a>
                    ";
                    }
                }
            } else {
                echo 'Invalid folder supplied.';
        }} else {
            echo 'Invalid folder supplied.';
        }
        ?>
    </div>
</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/metro.min.js"></script>
<script src="js/lightbox.js"></script>
</body>
</html>
