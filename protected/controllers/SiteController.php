<?php

class SiteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	/**
	 * This action is called when user wants to filter the input
	 * based on some parameters, or to order the content.
	 */
	public function actionFilter($ajax)
	{
		$query = "select * from LearnHub ".$this->generateWhere().$this->generateOrder();
		$result = Yii::app()->db->createCommand($query)->queryAll();
		echo CJSON::encode($result);
	}
	/**
	 * Returns all the course details in json format.
	 */
	public function actionCourses($ajax)
	{
		echo json_encode(Yii::app()->db->createCommand("select * from LearnHub")->queryAll());
	}
}