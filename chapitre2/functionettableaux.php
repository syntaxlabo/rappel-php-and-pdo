<?php
declare(strict_types=1);
function clean(string $title): string {
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
    'slug'     => clean($a['title']),
    'views'    => $a['views'],
    'author'   => $a['author'],
    'category' => $a['category'],
  ],
  $filtered
);


usort($normalize, fn($a, $b) => $b['views'] <=> $a['views']);


$sum = array_reduce(
  $filtered,
  function(array $acc, array $a): array {
      $acc['count'] = ($acc['count'] ?? 0) + 1;
      $acc['views_sum'] = ($acc['views_sum'] ?? 0) + $a['views'];
      $cat = $a['category'];
      $acc['by_category'][$cat] = ($acc['by_category'][$cat] ?? 0) + 1;
      return $acc;
  },
  ['count'=>0, 'views_sum'=>0, 'by_category'=>[]]
);

print_r($sum);
print_r($normalize);

$json=json_encode($normalize);
$json2=json_encode($sum);

echo $json;
echo $json2;

///////////////////////

?>