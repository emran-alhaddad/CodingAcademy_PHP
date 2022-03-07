<?php
$images = ["png","jpg","jpeg","giff"];
$videos = ["mp4","wmv","3gp","avi","mpeg"];
$audios = ["wav","mp3","avi","m4a"];

if(isset($_GET['folder']) && !empty($_GET['folder']))
{
    $allImages = "";
    $allVideos = "";
    $allAudios = "";
    $allOthers = "";
    $folder = $_GET['folder'].'/';
    
    $dir = opendir($folder);
    while ($item = readdir($dir)) 
    {
        
        if($item == '.' || $item == '..' ) continue;

            $name = getFileName($item);
            $type = getFileType($item);

            if(in_array($type,$images))
                $allImages .= displayImage($folder.'/'.$item,$name);

            else if(in_array($type,$videos))
                $allVideos .=  displayVideo($folder.'/'.$item,$name,$type);

            else if(in_array($type,$audios))
                $allAudios .= displayAudio($folder.'/'.$item,$name,$type);

            else 
                $allOthers .= displayOther($folder.'/'.$item,$name);
    }    

        if(!empty($allImages))
        { echo "<h2 style='color:green;'> Images </h2> <hr>";
            echo $allImages;
            echo "<hr>";
        }

        if(!empty($allAudios))
        { echo "<h2 style='color:green;'> Audios </h2> <hr>";
            echo $allAudios;
            echo "<hr>";
        }

        if(!empty($allVideos))
        { echo "<h2 style='color:green;'> Videos </h2> <hr>";
            echo $allVideos;
            echo "<hr>";
        }

        if(!empty($allOthers))
        { echo "<h2 style='color:green;'> Other Files </h2> <hr>";
            echo $allOthers;
            echo "<hr>";
        }

        
    

}
else
echo "<h1 style='color:red; text-algin:center;'> Nothing To View !!! </h1>";


function getFileType($file)
{
    if(!empty($file))
    return substr($file,strrpos($file,'.')+1,strlen($file)); 
    
    return "";
}

function getFileName($file)
{
    if(!empty($file))
    return substr($file,0 ,strrpos($file,'.')); 
}

function displayVideo($file,$name,$type)
{
    return '
            <figure>
                <figcaption>'.$name.':</figcaption>
                <video controls style="width:200px;">
                    <source src="'.$file.'" type="video/'.$type.'">
                    <p>Your browser doesnt support HTML5 video. Here isa 
                        <a href="'.$file.'">link to the video</a> instead.
                    </p>
                </video>
            </figure>
            <br/>
    ';
}


function displayAudio($file,$name,$type)
{
    return '
            <figure>
            <figcaption>'.$name.':</figcaption>
                <audio controls>
                    <source src="'.$file.'" type="audio/'.$type.'">
                    <p>Your browser doesnt support HTML5 audio. Here isa 
                        <a href="'.$file.'">link to the audio</a> instead.
                    </p>
                </audio>
            </figure>
            <br/>
    ';

}


function displayImage($file,$name)
{
    return '
            <figure>
                <figcaption>'.$name.':</figcaption>
                <img width=100 height=100 src="'.$file.'"/>
            </figure>
            <br/>
    ';

}


function displayOther($file,$name)
{
    return '
            <a href="'.$file.'">'.$name.'</a>
            <br/>
    ';

}



?>