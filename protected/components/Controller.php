<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	public $topMenu;
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function uniqueSort($data)
	{
		$results = array();
		foreach ($data as $item)
		{
			foreach ($item as $k=>$v)
			{
				if (!isset($results[$k]) || !in_array($v,$results[$k])) $results[$k][] = $v;
			}
		}
		return $results;
	}
	
	public function topMenu()
	{
		
		$controllers = array();
		$files = CFileHelper::findFiles(realpath(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'controllers'));
		foreach($files as $file){
				if (!preg_match("%\.svn%",$file))
				{
			        $filename = basename($file, '.php');
			        if( ($pos = strpos($filename, 'Controller')) > 0){
			                $controllers[] = substr($filename, 0, $pos);
			        }
				}
		}
		
		(in_array(Yii::app()->user->name,Yii::app()->params['IT'])) ? $admin = true : $admin = false;

		$i = 0;
		$menu = array();
		$menu['items'][$i]=array('label'=>'Home','url'=>array('/site/index'));
		$i++;
		$menu['items'][$i]=array('label'=>'Controls','url'=>array('#'));
		$c = 0;
		$items = array();
		foreach ($controllers as $control)
		{
			$view = 'admin';
			if (preg_match('%site%i',$control)) continue;
//			(preg_match("%sftp%i",$control)) ? $controls = strtolower(substr($control,0,1)).strtoupper(substr($control,1,strlen($control)-1)) : $controls = strtolower($control);
//			if (preg_match('%sftp%i',$control)) $control = strtolower(substr($control,0,1)).strtoupper(substr($control,1,strlen($control)-1));
			if (preg_match("%engine%i",$control)) $view = 'index';
			if (preg_match("%xml%i",$control)) $view = 'load';
			//			if (preg_match('%hold%i',$control)) $control = preg_replace('%hold%i','Hold Status',$control);
			(preg_match('%history%i',$control)) ? $visible = $admin : $visible = true;
			$controls = $control;
			$items[] = array($controls,$controls,$view,$visible);
		}
		foreach ($items as $item)
		{
			list($control,$controls,$view,$visible) = $item;
			if (!preg_match('%Mes%',$control))
			{
				$menu['items'][$i]['items'][$c]=array('label'=>$control,'url'=>array('/'.$controls.'/'.$view),'visible'=>$visible);
				$c++;
			}
			else
			{
				$s=0;
				$menu['items'][$i]['items'][$c]=array('label'=>$control,'url'=>array('/'.$controls.'/'.$view),'visible'=>$visible);
				foreach ($mes as $res)
				{
					list($control,$controls,$view,$visible) = $res;
					$menu['items'][$i]['items'][$c]['items'][$s]=array('label'=>$control,'url'=>array('/'.$controls.'/'.$view),'visible'=>$visible);
					$s++;
				}
				$c++;
			}
		}
		$c=0;
		$i++;
		$menu['items'][$i]=array('label'=>'About','url'=>array('/site/page'));
		$i++;
		$menu['items'][$i]=array('label'=>'Contact','url'=>array('/site/index'));
/*
 * 
 		$i++;
		$s=0;
		$menu['items'][$i]=array('label'=>'SMES','url'=>'http://'.Yii::app()->params['hostname']);
		$menu['items'][$i]['items'][$s]=array('label'=>'Home','url'=>'http://'.Yii::app()->params['hostmachine'].'/');
		$s++;
		$menu['items'][$i]['items'][$s]=array('label'=>'EDA','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=pte');
		$c=0;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Outdoor Yield Energy','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=pte&page=power');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Pasan AOI','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=pte&page=aoi');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Composite AOI','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=pte&page=composite_aoi');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Pasan IV','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=pte&page=pasan');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Production EL','url'=>'http://'.Yii::app()->params['hostmachine'].'/archive/index/?C=M;O=D');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Engineering EL','url'=>'http://'.Yii::app()->params['hostmachine'].'/eng_archive/');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Reltron IV','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=pte&page=iv');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Dark IV','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=pte&page=serendipity');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Tools','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=pte&page=serendipity');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Equipment List','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=pte&page=pte_equipment');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Maintenance','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=pte&page=pte_maintenance');
		$s++;
		$menu['items'][$i]['items'][$s]=array('label'=>'Outdoor','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=outdoor');
		$c=0;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Download Daily','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=outdoor&page=outdoor');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Event Log','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=outdoor&page=outdoor_event_log');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Weather','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=outdoor&page=weather');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'US1 Outdoor AOI','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=outdoor&page=outdoor_aoi');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'OLD (2007-2010)','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=outdoor&page=outdoor_OLD');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'US2/3 AOI','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=outdoor&page=outdoor_energy_yield');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Energy Yield','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=outdoor&page=outdoor_energy');
		$s++;
		$menu['items'][$i]['items'][$s]=array('label'=>'Inventory','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=inventory');
		$c=0;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'On Hand','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=inventory&page=inventory');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Withdraw','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=inventory&page=in_out');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'IQA Request','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=inventory&page=inventory_iqa');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Enter PO','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=inventory&page=inventory_po');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'View POs','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=inventory&page=inventory_view_po');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Ship / Receive','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=inventory&page=shipping');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Shipping Log','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=inventory&page=ship_log');
		$s++;
		$menu['items'][$i]['items'][$s]=array('label'=>'Wip','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip');
		$c=0;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Reports','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=wip_query');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'View Lots','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=wip_view_lots');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'View Travellers','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=wip_view_travellers');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'View Lots','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=wip_view_lots');
		$c++;

		$buildip = array ("10.65.\d{1,3}.\d{1,3}","172.20.\d{1,3}.\d{1,3}","10.0.4.\d{1,3}");
		(isset($_SERVER['REMOTE_ADDR'])) ? $remoteip = $_SERVER['REMOTE_ADDR'] : $remoteip = null;
		$buildtest = false;
		foreach ($buildip as $ip) {
		  	if (preg_match("%".$ip."%i",$remoteip) && $remoteip != null) $buildtest = true;
		}	
		if ($buildtest) {		
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Request Build','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=wip_request_build');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Build Schedule','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=wip_view_builds');
		$c++;
		}
		
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Transact','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=wip_transact');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Transfer','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=wip_transfer');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'History Report','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=history');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Build Report','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=build_report');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Finished Goods','url'=>'http://'.Yii::app()->params['hostmachine'].'/?group=wip&page=wip_finished_goods');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Grading Report','url'=>'http://'.Yii::app()->params['hostmachine'].'/reports/master/grading');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'On Hand Report','url'=>'http://'.Yii::app()->params['hostmachine'].'/reports/master/onhand');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Master Report','url'=>'http://'.Yii::app()->params['hostmachine'].'/reports/master/admin');
		$c++;
		$menu['items'][$i]['items'][$s]['items'][$c]=array('label'=>'Final Report','url'=>'http://'.Yii::app()->params['hostmachine'].'/reports/master/final');
*/
		$i++;
		$menu['items'][$i]=array('label'=>'Login','url'=>array('/site/login'),'visible'=>Yii::app()->user->isGuest);
		$i++;
		$menu['items'][$i]=array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'),'visible'=>!Yii::app()->user->isGuest);
		
		
		$this->topMenu = $menu;				
	}
	
	protected function user_proc_exec ($command,&$result,&$status)
	{
		$process = proc_open(
		$command,
		array(
		0 => array("pipe", "r"), //STDIN
		1 => array("pipe", "w"), //STDOUT
		2 => array("pipe","w")), //STDERR
		$pipes
		);
		$result = stream_get_contents($pipes[1]);
		$error = stream_get_contents($pipes[2]);
		fclose($pipes[1]);
		fclose($pipes[2]);
		$status= proc_close($process);
		if (!empty($error)) $result = $error;
	}
	
	
	/**
	 *
	 * Convert an object to an array
	 *
	 * @param    object  $object The object to convert
	 * @reeturn      array
	 *
	 */
	function objectToArray( $object )
	{
		if( !is_object( $object ))
		{
			return $object;
		}
		if( is_object( $object ) )
		{
			$Class = get_parent_class($object);
			$object = get_object_vars( $object );
			(empty($object) && !empty($Class)) ? $retVal = $Class : $retVal = $object;
			
			if(is_array($retVal)) 
			{
				return array_map( 'self::objectToArray', $retVal );
			} else {
				return $retVal;
			}
		}
	}
	
}