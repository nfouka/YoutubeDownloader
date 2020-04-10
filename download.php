<?php 
 
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

// Load and initialize downloader class 
include_once 'YouTubeDownloader.php'; 
$handler = new YouTubeDownloader(); 
 
// Youtube video url 
$youtubeURL = $argv[1];  

$logo1  =  "+-+-+-+-+-+-+-+ +-+-+-+-+-+-+-+-+-+-+ " ; 
$logo2  =  "|Y|o|u|t|u|b|e| |D|o|w|n|l|o|a|d|e|r|  by nfouka - Last build 10-04-2020" ; 
$logo3  =  "+-+-+-+-+-+-+-+ +-+-+-+-+-+-+-+-+-+-+ " ; 
$loading = "\nDownload begin ...\n" ; 
 

// Check whether the url is valid 
if(!empty($youtubeURL) && !filter_var($youtubeURL, FILTER_VALIDATE_URL) === false){ 
    // Get the downloader object 
    $downloader = $handler->getDownloader($youtubeURL); 
     
    // Set the url 
    $downloader->setUrl($youtubeURL); 
     
    // Validate the youtube video url 
    if($downloader->hasVideo()){ 
        // Get the video download link info 
        $videoDownloadLink = $downloader->getVideoDownloadLink(); 
         
        $videoTitle = $videoDownloadLink[0]['title']; 
        $videoQuality = $videoDownloadLink[0]['qualityLabel']; 
        $videoFormat = $videoDownloadLink[0]['format']; 
        $videoFileName = strtolower(str_replace(' ', '_', $videoTitle)).'.'.$videoFormat; 
        $downloadURL = $videoDownloadLink[0]['url']; 
        $fileName = preg_replace('/[^A-Za-z0-9.\_\-]/', '', basename($videoFileName)); 
         
        if(!empty($downloadURL)){ 
            // Define header for force download 
            header("Cache-Control: public"); 
            header("Content-Description: File Transfer"); 
            header("Content-Disposition: attachment; filename=$fileName"); 
            header("Content-Type: application/zip"); 
            header("Content-Transfer-Encoding: binary"); 
             
            // Read the file 
            //readfile($downloadURL); 
	    //print "$downloadURL" ; 
		// echo file_get_contents($downloadURL); 

setlocale(LC_TIME, "fr_FR");
$file_name = strftime("%d %B %Y à %H:%M");

print $logo1."\n".$logo2."\n".$logo3.$loading ; 
	   
	// Use file_get_contents() function to get the file 
	// from url and use file_put_contents() function to 
	// save the file by using base name 
	if(file_put_contents( $file_name,file_get_contents($downloadURL))) { 
	    echo "\nFile $file_name  downloaded successfully\n"; 
	} 
	else { 
	    echo "\nFile downloading failed.\n"; 
	} 
  


        } 
    }else{ 
        echo "\nThe video is not found, please check YouTube URL.\n"; 
    } 
}else{ 
    echo "\nPlease provide valid YouTube URL.\n"; 
} 
 
?>
