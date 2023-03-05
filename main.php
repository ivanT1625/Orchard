<?php

class Trees{

    private $numberOfAppleTrees;
    private $numberOfPears;

    public $sumApples = 0;
    public $sumPears = 0;


    public function setValue($numberOfAppleTrees,$numberOfPears){
        $this->numberOfAppleTrees = $numberOfAppleTrees;
        $this->numberOfPears = $numberOfPears;
        $this->addTree();
    }


    public function addTree(){

        $getTrees = file_get_contents('file.txt');
        $getTrees = json_decode($getTrees,true);


        if(empty($getTrees)){
            $idContent=0;
        } else {
            $idContent = (int)current(end($getTrees));
        }


        for ($i=0;$i<$this->numberOfAppleTrees;$i++){
            $idContent++;
            $newId=['id'=>$idContent,'Дерево'=>'Яблоня'];
            $getTrees[]=$newId;
        }

        for ($i=0;$i<$this->numberOfPears;$i++){
            $idContent++;
            $newId=['id'=>$idContent ,'Дерево'=>'Груша'];
            $getTrees[]=$newId;
        }

        $str = json_encode($getTrees,JSON_UNESCAPED_UNICODE);
        file_put_contents('file.txt',$str);

        $this->gatheringProducts();
    }

    public function gatheringProducts(){


        $getTrees = file_get_contents('file.txt');
        $getTrees = json_decode($getTrees,true);


        $weightApples = 0;
        $weightPears = 0;

        foreach ($getTrees as $value){
            if($value["Дерево"] == "Яблоня"){
                $numberOfAppless = random_int(40,50);
                for ($i = 0 ; $i<=$numberOfAppless;$i++){
                    $weightApples = $weightApples + random_int(150,180);
                }
                $this->sumApples = $this->sumApples + $numberOfAppless;
            }
            if($value["Дерево"] == "Груша"){
                $numberOfPears = random_int(0,20);
                for ($i = 0 ; $i<=$numberOfAppless;$i++){
                    $weightPears = $weightPears + random_int(130,170);
                }
                $this->sumPears = $this->sumPears + $numberOfPears;
            }
        }

        echo "Общее количество яблок  = ". $this->sumApples . ", общий вес яблок =  $weightApples  грамм<br/>" ;
        echo "Общее количество груш  = ". $this->sumPears . ", общий вес груш =  $weightPears грамм <br/>" ;



    }
}



$obj= (new Trees)->setValue(10,15);
