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
$GLOBALS['TL_LANG']['tl_exam']['name']					= array('Name', 'Enter a name for this exam.');
$GLOBALS['TL_LANG']['tl_exam']['title']					= array('Page title', 'Enter a title for the page.');
$GLOBALS['TL_LANG']['tl_exam']['jumpTo']				= array('Redirect page', 'Please choose the page to which visitors will be redirected after submitting the exam.');
$GLOBALS['TL_LANG']['tl_exam']['pointsToPass']			= array('Points required', 'How many points does users need to pass this exam?');
$GLOBALS['TL_LANG']['tl_exam']['pointsMax']				= array('Maximum points', 'The maximum number of points possible. This will allow to calculate a percentage result.');
$GLOBALS['TL_LANG']['tl_exam']['displayMode']			= array('Display mode', 'Select how you want to show questions for customers.');
$GLOBALS['TL_LANG']['tl_exam']['limitQuestions']		= array('Number of questions', 'Please enter the amount of questions you want to show (randomly). Enter 0 for all questions.');
$GLOBALS['TL_LANG']['tl_exam']['instantFeedback']		= array('Show instant feedback', 'Show feedback before jumping to next page.');
$GLOBALS['TL_LANG']['tl_exam']['navigation']			= array('Enable navigation', 'Allow to jump back and forward between questions (pagination and back button)');
$GLOBALS['TL_LANG']['tl_exam']['participantMode']		= array('Participant mode', 'Choose who can participate in this exam.');
$GLOBALS['TL_LANG']['tl_exam']['members']				= array('Members', 'Please select the members who are allowed to participate.');
$GLOBALS['TL_LANG']['tl_exam']['attempts']				= array('Max. attempts', 'Enter how many times a member can try this exam. Leave it blank for unlimited attempts.');
$GLOBALS['TL_LANG']['tl_exam']['timeout']				= array('Timeout', 'Enter the number of minutes allowed to complete the exam. Enter 0 for unlimited time.');
$GLOBALS['TL_LANG']['tl_exam']['start']					= array('Show from', 'Do not show the exam on the website before this day.');
$GLOBALS['TL_LANG']['tl_exam']['stop']					= array('Show until', 'Do not show the exam on the website after this day.');


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_exam']['single']				= 'One question per page';
$GLOBALS['TL_LANG']['tl_exam']['random']				= 'Questions in random order (one page)';
$GLOBALS['TL_LANG']['tl_exam']['page']					= 'One page with questions';
$GLOBALS['TL_LANG']['tl_exam']['anonymous']				= 'Everyone (anonymous)';
$GLOBALS['TL_LANG']['tl_exam']['member']				= 'All members';
$GLOBALS['TL_LANG']['tl_exam']['individual']			= 'Selected members';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_exam']['new']					= array('New exam', 'Create a new exam');
$GLOBALS['TL_LANG']['tl_exam']['edit']					= array('Edit exam', 'Edit exam ID %s');
$GLOBALS['TL_LANG']['tl_exam']['copy']					= array('Duplicate exam', 'Duplication exam ID %s');
$GLOBALS['TL_LANG']['tl_exam']['delete']				= array('Delete exam', 'Delete exam ID %s');
$GLOBALS['TL_LANG']['tl_exam']['show']					= array('Exam details', 'Show details of exam ID %s');
$GLOBALS['TL_LANG']['tl_exam']['questions']				= array('Questions', 'Questions for exam ID %s');
$GLOBALS['TL_LANG']['tl_exam']['pages']					= array('Pages and questions in desired order', 'Pages for exam ID %s');
$GLOBALS['TL_LANG']['tl_exam']['feedback']				= array('Feedback', 'Feedback for exam ID %s');
$GLOBALS['TL_LANG']['tl_exam']['participants']			= array('Participants', 'Participants for exam ID %s');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_exam']['name_legend']			= 'Name';
$GLOBALS['TL_LANG']['tl_exam']['config_legend']			= 'Configuration';
$GLOBALS['TL_LANG']['tl_exam']['participant_legend']	= 'Participants';
$GLOBALS['TL_LANG']['tl_exam']['publish_legend']		= 'Publishing';

