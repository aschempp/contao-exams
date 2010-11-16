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
$GLOBALS['TL_LANG']['tl_exam']['name']					= array('Name', 'Bitte geben Sie den Namen der Prüfung ein.');
$GLOBALS['TL_LANG']['tl_exam']['title']					= array('Seitentitel', 'Bitte geben Sie einen Seitentitel ein.');
$GLOBALS['TL_LANG']['tl_exam']['jumpTo']				= array('Weiterleitungsseite', 'Bitte geben Sie die Seite an, auf welche der Teilnehmer nach Abschluss der Prüfung weitergeleitet werden soll.');
$GLOBALS['TL_LANG']['tl_exam']['pointsToPass']			= array('Benötigte Punkteanzahl', 'Bitte geben Sie die Punkteanzahl an, welche benötigt wird, um die Prüfung zu bestehen.');
$GLOBALS['TL_LANG']['tl_exam']['displayMode']			= array('Anzeigemodus', 'Bitte wählen Sie aus, wie den Teilnehmern die Fragen angezeigt werden sollen.');
$GLOBALS['TL_LANG']['tl_exam']['limitQuestions']		= array('Anzahl an Fragen', 'Bitte geben Sie die Anzahl der Fragen (zufällig) ein.0 um alle Fragen anzuzeigen.');
$GLOBALS['TL_LANG']['tl_exam']['instantFeedback']		= array('Sofortiges Feedback anzeigen', 'Feedback vor dem Anzeigen der neuen Seite anzeigen.');
$GLOBALS['TL_LANG']['tl_exam']['navigation']			= array('Navigation erlauben', 'Erlauben Sie das Navigieren innerhalb der Prüfung (vor und zurück');
$GLOBALS['TL_LANG']['tl_exam']['participantMode']		= array('Teilnehmer Modus', 'Bitte wählen Sie aus, wer an der Prüfung teilnehmen darf.');
$GLOBALS['TL_LANG']['tl_exam']['members']				= array('Teilnehmer', 'Bitte wählen Sie die erlaubten Teilnehmer aus.');
$GLOBALS['TL_LANG']['tl_exam']['attempts']				= array('Max. Versuche', 'Bitte geben sie die maximalen Antrittsversuche ein. Leer lassen für unlimierte Versuche.');
$GLOBALS['TL_LANG']['tl_exam']['timeout']				= array('Erlaubte Prüfungszeit', 'Bitte geben Sie die erlaubte Prüfungszeit in Minuten an. 0 für unlimitierte Zeit.');
$GLOBALS['TL_LANG']['tl_exam']['start']					= array('Anzeigen ab', 'Nicht vor diesem Termin anzeigen');
$GLOBALS['TL_LANG']['tl_exam']['stop']					= array('Anzeigen bis', 'Nicht nach diesem Termin anzeigen.');


/**
 * References
 */
$GLOBALS['TL_LANG']['tl_exam']['single']				= 'Eine Frage pro Seite';
$GLOBALS['TL_LANG']['tl_exam']['random']				= 'Fragen in zufälliger Reihenfolge (eine Seite)';
$GLOBALS['TL_LANG']['tl_exam']['page']					= 'Eine Seite mit Fragen';
$GLOBALS['TL_LANG']['tl_exam']['anonymous']				= 'Offen für alle (Anonym)';
$GLOBALS['TL_LANG']['tl_exam']['member']				= 'Alle Mitglieder';
$GLOBALS['TL_LANG']['tl_exam']['individual']			= 'Ausgewählte Mitglieder';


/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_exam']['new']					= array('Neue Prüfung', 'Neue Prüfung erstellen');
$GLOBALS['TL_LANG']['tl_exam']['edit']					= array('Prüfung bearbeiten', 'Prüfung ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_exam']['copy']					= array('Prüfung kopieren', 'Prüfung ID %s kopieren');
$GLOBALS['TL_LANG']['tl_exam']['delete']				= array('Prüfung löschen', 'Prüfung ID %s löschen');
$GLOBALS['TL_LANG']['tl_exam']['show']					= array('Prüfungsdetails', 'Prüfungsdetails ID %s anzeigen');
$GLOBALS['TL_LANG']['tl_exam']['questions']				= array('Fragen', 'Fragen für ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_exam']['pages']					= array('Seiten und Fragen in vorgegebener Reihenfolge', 'Seiten für die Prüfung ID %s');
$GLOBALS['TL_LANG']['tl_exam']['feedback']				= array('Feedback', 'Feedback für die Prüfung ID %s');
$GLOBALS['TL_LANG']['tl_exam']['participants']			= array('Teilnehmer', 'Teilnehmer für die Prüfung ID %s');


/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_exam']['name_legend']			= 'Name';
$GLOBALS['TL_LANG']['tl_exam']['config_legend']			= 'Konfiguration';
$GLOBALS['TL_LANG']['tl_exam']['participant_legend']	= 'Teilnehmer';
$GLOBALS['TL_LANG']['tl_exam']['publish_legend']		= 'Veröffentlichen';

