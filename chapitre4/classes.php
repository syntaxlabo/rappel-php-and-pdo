<?php
declare(strict_types=1);

class User{
    
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public ?string $bio=null,
        public int $articlesCount)
        {}
    public function initials(){
        $name=trim($this->name);
        $namearr=explode(" ",$name);
        $newArr=array_map(fn($a)=>strtoupper(substr($a,0,1)),$namearr);
        $init=implode(" ",$newArr);
        return $init;
    }
    public function toArray(): array{

    $array=[
        "id"=>$this->id,
        "name"=>$this->name,
        "email"=>$this->email,
        "bio"=>$this->bio,
        "articlesCount"=>$this->articlesCount
    ];
    return $array;

    }

}

$cls=new User(1,"med zammouri","gmail","ggg",3);
echo $cls->initials();
print_r($cls->toArray());
?>