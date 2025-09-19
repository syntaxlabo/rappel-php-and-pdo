<?php
$longopts = ["input:","published-only"];
$shortopts = "v";
$options = getopt($shortopts, $longopts);



if (isset($options['v'])) {
    // Write an error message to STDERR, which is for errors.
    fwrite(STDOUT, "this is an application" . PHP_EOL);
    fwrite(STDOUT, "this is an application" . PHP_EOL);
    exit(1);
}


if (isset($options['input'])) {
    $handle = fopen($options['input'], 'r');
    if ($handle !== false) {
        $arr1=[];
        while (($data = fgetcsv($handle,1000, ",")) !== false) {
            $arr1[count($arr1)]=$data;  
        }
        $arr=array_map(function($a){
            return [
                0=>$a[0]??'no title',
                1=>$a[1]??'no excerpt',
                2=>(int)$a[2]??0,
                3=>$a[3]??'false',
                4=>$a[4]??'no author',
            ];
        },$arr1);
        if (isset($options['published-only'])) {
            $newarr=array_map(function($a){
                if($a[3]==='true'){
                    return $a;
                }
            },$arr);
            $arr=$newarr;

        }
        
        $json=json_encode($arr);
        if($json===false){
            fwrite(STDOUT, "Error: JSON encoding failed." . PHP_EOL);
            exit(1);
        }else{
            fwrite(STDOUT, $json . PHP_EOL);
        }

        fclose($handle);
    } else {
        // Write an error message to STDERR, which is for errors.
        fwrite(STDOUT, "Error: Unable to open the file." . PHP_EOL);
        exit(1);
    }
    
}else {
    // Write an error message to STDERR, which is for errors.
    fwrite(STDOUT, "Error: The --input option is required." . PHP_EOL);
    exit(1);
}
?>
