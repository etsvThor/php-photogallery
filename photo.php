<html>
<head>
    <title>Waldur foto archief</title>
    <style type="text/css">
        body {
            background-color: #bbb;
        }
    </style>
</head>
<body>

<?php
/**
 * Jeroen van Oorschot 2017
 */
 
echo '<div id="fotopagina">';
//get $mainfolder, array of top-level folders to use, (lente, zomer, herfst, winter, history..... , machines)
//get $subfolder,  array of wich subfolders to use and in what order. onderwerpen en gewassen
if (isset($_GET['folder'])) {
    $n = $_GET['folder'];
    $allfolders = glob('*', GLOB_ONLYDIR);
    asort($allfolders);
    $thismainfolder = (array_values($allfolders))[$n];
    echo "<div class=\"imgblock\"><h3>$thismainfolder</h3>";
    /*
    $headdescfileaddr = "beelden/$thismainfolder/headdesc.txt";
    $headdescfile = file_exists($headdescfileaddr)?fopen($headdescfileaddr,'r'):NULL;
    if($headdescfile){
        $line = fgets($descfile);
        while($line != false){
            $line = fgets($descfile);
            echo $line;
        }
    }*/
    //$filenames is an array of all filenames in 'location' with .jpg as extension
    //Glob is a function to obtain all files in a specified folder ($location), with a specified filename (*, so not specified here) and extension (.jpg)
    //if(isset($_GET['noCache'])||!file_exists($location.'.txt')){
#	echo __DIR__;
#echo $thismainfolder;
    $filenames = glob($thismainfolder.'/*.jpg', GLOB_NOSORT);
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
            $smallimgsrc = $largeimgsrc;
#            $smallimgsrc = '/' . $filenames[$pic + 1];
            //if there is a file with a description for each image.
            //Every line in the textfile is the description for one image, in alphabetical order.
            $alt = $thismainfolder;
            $desconpage = NULL;
            $title = NULL;
            echo "
			<a href=\"$largeimgsrc\" rel=\"lightbox\" class=\"html5lightbox\" data-group=\"$thismainfolder\" $title>
				<div class=\"floatimg\" $style>
						<img src=\"$smallimgsrc\" alt=\"$alt\"	 />
				</div>
			</a>

			";
        }
    }
}else{
    echo 'Invalid folder supplied.';
}
echo '</div>';
echo '</div>';
?>
</body>
</html>
