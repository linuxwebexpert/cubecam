<?php

class ViewerController extends Controller
{
	public $pathPrefix = '/cubecop/';
		
	public $pathSuffix = '.jpg';
		
	public $alt = '';
			
	public $htmlOptions = array ('width'=>'128');
	
	public $name = '';
		
	
	public function actionIndex()
	{
		$count = 48;
		$page = (isset($_GET['page']) ? $_GET['page'] : 0);  // define the variable to “LIMIT” the query
		
// 		$dataProvider=new CActiveDataProvider('Security');

// the pagination itself
		
		$criteria = new CDbCriteria();
		$criteria->condition = 'time_stamp >='.date("Y-m-d",strtotime("-7 days",time()));
		$criteria->order = 'time_stamp desc';
		$criteria->limit = $count;
		$criteria->offset = $count * $page;
		
		
		$model = Security::model()->findAll($criteria);
		
		$item_count = Security::model()->count($criteria);
				
		$pages = new CPagination($item_count);
		$pages->setPageSize($count);
		$pages->applyLimit($criteria);
								
		$this->render('index',array(
			'model'=>$model,
			'page_size' => $count,
			'pages'=>$pages,
			'item_count' => $item_count,
				
		));		
	}


	public function actionAdmin()
	{
		$model=new Security('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Viewer']))
			$model->attributes=$_GET['Viewer'];
		
		$this->render('admin', array(
			'model'=>$model,
		));
	}
	
	public function gridFilename ($data,$row,$htmlOptions = '') 
	{
		$security = Security::model()->findAllByAttributes(array('filename'=>$data->filename));
		
// 		$this->name = preg_replace('%^.+\/(files.*?)\.jpg%','$1',$data->filename);
		$this->name = preg_replace('%^.+\/html(.*?)\.jpg%','$1',$data->filename);
		
		$image = CHtml::image($this->name . $this->pathSuffix,
			$this->alt,
			$this->htmlOptions);
		
// 		return CHtml::link($image,array($this->pathPrefix.$this->name.$this->pathSuffix),array('class'=>'frame','title'=>$this->name));
		return $this->name.$this->pathSuffix;
		
	}
	
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}