<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Andreas Schempp 2009
 * @author     Andreas Schempp <andreas@schempp.ch>
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */


/**
 * Table tl_exam_feedback
 */
$GLOBALS['TL_DCA']['tl_exam_feedback'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'					=> 'Table',
		'enableVersioning'				=> true,
		'ptable'						=> 'tl_exam',
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'						=> 4,
			'fields'					=> array('points DESC'),
			'panelLayout'				=> 'filter;search,limit',
			'disableGrouping'			=> true,
			'headerFields'				=> array('name', 'displayMode', 'participantMode'),
			'child_record_callback'		=> array('tl_exam_feedback', 'listRows'),
		),
		'label' => array
		(
			'fields'					=> array('points'),
			'format'					=> '%s',
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'					=> 'act=select',
				'class'					=> 'header_edit_all',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_feedback']['edit'],
				'href'					=> 'act=edit',
				'icon'					=> 'edit.gif'
			),
			'copy' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_feedback']['copy'],
				'href'					=> 'act=copy',
				'icon'					=> 'copy.gif'
			),
			'delete' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_feedback']['delete'],
				'href'					=> 'act=delete',
				'icon'					=> 'delete.gif',
				'attributes'			=> 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_feedback']['show'],
				'href'					=> 'act=show',
				'icon'					=> 'show.gif'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'						=> '{feedback_legend},points,feedback;{publish_legend},published',
	),

	// Fields
	'fields' => array
	(
		'points' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_feedback']['points'],
			'exclude'					=> true,
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>10, 'rgxp'=>'digits', 'tl_class'=>'clr'),
		),
		'feedback' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_feedback']['feedback'],
			'exclude'					=> true,
			'inputType'					=> 'textarea',
			'eval'						=> array('mandatory'=>true, 'rte'=>'tinyMCE'),
		),
		'published' => array
		(
			'exclude'					=> true,
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_feedback']['published'],
			'inputType'					=> 'checkbox',
			'eval'						=> array('doNotCopy'=>true),
		),
	)
);


class tl_exam_feedback extends Backend
{

	/**
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @return string
	 */
	public function listRows($row)
	{
return '
<div class="cte_type ' . ($row['published'] ? '' : 'un') . 'published"><strong>' . sprintf($GLOBALS['TL_LANG']['tl_exam_feedback']['rowPoints'], $row['points']) . ':</strong></div>
<div class="limit_height' . (!$GLOBALS['TL_CONFIG']['doNotCollapse'] ? ' h64' : '') . ' block">
' . $row['feedback'] . '
</div>' . "\n";
	}
}

