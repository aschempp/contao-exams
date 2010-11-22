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
 * Table tl_exam
 */
$GLOBALS['TL_DCA']['tl_exam'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'					=> 'Table',
		'enableVersioning'				=> true,
		'ctables'						=> array('tl_exam_pages'),
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'						=> 1,
			'fields'					=> array('name'),
			'flag'						=> 1,
			'panelLayout'				=> 'filter;search,limit',
		),
		'label' => array
		(
			'fields'					=> array('name', 'displayMode'),
			'format'					=> '%s <span style="color:#b3b3b3; padding-left:3px;">[%s]</span>',
			'label_callback'			=> array('tl_exam', 'addIcon')
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
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam']['edit'],
				'href'					=> 'act=edit',
				'icon'					=> 'edit.gif'
			),
			'copy' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam']['copy'],
				'href'					=> 'act=copy',
				'icon'					=> 'copy.gif'
			),
			'delete' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam']['delete'],
				'href'					=> 'act=delete',
				'icon'					=> 'delete.gif',
				'attributes'			=> 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam']['show'],
				'href'					=> 'act=show',
				'icon'					=> 'show.gif'
			),
			'questions' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam']['questions'],
				'href'					=> 'table=tl_exam_questions',
				'icon'					=> 'system/modules/exams/html/questions.png'
			),
			'pages' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam']['pages'],
				'href'					=> 'table=tl_exam_pages',
				'icon'					=> 'system/modules/exams/html/pages.png',
				'button_callback'		=> array('tl_exam', 'pagesButton'),
			),
			'feedback' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam']['feedback'],
				'href'					=> 'table=tl_exam_feedback',
				'icon'					=> 'system/modules/exams/html/feedback.png',
			),
			'participants' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam']['participants'],
				'href'					=> 'table=tl_exam_participants',
				'icon'					=> 'system/modules/exams/html/participants.png',
				'button_callback'		=> array('tl_exam', 'participantsButton'),
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'					=> array('displayMode', 'participantMode'),
		'default'						=> '{name_legend},name,title;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,instantFeedback,navigation;{participant_legend},participantMode;{publish_legend:hide},start,stop',
		'single'						=> '{name_legend},name,title;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,instantFeedback,navigation;{participant_legend},participantMode;{publish_legend:hide},start,stop',
		'random'						=> '{name_legend},name,title;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,limitQuestions,instantFeedback,navigation;{participant_legend},participantMode;{publish_legend:hide},start,stop',
		'page'							=> '{name_legend},name,title;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,instantFeedback,navigation;{participant_legend},participantMode;{publish_legend:hide},start,stop',
		'pages'							=> '{name_legend},name;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,instantFeedback,navigation;{participant_legend},participantMode;{publish_legend:hide},start,stop',
		'singlemember'					=> '{name_legend},name,title;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,instantFeedback,navigation;{participant_legend},participantMode,attempts,timeout;{publish_legend:hide},start,stop',
		'randommember'					=> '{name_legend},name,title;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,limitQuestions,instantFeedback,navigation;{participant_legend},participantMode,attempts,timeout;{publish_legend:hide},start,stop',
		'pagemember'					=> '{name_legend},name,title;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,instantFeedback,navigation;{participant_legend},participantMode,attempts,timeout;{publish_legend:hide},start,stop',
		'pagesmember'					=> '{name_legend},name;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,instantFeedback,navigation;{participant_legend},participantMode,attempts,timeout;{publish_legend:hide},start,stop',		
		'singleindividual'				=> '{name_legend},name,title;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,instantFeedback,navigation;{participant_legend},participantMode,members,attempts,timeout;{publish_legend:hide},start,stop',
		'randomindividual'				=> '{name_legend},name,title;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,limitQuestions,instantFeedback,navigation;{participant_legend},participantMode,members,attempts,timeout;{publish_legend:hide},start,stop',
		'pageindividual'				=> '{name_legend},name,title;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,instantFeedback,navigation;{participant_legend},participantMode,members,attempts,timeout;{publish_legend:hide},start,stop',
		'pagesindividual'				=> '{name_legend},name;{config_legend},jumpTo,displayMode,pointsToPass,pointsMax,instantFeedback,navigation;{participant_legend},participantMode,members,attempts,timeout;{publish_legend:hide},start,stop',		
	),

	// Fields
	'fields' => array
	(
		'name' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['name'],
			'exclude'					=> true,
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long'),
		),
		'title' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['title'],
			'exclude'					=> true,
			'inputType'					=> 'text',
			'eval'						=> array('maxlength'=>255, 'tl_class'=>'long'),
		),
		'jumpTo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_exam']['jumpTo'],
			'exclude'                 => true,
			'inputType'               => 'pageTree',
			'eval'                    => array('fieldType'=>'radio', 'tl_class'=>'clr')
		),
		'displayMode' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['displayMode'],
			'exclude'					=> true,
			'default'					=> 'single',
			'inputType'					=> 'radio',
			'options'					=> array('single', 'random', 'page', 'pages'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_exam'],
			'eval'						=> array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'clr'),
		),
		'pointsToPass' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['pointsToPass'],
			'exclude'					=> true,
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'rgxp'=>'digits', 'maxlength'=>10, 'tl_class'=>'w50'),
		),
		'pointsMax' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['pointsMax'],
			'exclude'					=> true,
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'rgxp'=>'digits', 'maxlength'=>10, 'tl_class'=>'w50'),
		),
		'limitQuestions' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['limitQuestions'],
			'exclude'					=> true,
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'rgxp'=>'digits', 'maxlength'=>10, 'tl_class'=>'w50'),
		),
		'instantFeedback' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['instantFeedback'],
			'exclude'					=> true,
			'inputType'					=> 'checkbox',
			'eval'						=> array('tl_class'=>'clr w50'),
		),
		'navigation' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['navigation'],
			'exclude'					=> true,
			'inputType'					=> 'checkbox',
			'eval'						=> array('tl_class'=>'w50'),
		),
		'participantMode' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['participantMode'],
			'exclude'					=> true,
			'default'					=> 'anonymous',
			'inputType'					=> 'radio',
			'options'					=> array('anonymous', 'member', 'individual'),
			'reference'					=> &$GLOBALS['TL_LANG']['tl_exam'],
			'eval'						=> array('mandatory'=>true, 'submitOnChange'=>true, 'tl_class'=>'clr'),
		),
		'members' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['members'],
			'exclude'					=> true,
			'inputType'					=> 'select',
			'options_callback'			=> array('tl_exam', 'getMembers'),
			'eval'						=> array('mandatory'=>true, 'multiple'=>true, 'size'=>10, 'tl_class'=>'clr'),
		),
		'attempts' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['attempts'],
			'exclude'					=> true,
			'inputType'					=> 'text',
			'eval'						=> array('rgxp'=>'digits', 'maxlength'=>10, 'tl_class'=>'w50'),
		),
		'timeout' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['timeout'],
			'exclude'					=> true,
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'rgxp'=>'digits', 'maxlength'=>4, 'tl_class'=>'w50'),
		),
		'start' => array
		(
			'exclude'					=> true,
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['start'],
			'inputType'					=> 'text',
			'eval'						=> array('rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(), 'tl_class'=>'w50 wizard'),
		),
		'stop' => array
		(
			'exclude'					=> true,
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam']['stop'],
			'inputType'					=> 'text',
			'eval'						=> array('rgxp'=>'date', 'datepicker'=>$this->getDatePickerString(), 'tl_class'=>'w50 wizard'),
		),
	)
);


