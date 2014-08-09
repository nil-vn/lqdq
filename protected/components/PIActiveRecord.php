<?php

/**
 * @ingroup components
 * Base class of a data record
 */
class PIActiveRecord extends CActiveRecord
{
	public $enableLanguage = false;
	
	/*public function findByPk($pk, $condition = '', $params = array()) {
		if (preg_match("/^0x[0-9a-zA-Z]+/", $pk))
			$pk = "x'".substr($pk, 2)."'";
		else 
			$pk = "x'".IDHelper::uuidFromBinary($pk, true) . "'";
			
		$primaryKey = $this->metaData->tableSchema->primaryKey;
		$primary_condition = "{$primaryKey}={$pk}";
		
		if (!empty($condition)) {
			$condition = $primary_condition . " AND {$condition}";
		} else {
			$condition = $primary_condition;
		}
		
		return $this->findByAttributes(array(), $condition, $params); 
	}*/
	
	/**
	 * This method is invoked before saving a record (after validation, if any).
	 * The default implementation raises the onBeforeSave event.
	 * You may override this method to do any preparation work for record saving.
	 * Use isNewRecord to determine whether the saving is
	 * for inserting or updating record.
	 * Make sure you call the parent implementation so that the event is raised properly.
	 * @return boolean whether the saving should be executed. Defaults to true.
	 */
	public function beforeSave()
	{
		parent::beforeSave();
		//Kiểm tra và tự động thêm trường alias theo tên
		if(isset($this->alias))
		{
			
			$table = get_class($this);
			$model = $table::model()->find( array(
				'condition'=>'alias=:alias', 
				'params'=>array(':alias'=>alias($this->name))
			));
			if(count($model) >= 1){
				if($model->id == $this->id){
					$this->setAttribute('alias', alias($this->name));
				}else{
					$this->setAttribute('alias', alias($this->name).'-'.rand(1,999));
				}
			}else{
				$this->setAttribute('alias', alias($this->name));
			}
			
		}
		// Quản lý Primary Key theo UUID
		/*if ($this->getIsNewRecord())
		{
			if (!isset($this->id)) {
				$pk = $this->getTableSchema()->primaryKey;
					
				$pattern = "/(\\0|\\r|\\n|\\\\)/";
				// Perform remove null charactor
				do {
					$uuid = IDHelper::uuidToBinary(IDHelper::uuid());
					$uuid = preg_replace($pattern, "pi", $uuid);
				} while (preg_match("/(\\0|\\r|\\n|\\\\)/", $uuid));
					
				$this->setAttribute('id', $uuid);
			}
			
			// Xử lý ngôn ngữ
			if ($this->enableLanguage) {
				$tableSchema = $this->getTableSchema();
				
				if (isset($tableSchema->columns['locale'])) {
					$this->setAttribute('locale', Yii::app()->language);
				}
			}
		}*/
		
		
		return true;
	}
	
	protected function beforeFind()
	{
		// Xử lý ngôn ngữ
		if ($this->enableLanguage) {
			$tableSchema = $this->getTableSchema();
			
			if (isset($tableSchema->columns['locale'])) {
				$criteria = new CDbCriteria;
				$criteria->condition = "locale = '".Yii::app()->language."'";
				$this->dbCriteria->mergeWith($criteria);
				
				//$this->setAttribute('locale', Yii::app()->language);
			}
		}
		
		parent::beforeFind();
	}
	
	/**
	 * This method is uses to check if content contain word length too long
	 */
	public function checkWordCount($attribute, $params)
	{
		$length = isset($params['length']) ? $params['length'] : 30;
		$content = preg_replace('/\n/', ' ', $this->$attribute);
		
		//preg_match_all("/[ ]+/"
		$arrWords = explode(' ', $content);
		$arrWords = array_unique($arrWords);
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		
		foreach ($arrWords as $word) {
			if (strlen(trim($word)) > $length && !preg_match($reg_exUrl, $word, $url)) {
				$this->addError($attribute, 'The length of each word should not exceed '.$length.' characters');
				break;
			}
		}
		
	}
	
}
