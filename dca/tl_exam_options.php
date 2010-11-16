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
 * Table tl_exam_options
 */
$GLOBALS['TL_DCA']['tl_exam_options'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'					=> 'Table',
		'enableVersioning'				=> true,
		'ptable'						=> 'tl_exam_questions',
		'onload_callback' => array
		(
			array('tl_exam_options', 'checkMode'),
		),
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'						=> 4,
			'fields'					=> array('sorting'),
			'flag'						=> 1,
			'panelLayout'				=> 'filter;search,limit',
			'headerFields'				=> array('question', 'type'),
			'child_record_callback'		=> array('tl_exam_options', 'listRows')
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
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_options']['edit'],
				'href'					=> 'act=edit',
				'icon'					=> 'edit.gif'
			),
			'copy' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_options']['copy'],
				'href'					=> 'act=paste&amp;mode=copy',
				'icon'					=> 'copy.gif'
			),
			'cut' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_options']['cut'],
				'href'					=> 'act=paste&amp;mode=cut',
				'icon'					=> 'cut.gif',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"'
			),
			'delete' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_options']['delete'],
				'href'					=> 'act=delete',
				'icon'					=> 'delete.gif',
				'attributes'			=> 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_options']['show'],
				'href'					=> 'act=show',
				'icon'					=> 'show.gif'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'						=> '{label_legend},label;{rating_legend},points,correct;{feedback_legend:hide},feedback',
	),

	// Fields
	'fields' => array
	(
		'label' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_options']['label'],
			'exclude'					=> true,
			'inputType'					=> 'textarea',
			'eval'						=> array('mandatory'=>true, 'style'=>'height:60px'),
		),
		'points' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_options']['points'],
			'exclude'					=> true,
			'default'					=> '0',
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>10, 'rgxp'=>'digits', 'tl_class'=>'clr'),
		),
		'correct' => array
		(
			'exclude'					=> true,
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_options']['correct'],
			'inputType'					=> 'checkbox',
			'eval'						=> array('doNotCopy'=>true, 'tl_class'=>'clr'),
		),
		'feedback' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_options']['feedback'],
			'exclude'					=> true,
			'inputType'					=> 'textarea',
			'eval'						=> array('rte'=>'tinyMCE'),
		),
	)
);


class tl_exam_options extends Backend
{

	protected $question;

	/**
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @return string
	 */
	public function listRows($row)
	{
		if (!$this->arrQuestion)
		{
			$this->question = $this->Database->prepare("SELECT * FROM tl_exam_questions WHERE id=?")->limit(1)->execute($row['pid']);
		}
		
		return '
<div style="margin-top: -15px">' . $row['label'] . ' <span style="color:#b3b3b3; padding-left:3px;">[' . (($this->question->type == 'checkbox' && $this->question->mode != 'points') ? ($row['correct'] ? $GLOBALS['TL_LANG']['MSC']['answer_correct'] : $GLOBALS['TL_LANG']['MSC']['answer_incorrect']) : sprintf($GLOBALS['TL_LANG']['MSC']['answer_points'], $row['points'])) . ']</span></div>';
	}
	
	
	public function checkMode($dc)
	{
		$act = $this->Input->get('act');
		
		if (!strlen($act))
		{
			$objQuestion = $this->Database->prepare("SELECT * FROM tl_exam_questions WHERE id=?")->limit(1)->execute($dc->id);
		
			if (!$objQuestion->numRows)
				return;
				
			if( $objQuestion->type == 'checkbox' )
			{
				$GLOBALS['TL_DCA']['tl_exam_options']['list']['sorting']['headerFields'][] = 'mode';
				
				switch( $objQuestion->mode )
				{
					case 'all':
					case 'one':
						$GLOBALS['TL_DCA']['tl_exam_options']['list']['sorting']['headerFields'][] = 'points_correct';
						$GLOBALS['TL_DCA']['tl_exam_options']['list']['sorting']['headerFields'][] = 'points_incorrect';
						break;
				}
			}
		}
		elseif ($act == 'edit')
		{
			$objQuestion = $this->Database->prepare("SELECT q.* FROM tl_exam_options o LEFT OUTER JOIN tl_exam_questions q ON q.id=o.pid WHERE o.id=?")->limit(1)->execute($dc->id);
		
			if (!$objQuestion->numRows)
				return;
				
			switch( $objQuestion->type )
			{
				case 'radio':
				case 'select':
					$strField = 'correct';
					break;
					
				case 'checkbox':
					switch( $objQuestion->mode )
					{
						case 'all':
						case 'one':
							$strField = 'points';
							break;
							
						case 'points':
							$strField = 'correct';
							break;
					}
					break;
			}
			
			$GLOBALS['TL_DCA']['tl_exam_options']['palettes']['default'] = str_replace(','.$strField, '', $GLOBALS['TL_DCA']['tl_exam_options']['palettes']['default']);
		}
	}
}

