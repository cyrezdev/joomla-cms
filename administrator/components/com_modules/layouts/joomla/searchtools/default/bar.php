<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$data = $displayData;

<<<<<<< HEAD
$clientIdField = $data['view']->filterForm->getField('client_id');
JFactory::getDocument()->addScriptDeclaration(
	"
		jQuery.fn.clearPositionType = function(){
			jQuery('#filter_position, #filter_module, #filter_language').val('');
		};
	"
);

?>
<div class="js-stools-field-filter js-stools-client_id hidden-phone hidden-tablet">
	<?php echo $clientIdField->input; ?>
</div>
<?php
=======
if ($data['view'] instanceof ModulesViewModules)
{
	// We will get the client filter & remove it from the form filters
	$clientIdField = $data['view']->filterForm->getField('client_id');
?>
	<div class="js-stools-field-filter js-stools-client_id">
		<?php echo $clientIdField->input; ?>
	</div>
<?php
}

>>>>>>> joomla/staging
// Display the main joomla layout
echo JLayoutHelper::render('joomla.searchtools.default.bar', $data, null, array('component' => 'none'));
