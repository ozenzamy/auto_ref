<?php




/**
* System Class contient all interaction with the database
*/
class AutoRef 
{
  public static function autoRef_loader($entity){
	     $entity_key = array_keys(get_object_vars($entity));
       for ($i=0; $i < count($entity_key) ; $i++) { 
         if(strpos($entity_key[$i], 'field_autoref_') !== false){
            $field = $entity_key[$i];
            $key = explode('__', $entity_key[$i]);
            $key = explode('_', $key[1]);
            $key = implode(' ', $key);
            $key = '-' . $key;

              $date = $entity->field_cot_date[LANGUAGE_NONE][0]['value'];
          $date = strtotime("$date");
          $date = date('Y-m-d', strtotime($key, $date));
          $maxDate = date('Y-m-d', strtotime('-6 years', $date));
          $ref = $entity->field_cot_ref[LANGUAGE_NONE][0]['target_id'];
          
          $query = db_select('field_data_field_cot_ref', 'cot_ref');
          $query->join('field_data_field_cot_date', 'date_ref', "cot_ref.entity_id = date_ref.entity_id");
          $query->fields('cot_ref', array('entity_id'))
                ->fields('date_ref', array('field_cot_date_value'))
                ->condition("cot_ref.field_cot_ref_target_id", $ref, '=')
                ->condition("date_ref.field_cot_date_value", "$maxDate", '>=')
                ->orderBy('date_ref.field_cot_date_value', 'DESC');
          
          $result = $query->execute();
          foreach ($result as $record) {
             if($record->field_cot_date_value <= $date){
                $entity->{$field}[LANGUAGE_NONE][0]['target_id'] = $record->entity_id;
                break;
              }
          }    
         }
       }
  }
}