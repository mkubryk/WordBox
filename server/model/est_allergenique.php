<?php 
class Est_allergenique {
    protected int $numIngredient;
    protected int $numAll;
  
    public function __construct (int $numIngredient= NULL,int $numAll= NULL){
        if(!is_null($numIngredient) && !is_null($numAll)){
           $this->numIngredient =$numIngredient;
           $this->numAll =$numAll;
        }
    }
}
?>
