# php-photogallery
Very simple photogallery to publish lots of folders with photos

based on https://github.com/JeroenvO/phpPhotogallery

Given a two level list of folders in the 'pictures' directory, where the subfolder contains images. These scripts make a website to publish the pictures. Index.php shows a header for every folder in /pictures/, with hyperlinks for every subfolder in the folder. These hyperlinks point to photo.php. Photo.php makes a photogallery with lightbox for every picture in the subfolder. The pictures have to be in two sizes. A small one for the thumbnail and a larger one for the lightbox. Append a subscript to the filename for the small and large image, such that the large one is before the small one when sorted alphabetically. 

used for Waldur photo archive.
