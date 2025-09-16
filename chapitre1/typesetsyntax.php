<?php 
declare(strict_types=1);
////////////////////////////////
///////////////////:


$input = [
  'title'     => 'PHP 8 en pratique',
  'excerpt'   => '',
  'views'     => '300',
  // 'published' absent
  'author'    => 'Yassine'
];

function strOrNull(?string $s): ?string {
    $s = $s !== null ? trim($s) : null;
    return $s === '' ? null : $s;
}

function intOrZero(int|string|null $v): int {
    return max(0, (int)($v ?? 0));
}

$normalized = [
  'title'     => trim((string)($input['title'] ?? 'Sans titre')),
  'excerpt'   => strOrNull($input['excerpt'] ?? null),
  'views'     => intOrZero($input['views'] ?? null),
  'published' => $input['published'] ?? true, // défaut si non défini
  'author'    => trim((string)($input['author'] ?? 'N/A')),
];

print_r($normalized);






////////////////////////////////




function buildArticle(array $row=[]): array{

    $title= isset($row['title'])?trim((string)$row['title']):(string)'no title';
    $excert=isset($row['excert'])?(is_string($row['excert'])?trim($row['excert']):null):null;
    $views= isset($row['views'])?(is_int($row['views'])?max(0,$row['views']):(int)0):(int)0;
    $published= isset($row['author'])?(bool)$row['author']:(bool)false;
    $author= isset($row['author'])?(is_string($row['author'])?trim((string)$row['author']):(string)'N/A'):(string)'N/A';
    ////
    return ['title'=>$title,'excert'=>$excert,'views'=>$views,'published'=>$published,'author'=>$author];
}
$test1=['title'=>'title','excert'=>'','views'=>-5,'published'=>'false','author'=>'c'];
$arr= buildArticle();
$arr2= buildArticle($test1);

print_r(value: $arr);
print_r(value: $arr2);


?>