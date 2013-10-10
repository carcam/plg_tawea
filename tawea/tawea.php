<?php
/**
 * @author       Carlos M. Cámara
 * @copyright    Copyright (C) 2013 Carlos M. Cámara Mora. All rights reserved.
 * @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Tawea plugin.
 *
 * @package	Joomla.Plugin
 * @subpackage	System.Tawea
 */
class plgSystemTawea extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @access      protected
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 * @since       1.5
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

	/**
	* @since	1.6
	*/
	public function onAfterRender()
	{
		$app =& JFactory::getApplication();

		//Get Params
		$whenToShow = $this->params->def('whentoshow');

		if ( $app->getClientId() === 0 )
		{
			switch ($whenToShow)
			{
				case 1:
					$this->setCode();
					break;
				case 2:
					$menu = $app->getMenu();
					$lang = JFactory::getLanguage();
					if ( $menu->getActive() == $menu->getDefault($lang->getTag()) )
					{
						$this->setCode();
					}
					break;
			}		

		}		
                                    
		return;
	}

	public function setCode()
	{
		$elementToGrab = '</head>';

		$htmlToInsert = "
		<script type='text/javascript'>
				(function(d) {var taw = d.createElement('script'),id = 'tawea-extension';

				if (d.getElementById(id)) {return;}

				taw.type = 'text/javascript';taw.id=id;taw.async=true;

				taw.src ='https://tawea.com/extension/js/sdk.min.js';

				(document.head||document.documentElement).appendChild(taw);})(document);

				</script>
		";

		// Output
		$buffer = JResponse::getBody();
		$buffer = str_replace($elementToGrab, $htmlToInsert."\n\n".$elementToGrab, $buffer);
		JResponse::setBody($buffer);
	}
}