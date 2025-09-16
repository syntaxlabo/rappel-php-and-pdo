<?php 
declare(strict_types=1);
echo " ***********************************************";
echo " Types & syntaxe utiles";
echo " ***********************************************";




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




/////////////////////////////

echo " ***********************************************";
echo " Fonctions, closures & manipulation de tableaux";
echo " ***********************************************";

function slugify(string $title): string {
    $slug = strtolower($title);
    $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);
    return trim($slug, '-');
}

$articles = [
  ['id'=>1,'title'=>'Intro Laravel','category'=>'php','views'=>120,'author'=>'Amina','published'=>true,  'tags'=>['php','laravel']],
  ['id'=>2,'title'=>'PHP 8 en pratique','category'=>'php','views'=>300,'author'=>'Yassine','published'=>true,  'tags'=>['php']],
  ['id'=>3,'title'=>'Composer & Autoload','category'=>'outils','views'=>90,'author'=>'Amina','published'=>false, 'tags'=>['composer','php']],
  ['id'=>4,'title'=>'Validation FormRequest','category'=>'laravel','views'=>210,'author'=>'Sara','published'=>true,  'tags'=>['laravel','validation']],
];
$filtered=array_filter($articles,fn(array $a) => $a['published'] ?? false);
$normalize = array_map(
  fn($a) => [
    'id'       => $a['id'],
    'slug'     => slugify($a['title']),
    'views'    => $a['views'],
    'author'   => $a['author'],
    'category' => $a['category'],
  ],
  $filtered
);
usort($normalize, fn($a, $b) => $b['views'] <=> $a['views']);

print_r($normalize);








?>