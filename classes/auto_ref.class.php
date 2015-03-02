<?php




/**
* System Class contient all interaction with the database
*/
class AutoRef 
{
   public private $duration;

   public static function getDuration(){
   	 return $this->duration;
   } 	

   public static setDuration($value){
   	 $this->duration = $value;
   }
}