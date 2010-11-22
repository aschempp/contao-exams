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
 * Table tl_exam_participants
 */
$GLOBALS['TL_DCA']['tl_exam_participants'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'					=> 'Table',
		'ptable'						=> 'tl_exam',
		'ctables'						=> array('tl_exam_results'),
		'closed'						=> true,
		'onload_callback'				=> array
		(
			array('tl_exam_participants', 'checkAnonymous'),
		),
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'						=> 4,
			'fields'					=> array('tstamp'),
			'flag'						=> 1,
			'panelLayout'				=> 'filter;search,limit',
			'headerFields'				=> array('name', 'displayMode', 'participantMode'),
			'child_record_callback'		=> array('tl_exam_participants', 'listRows'),
			'disableGrouping'			=> true,
		),
		'global_operations' => array
		(
			'exportall' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_participants']['exportall'],
				'href'					=> 'key=exportall',
				'class'					=> 'header_export_all',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"',
			),
			'all' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'					=> 'act=select',
				'class'					=> 'header_edit_all',
				'attributes'			=> 'onclick="Backend.getScrollOffset();"',
			),
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_participants']['edit'],
				'href'					=> 'act=edit',
				'icon'					=> 'edit.gif'
			),
			'delete' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_participants']['delete'],
				'href'					=> 'act=delete',
				'icon'					=> 'delete.gif',
				'attributes'			=> 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"',
			),
			'show' => array
			(
				'label'					=> &$GLOBALS['TL_LANG']['tl_exam_participants']['show'],
				'href'					=> 'act=show',
				'icon'					=> 'show.gif',
			),
		)
	),

	// Palettes
	'palettes' => array
	(
		'default'						=> '{participant_legend},member,attempts',
	),

	// Fields
	'fields' => array
	(
		'member' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_participants']['member'],
//			'inputType'					=> 'select',
			'foreignKey'				=> 'tl_member.lastname',
			'input_field_callback'		=> array('tl_exam_participants', 'memberField'),
		),
		'attempts' => array
		(
			'label'						=> &$GLOBALS['TL_LANG']['tl_exam_participants']['attempts'],
			'inputType'					=> 'text',
			'eval'						=> array('rgxp'=>'digits', 'maxlength'=>10),
		)
	)
);


class tl_exam_participants extends Backend
{

	public function listRows($row)
	{
		$strName = $GLOBALS['TL_LANG']['MSC']['anonymous'];
		
		if ($row['member'] > 0)
		{
			$objMember = $this->Database->prepare("SELECT * FROM tl_member WHERE id=?")->limit(1)->execute($row['member']);
			
			if ($objMember->numRows)
			{
				$strName = $objMember->lastname . ', ' . $objMember->firstname . ' [' . $objMember->username . ']';
			}
		}
		
		$blnPassed = false;
		$arrAttempts = array();
		$objResults = $this->Database->prepare("SELECT * FROM tl_exam_results WHERE pid=? ORDER BY tstamp")->execute($row['id']);
		
		while( $objResults->next() )
		{
			if ($objResults->passed)
				$blnPassed = true;
				
			$arrAttempts[] = sprintf($GLOBALS['TL_LANG']['MSC']['exam_attempt'], $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $objResults->start), $objResults->points, ($objResults->stop > 0 ? sprintf($GLOBALS['TL_LANG']['MSC']['exam_completed'], ceil(($objResults->stop - $objResults->start) / 60)) : $GLOBALS['TL_LANG']['MSC']['exam_incomplete']));
		}
		
		if (!$row['member'])
		{
			$strName .= ' from IP ' . $objResults->ipaddress;
		}
		
		return '
<div class="cte_type ' . ($blnPassed ? '' : 'un') . 'published" style="background-image:url(system/modules/exams/html/exam_' . ($blnPassed ? 'passed' : 'failed') . '.png)"><strong>' . $strName . '</strong></div>
<div class="block" style="margin-top: -10px">
<ol style="margin: 0; padding: 0 25px">
<li>' . implode("</li>\n<li>", $arrAttempts) . '</li>
</ol>
</div>' . "\n";
	}
	
	
	public function memberField($dc, $xlabel)
	{
		$strName = $GLOBALS['TL_LANG']['MSC']['anonymous'];
		
		if ($dc->activeRecord->member > 0)
		{
			$objMember = $this->Database->execute("SELECT * FROM tl_member WHERE id={$dc->activeRecord->member}");
			
			if ($objMember->numRows)
			{
				$strName = $objMember->lastname . ', ' . $objMember->firstname;
			}
		}
		
		return '
<div class="clr">
  <h3><label for="ctrl_member">' . $GLOBALS['TL_LANG']['tl_exam_participants']['member'][0] . '</label></h3>
  ' . $strName . '
</div>';
	}
	
	
	public function checkAnonymous($dc)
	{
		if (!strlen($this->Input->get('act')))
		{
			$objExam = $this->Database->execute("SELECT * FROM tl_exam WHERE id={$dc->id}");
		}
		else
		{
			$objExam = $this->Database->execute("SELECT e.* FROM tl_exam_participants p LEFT OUTER JOIN tl_exam e ON p.pid=e.id WHERE p.id={$dc->id}");
		}
		
		if ($objExam->participantMode == 'anonymous')
		{
			$GLOBALS['TL_DCA']['tl_exam_participants']['config']['notEditable'] = true;
			unset($GLOBALS['TL_DCA']['tl_exam_participants']['list']['operations']['edit']);
		}
	}
	
	
	/**
	 * Export all results of an exam
	 */
	public function exportAll($dc)
	{
		$objResults = $this->Database->execute("SELECT p.*, r.*, m.firstname, m.lastname FROM tl_exam_participants p LEFT JOIN tl_exam_results r ON p.id=r.pid LEFT OUTER JOIN tl_member m ON p.member=m.id WHERE p.pid={$dc->id}");
		
		if (!$objResults->numRows)
			return '<p class="tl_gerror">No data available.</p>';
			
			
		$arrRows = array(array
		(
			'member',
			'firstname',
			'lastname',
			'ipaddress',
			'start',
			'stop',
			'points',
			'passed',
		));
		
		while( $objResults->next() )
		{
			$row = array
			(
				'member'		=> $objResults->member,
				'firstname'		=> $objResults->firstname,
				'lastname'		=> $objResults->lastname,
				'ipaddress'		=> $objResults->ipaddress,
				'start'			=> $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $objResults->start),
				'stop'			=> (strlen($objResults->stop) ? $this->parseDate($GLOBALS['TL_CONFIG']['datimFormat'], $objResults->stop) : ''),
				'points'		=> $objResults->points,
				'percentage'	=> ($objResults->percentage . '%'),
				'passed'		=> ($objResults->passed ? '1' : '0'),
			);
			
			$arrRows[] = $row;
		}
		
		// CSV ausgeben
		$strCSV = '';
		header('Content-Type: text/plain, charset=UTF-8; encoding=UTF-8');
		header("Content-Disposition: attachment; filename=exam_" . $dc->id . ".csv");
		foreach( $arrRows as $arrRow )
		{
			$strCSV .= '"' . implode('"' . "\t" . '"', $arrRow) . '"' . "\n";
		}
		
		echo chr(255).chr(254).mb_convert_encoding($strCSV, 'UTF-16LE', 'UTF-8');
		
		exit;
	}
}

