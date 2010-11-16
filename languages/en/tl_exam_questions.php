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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_exam_questions']['type']				= array('Question type', 'Select a question type.');
$GLOBALS['TL_LANG']['tl_exam_questions']['mode']				= array('Score mode', 'Select a score mode.');
$GLOBALS['TL_LANG']['tl_exam_questions']['points_correct']		= array('Points when correct', 'Enter the points for a correct answer.');
$GLOBALS['TL_LANG']['tl_exam_questions']['points_incorrect']	= array('Points when incorrect', 'Enter the points for incorrect answer.');
$GLOBALS['TL_LANG']['tl_exam_questions']['question']			= array('Question', 'Please enter a question.');
$GLOBALS['TL_LANG']['tl_exam_questions']['description_intro']	= array('Introduction', 'This will be shown before the question.');
$GLOBALS['TL_LANG']['tl_exam_questions']['description_extro']	= array('Extroduction', 'This will be shown after the question.');
$GLOBALS['TL_LANG']['tl_exam_questions']['feedback']			= array('Instant feedback', 'Can be shown as feedback for the answer.');
$GLOBALS['TL_LANG']['tl_exam_questions']['published']			= array('Publish question', 'Show this question for the survey');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_exam_questions']['new']					= array('New question', 'Add a new question to this survey');
$GLOBALS['TL_LANG']['tl_exam_questions']['edit']				= array('Edit question', 'Edit question ID %s');
$GLOBALS['TL_LANG']['tl_exam_questions']['copy']				= array('Duplicate question', 'Duplicate question ID %s');
$GLOBALS['TL_LANG']['tl_exam_questions']['cut']					= array('Move question', 'Nachricht ID %s');
$GLOBALS['TL_LANG']['tl_exam_questions']['delete']				= array('Delete question', 'Nachricht ID %s');
$GLOBALS['TL_LANG']['tl_exam_questions']['show']				= array('Question details', 'Show details of question ID %s');
$GLOBALS['TL_LANG']['tl_exam_questions']['options']				= array('Options', 'Add options to this question.');


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_exam_questions']['opValue']				= 'Value';
$GLOBALS['TL_LANG']['tl_exam_questions']['opPoints']			= 'Points';
$GLOBALS['TL_LANG']['tl_exam_questions']['opLabel']				= 'Option';
$GLOBALS['TL_LANG']['tl_exam_questions']['opDefault']			= 'Default';
$GLOBALS['TL_LANG']['tl_exam_questions']['opGroup']				= 'Group';
$GLOBALS['TL_LANG']['tl_exam_questions']['type']['radio']		= 'Single-Choice (Radio)';
$GLOBALS['TL_LANG']['tl_exam_questions']['type']['select']		= 'Single-Choice (Select)';
$GLOBALS['TL_LANG']['tl_exam_questions']['type']['checkbox']	= 'Multiple-Choice (Checkboxes)';
$GLOBALS['TL_LANG']['tl_exam_questions']['type']['text']		= 'Free text';
$GLOBALS['TL_LANG']['tl_exam_questions']['mode']['points']		= 'Calculate points per option (positive / nevative)';
$GLOBALS['TL_LANG']['tl_exam_questions']['mode']['one']			= 'One answer must be correct';
$GLOBALS['TL_LANG']['tl_exam_questions']['mode']['all']			= 'All answers must be correct';


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_exam_questions']['question_legend']		= 'Question';
$GLOBALS['TL_LANG']['tl_exam_questions']['options_legend']		= 'Multiple-Choice Options';
$GLOBALS['TL_LANG']['tl_exam_questions']['description_legend']	= 'Descriptions';
$GLOBALS['TL_LANG']['tl_exam_questions']['publish_legend']		= 'Publishing';