class tl_exam extends Backend
{

	/**
	 * Add an image to each record
	 * @param array
	 * @param string
	 * @return string
	 */
	public function addIcon($row, $label)
	{
		if (!strlen($row['participantMode']))
			return $label;
			
		return sprintf('<div class="list_icon" style="background-image:url(\'system/modules/exams/html/%s.png\');">%s</div>', $row['participantMode'], $label);
	}
	
	
	/**
	 * Hide the "pages" button if not in pages-mode
	 */
	public function pagesButton($row, $href, $label, $title, $icon, $attributes)
	{
		return $row['displayMode'] == 'pages' ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ' : ' ';
	}
	
	
	/**
	 * Disable the "participants" button if there are no results
	 */
	public function participantsButton($row, $href, $label, $title, $icon, $attributes)
	{
		$objResults = $this->Database->prepare("SELECT COUNT(*) AS total FROM tl_exam_participants WHERE pid=?")->execute($row['id']);
		
		return ($objResults->total > 0 ? '<a href="'.$this->addToUrl($href.'&amp;id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a>' : $this->generateImage(str_replace('.png', '_.png', $icon), $label)) . ' ';
	}
	
	
	public function getMembers()
	{
		$arrMembers = array();
		$objMembers = $this->Database->execute("SELECT * FROM tl_member WHERE disable='' ORDER BY lastname");
		
		while( $objMembers->next())
		{
			$arrMembers[$objMembers->id] = $objMembers->lastname . ' ' . $objMembers->firstname;
		}
		
		return $arrMembers;
	}
}

