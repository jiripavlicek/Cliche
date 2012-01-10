<?php
/**
 * @package cliche
 * @subpackage plugin
 */
class DefaultPlugin extends ClichePlugin {
    /**
     * Run the plugin against a specified event
     *
     * @param string $notify The event name
     * @param array $args An optionnal array of parameters passed with the event
     * @return void
     */
    public function notify( $event, $args = null ){
		$view = $this->obj->getProperty('view');
		$browse = $this->obj->getProperty('browse');
		/* We're not in browse mode - Use an alternative chunk for each item when not in image view */
		if(!$browse){
			$this->obj->setProperties(array(
				'albumItemTpl' => 'albumcoverzoom',
				'itemTpl' => 'itemzoom',
			));
		}		
		/* Load fancybox only if we are viewing a single image or we're not in browse mode */
		if($view == 'image' || !$browse){
			$this->modx->regClientStartupScript('http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js');
			$this->modx->regClientStartupScript($this->obj->config['plugins_url'] . 'default/fancybox/jquery.fancybox-1.3.4.pack.js');
			
			$this->modx->regClientHTMLBlock('<script type="text/javascript">$("a.zoom").fancybox();</script>');
		}
	}
}