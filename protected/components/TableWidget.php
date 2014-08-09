<?php

// protected/components/SubscriberFormWidget.php

class TableWidget extends CWidget
{
    /**
     * @var CFormModel
     */
    
	public $caption = null;
	public $headers = null;
	public $filter = null;
	public $model;
	public $row = null;
	public $item_count = 1;
	public $page_size = 2;
	public $pages = null;
	public $select;
	public $resultCaption = null;
	public $isView = false;
	public $inlineStyle = 'class="table table-bordered"';
	public $total = null;
	public function init()
    {
        // this method is called by CController::beginWidget()
    }
    public function run()
    {
        $this->render('tableWidget', array(
			'caption'=>$this->caption,
			'headers'=>$this->headers,
			'filter'=>$this->filter,
			'model'=>$this->model,
			'row' => $this->row,
			'item_count'=>$this->item_count,
			'page_size'=>$this->page_size,
			'pages'=>$this->pages,
			'inlineStyle' => $this->inlineStyle,
			'select'=>$this->select,
			'resultCaption'=>$this->resultCaption,
			'isView'=>$this->isView,
			'total'=>$this->total,
		));
    }
}

?>