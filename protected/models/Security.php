<?php

/**
 * This is the model class for table "security".
 *
 * The followings are the available columns in table 'security':
 * @property integer $camera
 * @property string $filename
 * @property integer $frame
 * @property integer $file_type
 * @property string $time_stamp
 * @property string $event_time_stamp
 */
class Security extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Security the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'security';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('filename, time_stamp', 'required'),
			array('camera, frame, file_type,changed_pixels,noise_level,width,height,x,y', 'numerical', 'integerOnly'=>true),
			array('filename', 'length', 'max'=>80),
			array('event_time_stamp', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('camera, filename, frame, file_type, time_stamp, event_time_stamp,changed_pixels,noise_level,width,height,x,y', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'camera' => 'Camera',
			'filename' => 'Filename',
			'frame' => 'Frame',
			'file_type' => 'File Type',
			'time_stamp' => 'Time Stamp',
			'event_time_stamp' => 'Event Time Stamp',
			'chenged_pixels' => 'Changed Pixels',
			'noise_level' => 'Noise Level',
			'width' => 'Width',
			'hieght' => 'hieght',
			'x' => 'X',
			'y' => 'Y',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$count = Yii::app()->params['thumbCount'];

		(isset($_REQUEST['Security_sort'])) ? $sorted = explode(".",$_REQUEST['Patients_sort']) : $sorted = null;
		$default = "time_stamp DESC";
		if (!empty($sorted))
		{
			(isset($sorted[0])) ? $sort = $sorted[0] : $sort = '';
			(isset($sorted[1])) ? $sort .= ' '.$sorted[1] : $sort .= '';
// 			if (!preg_match('%(first|last)%i',$sort))
// 			{
// 				$sort .= ', '.$default;
// 			}
// 			elseif (preg_match('%first%i',$sort))
// 			{
// 				$sort .= ', last_name ASC';
// 			}
// 			elseif (preg_match('%last%i',$sort))
// 			{
// 				$sort .= ', first_name ASC';
// 			}
		}
		else
		{
			$sort = $default;
		}
		
		$criteria=new CDbCriteria;

		if (isset($this->camera) && !empty($this->camera)) $criteria->compare("camera", $this->camera, true);
		if (isset($this->filename) && !empty($this->filename)) $criteria->addCondition("upper(filename) LIKE upper(%".$this->filename."%)");
		if (isset($this->frame) && !empty($this->frame)) $criteria->compare("frame", $this->frame, true);
		if (isset($this->file_type) && !empty($this->file_type)) $criteria->compare("upper(file_type)", "upper(%".$this->file_type."%)", true);
		if (isset($this->time_stamp) && !empty($this->time_stamp)) $criteria->compare("time_stamp", $this->time_stamp, true);
		if (isset($this->event_time_stamp) && !empty($this->event_time_stamp)) $criteria->compare("event_time_stamp", $this->event_time_stamp,true);
		if (isset($this->changed_pixels) && !empty($this->changed_pixels)) $criteria->compare("changed_pixels", $this->changed_pixels, true);
		if (isset($this->noise_level) && !empty($this->noise_level)) $criteria->compare("noise_level", $this->noise_level, true);
		if (isset($this->width) && !empty($this->width)) $criteria->compare("width", $this->width, true);
		if (isset($this->height) && !empty($this->height)) $criteria->compare("height",$this->height,true);
		if (isset($this->x) && !empty($this->x)) $criteria->compare("x",$this->x,true);
		if (isset($this->y) && !empty($this->y)) $criteria->compare("y",$this->y,true);
		
		$criteria->order = $sort;
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
				'pagination' => array('pageSize' => $count),				
		));
	}
}