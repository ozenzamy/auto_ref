<?php




/**
* System Class contient all interaction with the database
*/
class AutoRef 
{
  public static function autoRef_loader($entity, $duration, $field){
	  $date = $entity->field_cot_date[LANGUAGE_NONE][0]['value'];
      $date = strtotime("$date");
      $date = date('Y-m-d', strtotime($duration, $date));
      $ref = $entity->field_cot_ref[LANGUAGE_NONE][0]['target_id'];
      
      $query = db_select('field_data_field_cot_ref', 'cot_ref');
      $query->join('field_data_field_cot_date', 'date_ref', "cot_ref.entity_id = date_ref.entity_id");
      $query->fields('cot_ref', array('entity_id'))
            ->condition("cot_ref.field_cot_ref_target_id", $ref, '=')
            ->condition("date_ref.field_cot_date_value", "$date", '<=')
            ->orderBy('date_ref.field_cot_date_value', 'DESC')
            ->range(0,1);
      
      $result = $query->execute();
      foreach ($result as $record) {
          $entity->$field[LANGUAGE_NONE][0]['target_id'] = $record->entity_id;
      } 	 
 
  }
}