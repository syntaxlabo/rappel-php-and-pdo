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

class UserFactory{
    public static function fromArray(array $u): User {
        $id    = max(1, (int)($u['id'] ?? 0));
        $name  = trim((string)($u['name'] ?? 'Inconnu'));
        $email = trim((string)($u['email'] ?? ''));
        if ($email === '') {
            throw new InvalidArgumentException('email requis');
        }
        $bio   = isset($u['bio']) ? (string)$u['bio'] : null;
        $count = (int)($u['articlesCount'] ?? 0);

        return new User($id, $name, $email, $bio, $count);
    }
}
$array=[
        "id"=>1,
        "name"=>"med zammouri",
        "email"=>"gmail",
        "bio"=>"ggg",
        "articlesCount"=>3
    ];
$cls=UserFactory::fromArray($array);
echo $cls->initials();
print_r($cls->toArray());
?>