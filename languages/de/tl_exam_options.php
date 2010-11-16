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
$GLOBALS['TL_LANG']['tl_exam_options']['label']					= array('Bezeichnung', 'Bezeichnung für diese Antwort eingeben. Bitte bei einer Select-Auswahl keine mehrzeiligen Bezeichnungen!');
$GLOBALS['TL_LANG']['tl_exam_options']['points']				= array('Punkte', 'Punkte für diese Antwort. Kann positiv oder negativ sein!');
$GLOBALS['TL_LANG']['tl_exam_options']['correct']				= array('Richtige Antwort', 'Bitte anklicken, wenn es sich um eine richtige Antwort handelt.');
$GLOBALS['TL_LANG']['tl_exam_options']['feedback']				= array('Feedback für die Antwort', 'Feedback wird dem User angezeigt, nachdem er die Frage beantwortet hat. Leer lassen, um das Feedback der Frage anzuzeigen.');


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_exam_options']['new']					= array('Neue Antwort', 'Eine neue Antwort erstellen');
$GLOBALS['TL_LANG']['tl_exam_options']['edit']					= array('Antwort bearbeiten', 'Antwort ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_exam_options']['copy']					= array('Antwort kopieren', 'Antwort ID %s kopieren');
$GLOBALS['TL_LANG']['tl_exam_options']['cut']					= array('Antwort verschieben', 'Antwort ID %s verschieben');
$GLOBALS['TL_LANG']['tl_exam_options']['delete']				= array('Antwort löschen', 'Antwort ID %s löschen');
$GLOBALS['TL_LANG']['tl_exam_options']['show']					= array('Antwortdetails', 'Antwort Details von ID %s');
$GLOBALS['TL_LANG']['tl_exam_options']['pasteafter']			= array('Danach einfügen', 'Antwort nach ID %s einfügen');
$GLOBALS['TL_LANG']['tl_exam_options']['pasteinto']				= array('Einfügen', 'Antwort in ID %s einfügen');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_exam_options']['label_legend']			= 'Antwort Bezeichnung';
$GLOBALS['TL_LANG']['tl_exam_options']['rating_legend']			= 'Punkte bzw. falsch/richtig';
$GLOBALS['TL_LANG']['tl_exam_options']['feedback_legend']		= 'Sofortiges Feedback';

