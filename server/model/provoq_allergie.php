<?php 
class Provoq_allergie{
    protected int $numAll;
    protected int $numMP;
   
    public function __construct (int $numAll= NULL,int $numMP= NULL){
        if(!is_null($numAll) && !is_null($numMP)){
           $this->numAll=$numAll;
           $this->numMP=$numMP;
        }
    }
}
?>