<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	
	
	public function getCategories() {
		return Yii::app()->db->createCommand("select distinct(category) from LearnHub")->queryAll();
	}

	public function getTypes() {
		return Yii::app()->db->createCommand("select distinct(type) from LearnHub")->queryAll();
	}

	/**
	 * Generates the where clause of an sql query. Based on the
	 * input that came, this function creates the valid where clause
	 * and returns the same.
	 * @returns the generated where clause string.
	 * 
	 * All security(escaping strings) and error checkings are done
	 * in this function. Hence one can call this function gracefully.
	 */
	public function generateWhere()
	{
		$category_query = $type_query = "true";
		if (isset($_POST["types"]) && is_array($_POST["types"])){
			$types = $_POST["types"];
			foreach ($types as $key=>$value) {
				$value = mysql_escape_string($value);
				if ($key==0){
					$type_query = "type='$value'";
				}
				$type_query .= " or type='$value'";
			}
		}
		if (isset($_POST["categories"]) && is_array($_POST["categories"])){
			$categories = $_POST["categories"];
			foreach($categories as $key=>$value){
				$value = mysql_escape_string($value);
				if ($key==0){
					$category_query = "category='$value'";
				}
				$category_query .= " or category='$value'";
			}
		}
		return "where ($type_query) and ($category_query)";
	}

	/**
	 * Generates the order clause of an sql query. Based on the
	 * input that came, this function creates the valid order clause
	 * and returns the same.
	 * @returns the generated order clause string.
	 * 
	 * All security(escaping strings) and error checkings are done
	 * in this function. Hence one can call this function gracefully.
	 */
	public function generateOrder()
	{
		$query = " ";
		if (isset($_POST["order"]) && isset($_POST["orderby"])){
			$order = $_POST["order"];
			$orderby = $_POST["orderby"];

			if (is_string($order) && ($order==="type" || $order==="price" || $order==="category")){
				if (is_string($order) && ($orderby==="asc" || $orderby==="desc")){
					$query .= " order by ".$order." ".$orderby;
				}
			}
		}
		return $query;
	}
}