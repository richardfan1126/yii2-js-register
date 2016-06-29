<?php

namespace richardfan\widget;

use yii\base\Widget;
use yii\web\View;

/**
 * Widget for registering script from view file
 * 
 * Getting script in between this widget and register it by \yii\web\View::registerJs()
 */
class JSRegister extends Widget {
	//variables to be passed to \yii\base\View::registerScript()
	public $id = null;
	public $position = View::POS_READY;
	
	/**
	 * Start widget by calling ob_start(), caching all output to output buffer
	 * @see \yii\base\Widget::begin()
	 */
	public static function begin($config = []){
		$widget = parent::begin($config);
		
		ob_start();
		
		return $widget;
	}
	
	
	/**
	 * Get script from output buffer, and register by \yii\web\View::registerJs()
	 * @see \yii\base\Widget::end()
	 */
	public static function end(){
		$script = ob_get_clean();
		$widget = parent::end();
		
		if(preg_match("/^\\s*\\<script\\>(.*)\\<\\/script\\>\\s*$/s", $script, $matches)){
			$script = $matches[1];
		}
		
		$widget->view->registerJs($script, $widget->position, $widget->id);
		
	}
}