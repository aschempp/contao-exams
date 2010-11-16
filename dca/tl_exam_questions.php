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
 * Table tl_exam_questions
 */
$GLOBALS['TL_DCA']['tl_exam_questions'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'					=> 'Table',
		'enableVersioning'				=> true,
		'ptable'						=> 'tl_exam',
		'ctables'						=> array('tl_exam_options'),
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'						=> 4,
			'fields'					=> array('sorting'),
			'panelLayout'				=> 'filter;search,limit',
			'headerFields'				=> array('name', 'displayMode', 'participantMode'),
			'child_record_callback'		=> array('tl_exam_questions', 'listRows')
		),
		'label' => array
		(
			'fields'					=> array('question'),
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
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_questions']['edit'],
				'href'					=> 'act=edit',
				'icon'					=> 'edit.gif'
			),
			'copy' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_questions']['copy'],
				'href'					=> 'act=copy',
				'icon'					=> 'copy.gif'
			),
			'cut' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_questions']['cut'],
				'href'					=> 'act=paste&amp;mode=cut',
				'icon'					=> 'cut.gif',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"'
			),
			'delete' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_questions']['delete'],
				'href'					=> 'act=delete',
				'icon'					=> 'delete.gif',
				'attributes'			=> 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_questions']['show'],
				'href'					=> 'act=show',
				'icon'					=> 'show.gif'
			),
			'options' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_questions']['options'],
				'href'					=> 'table=tl_exam_options',
				'icon'					=> 'system/modules/exams/html/options.png',
				'button_callback'		=> array('tl_exam_questions', 'optionsButton'),
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'					=> array('type', 'mode'),
		'default'						=> '{question_legend},question,type;{description_legend:hide},description_intro,description_extro,feedback;{publish_legend},published',
		'radio'							=> '{question_legend},question,type;{description_legend:hide},description_intro,description_extro,feedback;{publish_legend},published',
		'select'						=> '{question_legend},question,type;{description_legend:hide},description_intro,description_extro,feedback;{publish_legend},published',
		'checkbox'						=> '{question_legend},question,type,mode;{description_legend:hide},description_intro,description_extro,feedback;{publish_legend},published',
		'checkboxone'					=> '{question_legend},question,type,mode,points_correct,points_incorrect;{description_legend:hide},description_intro,description_extro,feedback;{publish_legend},published',
		'checkboxall'					=> '{question_legend},question,type,mode,points_correct,points_incorrect;{description_legend:hide},description_intro,description_extro,feedback;{publish_legend},published',
		'text'							=> '{question_legend},question,type;{description_legend:hide},description_intro,description_extro,feedback;{publish_legend},published',
	),

	// Fields
	'fields' => array
	(
		'type' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_questions']['type'],
			'exclude'					=> true,
			'inputType'					=> 'select',
			'default'					=> 'checkbox',
			'options'					=> array('radio', 'select', 'checkbox', 'text'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_exam_questions']['type'],
			'eval'						=> array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50'),
		),
		'mode' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_questions']['mode'],
			'exclude'					=> true,
			'inputType'					=> 'select',
			'default'					=> 'all',
			'options'					=> array('all', 'one', 'points'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_exam_questions']['mode'],
			'eval'						=> array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'w50'),
		),
		'points_correct' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_questions']['points_correct'],
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'rgxp'=>'digits', 'maxlength'=>10, 'tl_class'=>'w50'),
		),
		'points_incorrect' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_questions']['points_incorrect'],
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'rgxp'=>'digits', 'maxlength'=>10, 'tl_class'=>'w50'),
		),
		'question' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_questions']['question'],
			'exclude'					=> true,
			'inputType'					=> 'textarea',
			'eval'						=> array('mandatory'=>true, 'style'=>'height:80px', 'tl_class'=>'clr'),
		),
		'description_intro' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_questions']['description_intro'],
			'exclude'					=> true,
			'inputType'					=> 'textarea',
			'eval'						=> array('rte'=>'tinyMCE'),
		),
		'description_extro' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_questions']['description_extro'],
			'exclude'					=> true,
			'inputType'					=> 'textarea',
			'eval'						=> array('rte'=>'tinyMCE'),
		),
		'feedback' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_questions']['feedback'],
			'exclude'					=> true,
			'inputType'					=> 'textarea',
			'eval'						=> array('rte'=>'tinyMCE'),
		),
		'published' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_questions']['published'],
			'exclude'					=> true,
			'inputType'					=> 'checkbox',
			'eval'						=> array('doNotCopy'=>true)
		),
	)
);


class tl_exam_questions extends Backend
{

	public function listRows($row)
	{
		$arrOptions = array();
		if ($row['type'] != 'text')
		{
			$objOptions = $this->Database->prepare("SELECT * FROM tl_exam_options WHERE pid=?")->execute($row['id']);
			
			while( $objOptions->next() )
			{
				$arrOptions[] = $objOptions->label . ' <span style="color:#b3b3b3; padding-left:3px;">[' . (($row['type'] == 'checkbox' && $row['mode'] != 'points') ? ($objOptions->correct ? $GLOBALS['TL_LANG']['MSC']['answer_correct'] : $GLOBALS['TL_LANG']['MSC']['answer_incorrect']) : sprintf($GLOBALS['TL_LANG']['MSC']['answer_points'], $objOptions->points)) . ']</span>';
			}
		}
		
		return '
<div class="cte_type ' . ($row['published'] ? '' : 'un') . 'published">' . $GLOBALS['TL_DCA']['tl_exam_questions']['fields']['type']['reference'][$row['type']] . '</div>
<div class="limit_height' . (!$GLOBALS['TL_CONFIG']['doNotCollapse'] ? ' h16' : '') . ' block" style="margin-top: -10px">
' . $row['question'] . (count($arrOptions) ? '
<ul style="margin: 5px 0; padding: 0px 20px">
<li style="list-style-type: disc">' . implode("</li>\n<li style=\"list-style-type: disc\">", $arrOptions) . '</li>
</ul>' : '') . '
</div>' . "\n";
	}
	
	
	/**
	 * Hide the "options" button if in text-mode
	 */
	public function optionsButton($row, $href, $label, $title, $icon, $attributes)
	{
		return $row['type'] != 'text' ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : ' ';
	}
}

