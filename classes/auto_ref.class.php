<?php




/**
* System Class contient all interaction with the database
*/
class AutoRef 
{
   private $duration;

   public static function getDuration(){
   	 return $this->duration;
   } 	

   public static function setDuration($value){
   	 $this->duration = $value;
   }
}