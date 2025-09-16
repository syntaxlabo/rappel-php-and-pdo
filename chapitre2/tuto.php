<?php
declare(strict_types=1);

///////////////////////////
$articles = [
  ['id'=>1,'title'=>'Intro Laravel','category'=>'php','views'=>120,'author'=>'Amina','published'=>true,  'tags'=>['php','laravel']],
  ['id'=>2,'title'=>'PHP 8 en pratique','category'=>'php','views'=>300,'author'=>'Yassine','published'=>true,  'tags'=>['php']],
  ['id'=>3,'title'=>'Composer & Autoload','category'=>'outils','views'=>90,'author'=>'Amina','published'=>false, 'tags'=>['composer','php']],
  ['id'=>4,'title'=>'Validation FormRequest','category'=>'laravel','views'=>210,'author'=>'Sara','published'=>true,  'tags'=>['laravel','validation']],
];
//this function cleans the input string
// transform all letters to lowercase 
// replace a specefic kind of characters with regular expression
// and returns a trimmed output of the string
function slugify(string $title): string {
    $slug = strtolower($title);
    $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);
    return trim($slug, '-');
}




//filters the array articles and return only the articles with published true
//then return a new numerical indexed array
$published = array_values(
  array_filter($articles, fn(array $a) => $a['published'] ?? false)
);



//simplifies the published array . 
// this function iterates throw each article 
// and simplifies it using new keys and cleaning 
// the slug with the previous function
$light = array_map(
  fn(array $a) => [
    'id'    => $a['id'],
    'title' => $a['title'],
    'slug'  => slugify($a['title']),
    'views' => $a['views'],
  ],
  $published
);


//assigning a new variable name to the light array
// then sort it with usort
$top = $light;
usort($top, fn($a, $b) => $b['views'] <=> $a['views']);



//returns a new sliced array 
// with just three first elements
$top3 = array_slice($top, 0, 3);

//encriments the number of articles of each array
$byAuthor = array_reduce(
  $published,
  function(array $acc, array $a): array {
      $author = $a['author'];
      $acc[$author] = ($acc[$author] ?? 0) + 1;
      return $acc;
  },
  []
);


$allTags = array_merge(...array_map(fn($a) => $a['tags'], $published));
/////////////
//return the number of each tag
//////////////
$tagFreq = array_reduce(
  $allTags,
  function(array $acc, string $tag): array {
      $acc[$tag] = ($acc[$tag] ?? 0) + 1;
      return $acc;
  },
  []
);


//////////////
//display
/////////////



echo "Top 3 (views):\n";
foreach ($top3 as $a) {
  echo "- {$a['title']} ({$a['views']} vues) — {$a['slug']}\n";
}

echo "\nPar auteur:\n";
foreach ($byAuthor as $author => $count) {
  echo "- $author: $count article(s)\n";
}

echo "\nTags:\n";
foreach ($tagFreq as $tag => $count) {
  echo "- $tag: $count\n";
}
///////////////////////////

?>