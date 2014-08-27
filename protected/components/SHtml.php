<?php
class SHtml extends CHtml
{
        public static function enumItem($model,$attribute)
        {
                $attr=$attribute;
                self::resolveName($model,$attr);
                preg_match('/\((.*)\)/',$model->tableSchema->columns[$attr]->dbType,$matches);
                foreach(explode(',', $matches[1]) as $value)
                {
                        $value=str_replace("'",null,$value);
                        $values[$value]=Yii::t('enumItem',$value);
                }
                
                return $values;
        }  

       public static function enumDropDownList($model, $attribute, $htmlOptions, $selected=false)
       {
       	  if (isset($selected) && !empty($selected)) {
       	  	foreach($selected as $key => $val) {
       	  		$model->$key = $val;
       	  	}
       	  }
       	  
          return CHtml::activeDropDownList( $model, $attribute,SHtml::enumItem($model,  $attribute), $htmlOptions);
       
       
       }

}
