<?php

class Archer extends Character
{
    protected $arrows = 10;
    public $critic = false;
    public $doubleArrows=false;

    public function __construct($name) {
        parent::__construct($name);
        $this->damage = 5;
        
    }
    public function turn($target){
        if($this->arrows > 0){
            $rand = rand(1,15); 
            if (!$this->doubleArrows && !$this->critic && $this->arrows >=2 && $rand ==1){
                $status= $this->doubleArrows();
            }elseif($rand <= 3 && !$this->critic && !$this->doubleArrows){
                $status= $this->boost();
            }else{
                $status = $this->throwArrows($target);
            }
        }else{
            $status= $this->dagger($target);
        }   
        return $status;
    }
    public function throwArrows($target){
        if($this->doubleArrows){
            $doubleDamage= ($this->damage*2)*2;
            $target->setHealthPoints($doubleDamage);
            $this->arrows -= 2;
            $this->doubleArrows = false;

        }elseif($this->critic){
            $rand = rand(15, 30)/10;
            $criticDamage = ($this->damage*2) * $rand;
            $target->setHealthPoints($criticDamage);
            $this->arrows -= 1;
            $this->critic = false;
        }else{
            $target->setHealthPoints($this->damage *2);
            $this->arrows -= 1;
        }
        $status = "$this->name tire une flêche sur $target->name ! $this->arrows flèches restantes. Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }
    public function dagger($target){
        $target->setHealthPoints($this->damage);
        $status = "$this->name donne un coup de dague à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }
    public function boost() {
        $this->critic = true;
        $status = "$this->name vise un point faible !";
        return $status;
    }
    public function doubleArrows(){
        $this->doubleArrows =true;
        $status = "$this->name prépare un coup a deux flèche !";
        return $status;
    }



}