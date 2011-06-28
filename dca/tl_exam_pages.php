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
 * Table tl_exam_pages
 */
$GLOBALS['TL_DCA']['tl_exam_pages'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'					=> 'Table',
		'label'							=> &$GLOBALS['TL_LANG']['MOD']['rooms'][0],
		'enableVersioning'				=> true,
		'ptable'						=> 'tl_exam',
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
			'headerFields'				=> array('name', 'displayMode', 'participantMode'),
			'child_record_callback'		=> array('tl_exam_pages', 'listRows')
		),
		'label' => array
		(
			'fields'					=> array('title'),
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
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_pages']['edit'],
				'href'					=> 'act=edit',
				'icon'					=> 'edit.gif'
			),
			'copy' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_pages']['copy'],
				'href'					=> 'act=copy',
				'icon'					=> 'copy.gif'
			),
			'cut' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_pages']['cut'],
				'href'					=> 'act=paste&amp;mode=cut',
				'icon'					=> 'cut.gif',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"'
			),
			'delete' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_pages']['delete'],
				'href'					=> 'act=delete',
				'icon'					=> 'delete.gif',
				'attributes'			=> 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_pages']['show'],
				'href'					=> 'act=show',
				'icon'					=> 'show.gif'
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'						=> '{title_legend},title;{questions_legend},questions;{publish_legend},published,start,stop',
	),

	// Fields
	'fields' => array
	(
		'title' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_pages']['title'],
			'exclude'					=> true,
			'inputType'					=> 'text',
			'eval'						=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'long'),
		),
		'questions' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_pages']['questions'],
			'exclude'					=> true,
			'inputType'					=> 'checkboxWizard',
			'options_callback'			=> array('tl_exam_pages', 'getQuestions'),
			'eval'						=> array('mandatory'=>true, 'multiple'=>true, 'tl_class'=>'clr'),
		),
		'published' => array
		(
			'exclude'					=> true,
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_pages']['published'],
			'inputType'					=> 'checkbox',
			'eval'						=> array('doNotCopy'=>true)
		),
		'start' => array
		(
			'exclude'					=> true,
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_pages']['start'],
			'inputType'					=> 'text',
			'eval'						=> array('rgxp'=>'date', 'datepicker'=>(version_compare(VERSION, '2.9', '>') ? true : $this->getDatePickerString()), 'tl_class'=>'w50 wizard')
		),
		'stop' => array
		(
			'exclude'					=> true,
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_pages']['stop'],
			'inputType'					=> 'text',
			'eval'						=> array('rgxp'=>'date', 'datepicker'=>(version_compare(VERSION, '2.9', '>') ? true : $this->getDatePickerString()), 'tl_class'=>'w50 wizard')
		),
	)
);


class tl_exam_pages extends Backend
{

	public function listRows($row)
	{
		return $row['title'];
	}
	
	
	public function getQuestions($dc)
	{
		$objPage = $this->Database->prepare("SELECT * FROM tl_exam_pages WHERE id=?")->limit(1)->execute($dc->id);
		
		if (!$objPage->numRows)
			return array();
			
		$arrQuestions = array();
		$objQuestions = $this->Database->prepare("SELECT * FROM tl_exam_questions WHERE pid=?")->execute($objPage->pid);
		
		while( $objQuestions->next() )
		{
			$arrQuestions[$objQuestions->id] = $objQuestions->question;
		}
		
		return $arrQuestions;
	}
}

