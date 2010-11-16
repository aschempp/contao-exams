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
$GLOBALS['TL_LANG']['tl_exam_options']['label']					= array('Label', 'Enter a label for this option. Please do not use multiple lines for select menus!');
$GLOBALS['TL_LANG']['tl_exam_options']['points']				= array('Points', 'Points for this answer. Can be positive or negative!');
$GLOBALS['TL_LANG']['tl_exam_options']['correct']				= array('Correct', 'Check here if this is a correct answer.');
$GLOBALS['TL_LANG']['tl_exam_options']['feedback']				= array('Feedback for option', 'This will be shown after the users answers the question. Leave it blank to show the question\'s feedback.');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_exam_options']['new']					= array('New option', 'Create a new option for this question');
$GLOBALS['TL_LANG']['tl_exam_options']['edit']					= array('Edit option', 'Edit option ID %s');
$GLOBALS['TL_LANG']['tl_exam_options']['copy']					= array('Duplicate option', 'Duplicate option ID %s');
$GLOBALS['TL_LANG']['tl_exam_options']['cut']					= array('Move option', 'Move option ID %s');
$GLOBALS['TL_LANG']['tl_exam_options']['delete']				= array('Delete option', 'Delete option ID %s');
$GLOBALS['TL_LANG']['tl_exam_options']['toggle']				= array('Option ID %s show/not show');
$GLOBALS['TL_LANG']['tl_exam_options']['show']					= array('Option details', 'Show details of option ID %s');
$GLOBALS['TL_LANG']['tl_exam_options']['pasteafter']			= array('Paste after', 'Paste after option ID %s');
$GLOBALS['TL_LANG']['tl_exam_options']['pasteinto']				= array('Paste into', 'Paste into option ID %s');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_exam_options']['label_legend']			= 'Option label';
$GLOBALS['TL_LANG']['tl_exam_options']['rating_legend']			= 'Points or true/false';
$GLOBALS['TL_LANG']['tl_exam_options']['feedback_legend']		= 'Instant feedback';

