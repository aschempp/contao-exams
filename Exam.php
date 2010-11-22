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
 * @author     Andreas Schempp <andreas@schempp.ch
 * @license    http://opensource.org/licenses/lgpl-3.0.html
 * @version    $Id$
 */


class Exam extends Hybrid
{

	/**
	 * Key
	 * @var string
	 */
	protected $strKey = 'exam';
	
	
	/**
	 * Table
	 * @var string
	 */
	protected $strTable = 'tl_exam';
	
	
	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'exam_default';
	
	
	/**
	 * Count total questions to generate "first", "last", "even" and "odd" css classes
	 */
	protected $intQuestion = 0;
	
	protected $intParticipant = 0;
	
	protected $blnSubmit = true;
	
	protected $blnHasFeedback = false;
	
	protected $arrResult = array();
	

	/**
	 * Current record
	 * @var array
	 */
	protected $arrData = array();
	
	
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### EXAM ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'typolight/main.php?do=exams&amp;table=tl_exam_questions&amp;id=' . $this->id;

			return $objTemplate->parse();
		}
		
		if (!$this->authenticateParticipant())
		{
			$objTemplate = new FrontendTemplate('mod_message');
			$objTemplate->type = 'error';
			$objTemplate->message = array_shift($GLOBALS['TL_ERROR']);
			return $objTemplate->parse();
		}
			
		// Generate exam and store in session
		if (!is_array($_SESSION['EXAMS'][$this->id]) && !$this->generatePages())
		{
			$objTemplate = new FrontendTemplate('mod_message');
			$objTemplate->type = 'error';
			$objTemplate->message = array_shift($GLOBALS['TL_ERROR']);
			return $objTemplate->parse();
		}
		
		// Pagination
		if (strlen($this->Input->get('page')))
		{
			$page = ($this->Input->get('page') - 1);
			
			if ($this->navigation)
			{
				$_SESSION['EXAMS'][$this->id]['CURRENT'] = $page;
			}
			
			$this->redirect(preg_replace('@[?&]page='.$this->Input->get('page').'@', '', $this->Environment->request));
		}
		
		return parent::generate();
	}
	
	
	protected function compile()
	{
		// Initialize template
		$this->Template->formId = 'tl_exam_' . $this->id;
		$this->Template->formSubmit = 'tl_exam_' . $this->id;
		$this->Template->action = $this->Environment->request;
		$this->Template->slabel = specialchars($GLOBALS['TL_LANG']['MSC']['examNext']);
		$this->Template->sattributes = '';
		
		// Show pagination
		if ($this->navigation)
		{
			$this->Input->setGet('page', ($_SESSION['EXAMS'][$this->id]['CURRENT']+1));
			
			$total = count($_SESSION['EXAMS'][$this->id]['pages']) + 1;
			$objPagination = new Pagination($total, 1, $total);
			
			$this->Template->pagination = $objPagination->generate();
		}
		
		
		// Get result data
		$this->arrResult = $this->Database->prepare("SELECT * FROM tl_exam_results WHERE id=?")->limit(1)->execute($_SESSION['EXAMS'][$this->id]['RESULT_ID'])->fetchAssoc();
		$this->arrResult['data'] = deserialize($this->arrResult['data'], true);
		
		$arrPage = $_SESSION['EXAMS'][$this->id]['pages'][$_SESSION['EXAMS'][$this->id]['CURRENT']];
		
		
		// Check & Implement timeout feature
		$this->Template->countdown = '';
		if ($this->timeout > 0)
		{
			$start = $this->arrResult['start'] ? $this->arrResult['start'] : time();
			$timeout = ($this->timeout * 60) - (time() - $start);
			
			// Close exam if time is up
			if ($timeout < 0)
			{
				// Store results if submitted withing 10secs after timeout.
				// This is a non-javascript fallback so user cannot submit later. With JS, the timer will auto-submit
				if ($timeout < -10)
				{
					$this->storeResult();
				}
				
				$this->closeExam(true);
			}
			
			$minutes = floor($timeout / 60);
			$seconds = $timeout - ($minutes * 60);
		
			if (strlen($minutes) < 2)
				$minutes = '0' . $minutes;
			
			if (strlen($seconds) < 2)
				$seconds = '0' . $seconds;
			
			// Include Javascript
			$GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/exams/html/CountDown.js';
			$this->Template->countdown = '
<div class="timeout">' . sprintf($GLOBALS['TL_LANG']['MSC']['exam_countdown'], '<span id="countdown">' . sprintf('%s:%s', $minutes, $seconds) . '</span>') . '</div>
<script type="text/javascript">
<!--//--><![CDATA[//><!--
window.addEvent(\'domready\', function() {
  new CountDown($("countdown"), {
    limit:' . $timeout . '
  }).addEvent(\'complete\', function() { $(\'tl_exam_' . $this->id . '\').submit() }).start();
});
//--><!]]>
</script>';
		}
		
		
		// Confirmation page
		if (!is_array($arrPage))
		{
			$this->confirmExam();
			return;
		}
		
		
		$arrQuestions = array();
		
		foreach( $arrPage['questions'] as $question )
		{
			$arrQuestions[$question] = $this->generateQuestion($question);
		}
		
		
		if ($this->Input->post('FORM_SUBMIT') == 'tl_exam_' . $this->id && $this->blnSubmit)
		{
			$this->storeResult();
			
			// Show feedback
			if ($this->instantFeedback && !$_SESSION['EXAMS'][$this->id]['feedback'] && $this->blnHasFeedback)
			{
				$_SESSION['EXAMS'][$this->id]['feedback'] = true;
				$this->reload();
			}
			
			// Continue to next page
			else
			{
				$_SESSION['EXAMS'][$this->id]['feedback'] = false;
				
				$intNext = $_SESSION['EXAMS'][$this->id]['CURRENT'] + 1;
				
				if (!$this->navigation && !is_array($_SESSION['EXAMS'][$this->id]['pages'][$intNext]))
				{
					$this->closeExam();
				}
				else
				{
					$_SESSION['EXAMS'][$this->id]['CURRENT'] = $intNext;
					$this->reload();
				}
			}
		}
		else
		{
			$_SESSION['EXAMS'][$this->id]['feedback'] = false;
		}
		
		$this->Template->title = $arrPage['title'];
		$this->Template->questions = implode("\n", $arrQuestions);
	}
	
	
	/**
	 * Authenticate participant
	 */
	protected function authenticateParticipant()
	{
		switch( $this->participantMode )
		{
			case 'anonymous':
				if (FE_USER_LOGGED_IN)
				{
					$this->import('FrontendUser', 'User');
				}
				else
				{
					$this->import('AnonymousUser', 'User');
				}
				break;
			
			case 'member':
			case 'individual':
				if (!FE_USER_LOGGED_IN)
				{
					$GLOBALS['TL_ERROR'][] = $GLOBALS['TL_LANG']['ERR']['examLoginRequired'];
					return false;
				}
					
				$this->import('FrontendUser', 'User');
				
				if ($this->participantMode == 'individual')
				{
					$this->members = deserialize($this->members, true);
					
					if (!in_array($this->User->id, $this->members))
					{
						$GLOBALS['TL_ERROR'][] = $GLOBALS['TL_LANG']['ERR']['examNotAllowed'];
						return false;
					}
				}
				break;
				
			default:
				$GLOBALS['TL_ERROR'][] = $GLOBALS['TL_LANG']['ERR']['examAuthError'];
				return false;
		}
		
		if (!$_SESSION['EXAMS'][$this->id]['PARTICIPANT_ID'])
		{
			if ($this->User->id > 0)
			{
				$objParticipant = $this->Database->prepare("SELECT *, (SELECT COUNT(*) FROM tl_exam_results r WHERE r.pid=p.id) AS previous_attempts FROM tl_exam_participants p WHERE p.member=? AND p.pid=?")->limit(1)->execute($this->User->id, $this->id);
				
				if ($objParticipant->numRows)
				{
					if ($objParticipant->attempts != '' && $objParticipant->attempts <= $objParticipant->previous_attempts)
					{
						$GLOBALS['TL_ERROR'][] = $GLOBALS['TL_LANG']['ERR']['examAttemptsReached'];
						return false;
					}
					
					$this->intParticipant = $objParticipant->id;
					$this->Database->prepare("UPDATE tl_exam_participants SET tstamp=? WHERE id=?")->execute(time(), $this->intParticipant);
				}
			}
			
			if (!$this->intParticipant)
			{
				$this->intParticipant = $this->Database->prepare("INSERT INTO tl_exam_participants %s")->set(array('pid'=>$this->id, 'tstamp'=>time(), 'member'=>$this->User->id, 'attempts'=>$this->attempts))->execute()->insertId;
			}
		}
		
		return true;
	}
	
	
	/**
	 * Create the initial array of pages to work with. Can be one or multiple.
	 */
	protected function generatePages()
	{
		// Initial settings
		$_SESSION['EXAMS'][$this->id] = array
		(
			'CURRENT'			=> 0,
			'total'				=> 0,			// Total number of questions
			'pages'				=> array(),
			'PARTICIPANT_ID'	=> $this->intParticipant,
		);
		
		switch( $this->displayMode )
		{
			// One question per page
			case 'single':
				$objQuestions = $this->Database->prepare("SELECT id FROM tl_exam_questions WHERE published='1' AND pid=? ORDER BY sorting")->execute($this->id);
				$_SESSION['EXAMS'][$this->id]['total'] = $objQuestions->numRows;
				
				while( $objQuestions->next() )
				{
					$_SESSION['EXAMS'][$this->id]['pages'][] = array
					(
						'title'		=> $this->title,
						'questions'	=> array($objQuestions->id),
					);
				}
				break;
				
			// Questions in random order (one page) [can be limited to only a number of questions]
			case 'random':
			
			// One page with questions
			case 'page':
				$count = 0;
				$arrQuestions = array();
				$objQuestions = $this->Database->prepare("SELECT id FROM tl_exam_questions WHERE published='1' AND pid=? ORDER BY " . ($this->displayMode == 'random' ? 'RAND()' : 'sorting'))->execute($this->id);
				
				while( $objQuestions->next() )
				{
					if ($this->displayMode == 'random' && $this->limitQuestions > 0 && $count > $this->limitQuestions)
						break;
						
					$arrQuestions[] = $objQuestions->id;
					
					$count++;
				}
				
				if (count($arrQuestions))
				{
					$_SESSION['EXAMS'][$this->id]['total'] = count($arrQuestions);
					
					$_SESSION['EXAMS'][$this->id]['pages'][0] = array
					(
						'title'		=> $this->title,
						'questions'	=> $arrQuestions,
					);
				}
				break;
				
			// Pages and questions in desired order
			case 'pages':
				$time = time();
				$objPages = $this->Database->prepare("SELECT * FROM tl_exam_pages WHERE published='1' AND (start='' OR start<?) AND (stop='' OR stop>?) AND pid=?")->execute($time, $time, $this->id);
				
				while( $objPages->next() )
				{
					// We do not check here if questions are published. This will be done again when generating the question.
					$arrQuestions = deserialize($objPages->questions);
					
					if (is_array($arrQuestions) && count($arrQuestions))
					{
						$_SESSION['EXAMS'][$this->id]['pages'][] = array_merge($objPages->row(), array
						(
							'questions'	=> $arrQuestions,
						));
						
						$_SESSION['EXAMS'][$this->id]['total'] += count($arrQuestions);
					}
				}
				break;
				
			default:
				return false;
		}
		
		if (!count($_SESSION['EXAMS'][$this->id]['pages']))
			return false;
			
		// Generate result set
		$_SESSION['EXAMS'][$this->id]['RESULT_ID'] = $this->Database->prepare("INSERT INTO tl_exam_results %s")
																	->set(array('pid'=>$this->intParticipant, 'tstamp'=>time(), 'ipaddress'=>$this->Environment->ip, 'data'=>serialize(array()), 'start'=>time()))
																	->execute()
																	->insertId;
		
		return true;
	}
	
	
	/**
	 * Generate a question template
	 */
	protected function generateQuestion($intId)
	{
		// Load from database
		$objQuestion = $this->Database->prepare("SELECT * FROM tl_exam_questions WHERE id=? AND pid=?")->limit(1)->execute($intId, $this->id);
		
		$objTemplate = new FrontendTemplate('question_default');
		
		$objTemplate->setData($objQuestion->row());
		
		$objTemplate->class = 'question ' . ($this->intQuestion%2 ? 'even' : 'odd') . ($this->intQuestion == 0 ? ' first' : '');
		
		$arrData = array
		(
			'id'			=> $objQuestion->id,
			'name'			=> $objQuestion->id,
			'value'			=> $this->arrResult['data'][$objQuestion->id]['answer'],
			'tableless'		=> true,
		);
		
		if ($_SESSION['EXAMS'][$this->id]['feedback'])
		{
			$arrData['disabled'] = 'disabled';
		}
		
		
		if ($objQuestion->type != 'text')
		{
			$arrOptions = array();
			$objOptions = $this->Database->prepare("SELECT * FROM tl_exam_options WHERE pid=?")->execute($objQuestion->id);
			
			while( $objOptions->next() )
			{
				$arrOptions[$objOptions->id] = array
				(
					'label'		=> $objOptions->label,
					'value'		=> $objOptions->id,
					'points'	=> $objOptions->points,
					'correct'	=> ($objOptions->correct ? true : false),
					'feedback'	=> (strlen($objOptions->feedback) ? $objOptions->feedback : $objQuestion->feedback),
				);
			}
			
			$arrData['options'] = $arrOptions;
		}
		
		if ($this->instantFeedback)
		{
			if (strlen($arrData['value']))
			{
				$arrData['disabled'] = 'disabled';
			
				if ($objQuestion->type != 'text')
				{
					if (is_array($arrData['value']))
					{
						$strFeedback = '';
						foreach( $arrData['value'] as $value )
						{
							$strFeedback .= '<p>' . $arrOptions[$value]['feedback'] . '</p>';
						}
						
						$objTemplate->feedback = $strFeedback;
					}
					else
					{
						$objTemplate->feedback = $arrOptions[$arrData['value']]['feedback'];
					}
				}
				
				if (strlen($objTemplate->feedback))
				{
					$objTemplate->showFeedback = true;
				}

			}
		}
		
			
		switch( $objQuestion->type )
		{
			case 'radio':
				$objWidget = new FormRadioButton($arrData);
				break;
				
			case 'select':
				$objWidget = new FormSelectMenu($arrData);
				break;
				
			case 'checkbox':
				$objWidget = new FormCheckBox($arrData);
				break;
			
			case 'text':
				$objWidget = new FormTextArea($arrData);
				break;
				
			// Unknown question type!
			default:
				$this->log('Unknown question type "' . $objQuestion->type . '"', 'Exam generateQuestion()', TL_ERROR);
				return '';
		}
		
		if ($this->Input->post('FORM_SUBMIT') == 'tl_exam_' . $this->id && $objWidget->submitInput())
		{
			$objWidget->validate();
			
			if ($objWidget->hasErrors() || (!$this->navigation && !strlen($objWidget->value)))
			{
				$this->blnSubmit = false;
				
				$this->Template->message = $GLOBALS['TL_LANG']['ERR']['question_mandatory'];
				$this->Template->mclass = 'error';
			}
			elseif ($objWidget->submitInput())
			{
				$intPoints = 0;
				
				// Handle correct/incorrect for each option
				if ($objQuestion->type == 'checkbox' && $objQuestion->mode != 'points')
				{
					$blnOne = false;
					$blnAll = true;
					
					foreach( $arrOptions as $option )
					{
						if (is_array($objWidget->value) && in_array($option['value'], $objWidget->value))
						{
							if ($option['correct'])
								$blnOne = true;
							else
								$blnAll = false;
						}
						else
						{
							if ($option['correct'])
								$blnAll = false;
						}
					}
					
					if (($objQuestion->mode == 'all' && $blnAll) || $objQuestion->mode == 'one' && $blnOne)
					{
						$intPoints = $objQuestion->points_correct;
					}
					else
					{
						$intPoints = $objQuestion->points_incorrect;
					}
				}
				
				// Count points of all checked options
				elseif ($objQuestion->type == 'checkbox')
				{
					if (is_array($objWidget->value) && count($objWidget->value))
					{
						foreach( $objWidget->value as $option )
						{
							$intPoints += $arrOptions[$option]['points'];
						}
					}
				}
				
				// Simply use the points of the given option
				elseif ($objQuestion->type != 'text')
				{
					$intPoints = $arrOptions[$objWidget->value]['points'];
				}
				
				$this->arrResult['data'][$objQuestion->id] = array
				(
					'answer'	=> $objWidget->value,
					'points'	=> $intPoints,
				);
			}
		}
		
		
		if ($this->instantFeedback && strlen($objWidget->value) && $objWidget->value != $arrData['value'])
		{
			$this->blnHasFeedback = true;
		}
		
		$objTemplate->field = $objWidget->parse();
		
		$this->intQuestion++;
		
		return $objTemplate->parse();
	}
	
	
	protected function storeResult()
	{
		$this->arrResult['points'] = 0;
		
		foreach( $this->arrResult['data'] as $result )
		{
			$this->arrResult['points'] += $result['points'];
		}
		
		$this->arrResult['percentage'] = round((100 / $this->pointsMax) * $this->arrResult['points']);
		
		$arrSet = array
		(
			'pid'			=> $this->arrResult['pid'],
			'tstamp'		=> time(),
			'points'		=> $this->arrResult['points'],
			'percentage'	=> $this->arrResult['percentage'],
			'data'			=> serialize($this->arrResult['data']),
		);
		
		$this->Database->prepare("UPDATE tl_exam_results %s WHERE id=?")->set($arrSet)->execute($this->arrResult['id']);
	}
	
	
	protected function confirmExam()
	{
		if ($this->Input->post('FORM_SUBMIT') == 'tl_exam_' . $this->id && strlen($this->Input->post('close')))
		{
			$this->closeExam();
			return;
		}
		
		$this->Template->slabel = 'Close exam';
		
		$strQuestions = '<input type="hidden" name="close" value="1" />'."\n";
		
		if (count($this->arrResult['data']) == $_SESSION['EXAMS'][$this->id]['total'])
		{
			$strQuestions .= '<p class="close_exam confirm">' . $GLOBALS['TL_LANG']['MSC']['exam_close_complete'] . '</p>';
		}
		else
		{
			$strQuestions .= '<p class="close_exam error">' . $GLOBALS['TL_LANG']['MSC']['exam_close_incomplete'] . '</p>';
		}
		
		$this->Template->questions = $strQuestions;
	}
	
	
	protected function closeExam($blnTimeout=false)
	{
		$this->Database->prepare("UPDATE tl_exam_results SET passed=?, stop=? WHERE id=?")->execute(($this->arrResult['points'] >= $this->pointsToPass ? '1' : ''), ($blnTimeout ? 0 : time()), $this->arrResult['id']);
		
		$objFeedback = $this->Database->prepare("SELECT * FROM tl_exam_feedback WHERE pid=? AND points<=? AND published='1' ORDER BY points DESC")->limit(1)->execute($this->id, $this->arrResult['points']);
		
		$_SESSION['EXAMS']['LAST_RESULTS'] = array
		(
			'points'		=> $this->arrResult['points'],
			'percentage'	=> $this->arrResult['percentage'],
			'feedback'		=> $objFeedback->feedback,
			'passed'		=> ($this->arrResult['points'] >= $this->pointsToPass ? $GLOBALS['TL_LANG']['MSC']['yes'] : $GLOBALS['TL_LANG']['MSC']['no']),
		);
		
		// Remove exam from session, otherwise it would start over
		unset($_SESSION['EXAMS'][$this->id]);
		
		// Logout anonymous user!
		if ($this->participantMode == 'anonymous')
			$this->User->logout();
		
		
		$arrPage = $this->Database->prepare("SELECT * FROM tl_page WHERE id=?")->limit(1)->execute($this->jumpTo)->fetchAssoc();
		
		$this->redirect($this->generateFrontendUrl($arrPage));
	}
}

