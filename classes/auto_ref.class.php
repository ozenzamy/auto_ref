<?php




/**
* System Class contient all interaction with the database
*/
class AutoRef 
{
   private static $duration;

   public static function getDuration(){
   	 return self::$duration;
   } 	

   public static function setDuration($value){
   	 self::$duration = $value;
   }
}