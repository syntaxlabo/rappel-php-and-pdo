<?php 


declare(strict_types=1);
function buildArticle(array $row=[]): array{

    $title= isset($row['title'])?(string)$row['title']:(string)'no title';
    $excert=isset($row['excert'])?(is_string($row['excert'])?$row['excert']:null):null;
    $views= isset($row['views'])?(is_int($row['views'])?max(0,$row['views']):(int)0):(int)0;
    $published= isset($row['author'])?(bool)$row['author']:(bool)false;
    $author= isset($row['author'])?(is_string($row['author'])?trim((string)$row['author']):(string)'N/A'):(string)'N/A';

    return ['title'=>$title,'excert'=>$excert,'views'=>$views,'published'=>$published,'author'=>$author];
}

$arr= buildArticle();
print_r($arr);

?>