<html>
<head>
    <title>Waldur foto archief</title>
    <style type="text/css">
        body {
            background-color: #bbb;
        }
    </style>
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

if (isset($_GET['main'])) {
  /* Mainfolder is obtained using the name of the folder as 'main' get string
     Subfolder is obtained as directory index of the folders in the mainfolder.
     Photos are pulled from 'pictures/mainfolder/subfolder/*.jpg'.
     */
    $thismainfolder = $_GET['main'];
    $n = $_GET['sub'];
    $subfolders = glob('pictures/'.$thismainfolder.'/*', GLOB_ONLYDIR);
    asort($subfolders);
    $thissubfolder = (array_values($subfolders))[$n];
    echo "<div class=\"imgblock\"><h3>$thismainfolder -- $thissubfolder</h3>";

    //$filenames is an array of all filenames in 'location' with .jpg as extension
    //Glob is a function to obtain all files in a specified folder ($location), with a specified filename (*, so not specified here) and extension (.jpg)

    $filenames = glob('pictures/'.$thismainfolder.'/'.$thissubfolder.'/*.jpg', GLOB_NOSORT);
    asort($filenames);
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
            $smallimgsrc = $filenames[$pic+1];

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
}else{
    echo 'Invalid folder supplied.';
}?>
  </div>
</div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/metro.min.js"></script>
<script src="js/lightbox.js"></script>
</body>
</html>
