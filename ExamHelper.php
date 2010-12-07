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


class ExamHelper extends Frontend
{

	public function replaceTags($strTag)
	{
		$arrTag = trimsplit('::', $strTag);
		
		if ($arrTag[0] == 'exam')
		{
			if ($this->Input->get('uniqid') != '')
			{
				$objResult = $this->Database->prepare("SELECT *, (SELECT pid FROM tl_exam_participants p WHERE p.id=r.pid) AS exam FROM tl_exam_results r WHERE r.uniqid=?")->limit(1)->execute($this->Input->get('uniqid'));
				
				$objExam = $this->Database->execute("SELECT * FROM tl_exam WHERE id={$objResult->exam}");
				
				$objFeedback = $this->Database->prepare("SELECT * FROM tl_exam_feedback WHERE pid=? AND points<=? AND published='1' ORDER BY points DESC")->limit(1)->execute($objResult->exam, $objResult->points);
				
				$_SESSION['EXAMS']['LAST_RESULTS'] = array
				(
					'points'		=> $objResult->points,
					'percentage'	=> $objResult->percentage,
					'feedback'		=> $objFeedback->feedback,
					'passed'		=> ($objResult->points >= $objExam->pointsToPass ? $GLOBALS['TL_LANG']['MSC']['yes'] : $GLOBALS['TL_LANG']['MSC']['no']),
				);
			}
			
			return $_SESSION['EXAMS']['LAST_RESULTS'][$arrTag[1]];
		}
		
		return false;
	}
}

