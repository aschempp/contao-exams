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
 * Backend modules
 */
$GLOBALS['BE_MOD']['content']['exams'] = array
(
	'tables'				=> array('tl_exam', 'tl_exam_questions', 'tl_exam_options', 'tl_exam_pages', 'tl_exam_feedback', 'tl_exam_participants'),
	'icon'					=> 'system/modules/exams/html/icon.png',
	'stylesheet'			=> 'system/modules/exams/html/backend.css',
	'exportParticipants'	=> array('tl_exam_participants', 'exportParticipants'),
	'exportResults'			=> array('tl_exam_participants', 'exportResults'),
);


/**
 * Frontend modules
 */
$GLOBALS['FE_MOD']['application']['exam'] = 'Exam';


/**
 * Content elements
 */
$GLOBALS['TL_CTE']['includes']['exam'] = 'Exam';


/**
 * InsertTags
 */
$GLOBALS['TL_HOOKS']['replaceInsertTags'][]	= array('ExamHelper', 'replaceTags');

