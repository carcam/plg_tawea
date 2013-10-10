<?php
/**
 * @author       Carlos M. Cámara
 * @copyright    Copyright (C) 2013 Carlos M. Cámara Mora. All rights reserved.
 * @license      GNU General Public License version 2 or later; see LICENSE.txt
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

		if ( $app->getClientId() === 0 )
		{
			$elementToGrab = '</head>';

			$htmlToInsert = "
				<!-- JoomlaWorks \"DISQUS Comments for Joomla!\" (v3.4) -->
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


		//Get Params
		$whenToShow = $this->params->def('whentoshow');

		

                                    
		return;
	}
}