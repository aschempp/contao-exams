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
$GLOBALS['TL_LANG']['tl_exam_questions']['type']				= array('Fragetyp', 'Einen Fragetypen auswählen.');
$GLOBALS['TL_LANG']['tl_exam_questions']['mode']				= array('Punktemodus', 'Wählen Sie einen Punktemodus aus.');
$GLOBALS['TL_LANG']['tl_exam_questions']['points_correct']		= array('Punkte bei korrekter Antwort', 'Punkte bei korrekter Antwort.');
$GLOBALS['TL_LANG']['tl_exam_questions']['points_incorrect']	= array('Punkte bei falscher Antwort', 'Punkte bei falscher Antwort.');
$GLOBALS['TL_LANG']['tl_exam_questions']['question']			= array('Frage', 'Bitte wählen Sie eine Frage aus.');
$GLOBALS['TL_LANG']['tl_exam_questions']['description_intro']	= array('Einführungstext', 'Dieser Text wird vor der Frage angezeigt.');
$GLOBALS['TL_LANG']['tl_exam_questions']['description_extro']	= array('Bemerkung nach der Frage', 'Dieser Text wird nach der Frage angezeigt.');
$GLOBALS['TL_LANG']['tl_exam_questions']['feedback']			= array('Sofortiges Feedback', 'Sofortiges Feedback zu der Frage aktivieren.');
$GLOBALS['TL_LANG']['tl_exam_questions']['published']			= array('Frage veröffentlichen', 'Frage in der Prüfung anzeigen.');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_exam_questions']['new']					= array('Neue Frage', 'Add a new question to this survey');
$GLOBALS['TL_LANG']['tl_exam_questions']['edit']				= array('Frage bearbeiten', 'Frage ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_exam_questions']['copy']				= array('Frage kopieren', 'Frage ID %s kopieren');
$GLOBALS['TL_LANG']['tl_exam_questions']['cut']					= array('Frage verschieben', 'Frage ID %s verschieben');
$GLOBALS['TL_LANG']['tl_exam_questions']['delete']				= array('Frage löschen', 'Frage ID %s löschen');
$GLOBALS['TL_LANG']['tl_exam_questions']['show']				= array('Frage Details', 'Frage ID %s Details anzeigen');
$GLOBALS['TL_LANG']['tl_exam_questions']['options']				= array('Antworten', 'Der Frage Antworten hinzufügen.');


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_exam_questions']['opValue']				= 'Wert';
$GLOBALS['TL_LANG']['tl_exam_questions']['opPoints']			= 'Punkte';
$GLOBALS['TL_LANG']['tl_exam_questions']['opLabel']				= 'Antwort';
$GLOBALS['TL_LANG']['tl_exam_questions']['opDefault']			= 'Standard';
$GLOBALS['TL_LANG']['tl_exam_questions']['opGroup']				= 'Gruppe';
$GLOBALS['TL_LANG']['tl_exam_questions']['type']['radio']		= 'Single-Choice (Radio)';
$GLOBALS['TL_LANG']['tl_exam_questions']['type']['select']		= 'Single-Choice (Select)';
$GLOBALS['TL_LANG']['tl_exam_questions']['type']['checkbox']	= 'Multiple-Choice (Checkboxen)';
$GLOBALS['TL_LANG']['tl_exam_questions']['type']['text']		= 'Freier Text';
$GLOBALS['TL_LANG']['tl_exam_questions']['mode']['points']		= 'Punkte pro Antwortmöglichkeit zusammenrechnen (positive / negative)';
$GLOBALS['TL_LANG']['tl_exam_questions']['mode']['one']			= 'Eine Antwort muss korrekt sein';
$GLOBALS['TL_LANG']['tl_exam_questions']['mode']['all']			= 'Alle Antworten müssen korrekt sein';


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_exam_questions']['question_legend']		= 'Fragen';
$GLOBALS['TL_LANG']['tl_exam_questions']['options_legend']		= 'Multiple-Choice Optionen';
$GLOBALS['TL_LANG']['tl_exam_questions']['description_legend']	= 'Beschreibung';
$GLOBALS['TL_LANG']['tl_exam_questions']['publish_legend']		= 'Veröffentlicht';

