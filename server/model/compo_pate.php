<?php 
class Compo_pate {
    protected int $numMP;
    protected int $numPatePizza;
  
    public function __construct (int $numMP= NULL,int $numPatePizza= NULL){
        if(!is_null($numIngredient)){
           $this->numMP =$numMP;
           $this->numPatePizza =$numPatePizza;
        }
    }
}
?>