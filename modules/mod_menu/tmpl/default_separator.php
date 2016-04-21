<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

<<<<<<< HEAD
// Note. It is important to remove spaces between elements.
$class = $item->anchor_css ? ' ' . $item->anchor_css : '';
$title = $item->anchor_title ? ' title="' . $item->anchor_title . '" ' : '';
=======
$title = $item->anchor_title ? ' title="' . $item->anchor_title . '"' : '';
$anchor_css = $item->anchor_css ? $item->anchor_css : '';

$linktype = $item->title;

>>>>>>> joomla/staging
if ($item->menu_image)
{
	$linktype = JHtml::_('image', $item->menu_image, $item->title);

	if ($item->params->get('menu_text', 1))
	{
<<<<<<< HEAD
		$item->params->get('menu_text', 1) ?
		$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' :
		$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
}
else
{
	$linktype = $item->title;
}

?>
<span class="separator<?php echo $class;?>"<?php echo $title; ?>>
	<?php echo $linktype; ?>
</span>
=======
		$linktype .= '<span class="image-title">' . $item->title . '</span>';
	}
}

?>
<span class="separator <?php echo $anchor_css; ?>"<?php echo $title; ?>><?php echo $linktype; ?></span>
>>>>>>> joomla/staging
