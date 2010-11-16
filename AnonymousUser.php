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


class AnonymousUser extends User
{

	/**
	 * Name of the corresponding table
	 * @var string
	 */
	protected $strTable = '';

	/**
	 * Name of the current cookie
	 * @var string
	 */
	protected $strCookie = 'ANONYMOUS_AUTH';


	/**
	 * Initialize the object
	 */
	protected function __construct()
	{
		parent::__construct();

		$this->strIp = $this->Environment->ip;
		$this->strHash = $this->Input->cookie($this->strCookie);
		
		if (!$this->authenticate())
		{
			$this->login();
		}
	}


	/**
	 * Set the current referer and save the session
	 */
	public function __destruct()
	{
		$session = $this->Session->getData();

		if (!isset($_GET['pdf']) && !isset($_GET['file']) && !isset($_GET['id']) && $session['referer']['current'] != $this->Environment->requestUri)
		{
			$session['referer']['last'] = $session['referer']['current'];
			$session['referer']['current'] = $this->Environment->requestUri;
		}

		$this->Session->setData($session);

/*
		if (strlen($this->intId))
		{
			$this->Database->prepare("UPDATE " . $this->strTable . " SET session=? WHERE id=?")
						   ->execute(serialize($session), $this->intId);
		}
*/
	}


	/**
	 * Extend parent getter class and modify some parameters
	 * @param string
	 * @return mixed
	 */
	public function __get($strKey)
	{
		switch ($strKey)
		{
			case 'id':
				return 0;
				
			case 'groups':
				return array(); //is_array($this->arrData['groups']) ? $this->arrData['groups'] : array($this->arrData['groups']);
				break;

			default:
				return parent::__get($strKey);
				break;
		}
	}


	/**
	 * Return the current object instance (Singleton)
	 * @return object
	 */
	public static function getInstance()
	{
		if (!is_object(self::$objInstance))
		{
			self::$objInstance = new AnonymousUser();
		}

		return self::$objInstance;
	}
	


	/**
	 * Try to login the current user
	 * @return boolean
	 */
	public function login()
	{
//		$time = time();
		
		// Generate hash
		$this->strHash = sha1(session_id() . (!$GLOBALS['TL_CONFIG']['disableIpCheck'] ? $this->strIp : '') . $this->strCookie);
/*

		// Clean up old sessions
		$this->Database->prepare("DELETE FROM tl_session WHERE tstamp<? OR hash=?")
					   ->execute(($time - $GLOBALS['TL_CONFIG']['sessionTimeout']), $this->strHash);

		// Save session in the database
		$this->Database->prepare("INSERT INTO tl_session (pid, tstamp, name, sessionID, ip, hash) VALUES (?, ?, ?, ?, ?, ?)")
					   ->execute(0, $this->tstamp, $this->strCookie, session_id(), $this->strIp, $this->strHash);
*/

		// Set authentication cookie
		$this->setCookie($this->strCookie, $this->strHash, ($this->tstamp + $GLOBALS['TL_CONFIG']['sessionTimeout']), $GLOBALS['TL_CONFIG']['websitePath']);

		// Add login status for cache
		$_SESSION['TL_USER_LOGGED_IN'] = true;

		// Add a log entry
		$this->log('Anonymous user has logged in', get_class($this) . ' login()', TL_ACCESS);
		return true;
	}


	/**
	 * Remove the authentication cookie and destroy the current session
	 * @return boolean
	 */
	public function logout()
	{
		// Return if the user has been logged out already
		if (!$this->Input->cookie($this->strCookie))
		{
			return false;
		}

/*
		$objSession = $this->Database->prepare("SELECT * FROM tl_session WHERE hash=? AND name=?")
									 ->limit(1)
									 ->execute($this->strHash, $this->strCookie);

		if ($objSession->numRows)
		{
			$this->strIp = $objSession->ip;
			$this->strHash = $objSession->hash;
			$intUserid = $objSession->pid;
		}
*/

		$time = time();

/*
		// Remove session from the database
		$this->Database->prepare("DELETE FROM tl_session WHERE hash=?")
					   ->execute($this->strHash);
*/

		// Remove cookie and hash
		$this->setCookie($this->strCookie, $this->strHash, ($time - 86400), $GLOBALS['TL_CONFIG']['websitePath']);
		$this->strHash = '';

		// Destroy the current session
		session_destroy();
		session_write_close();

		// Reset the PHPSESSID cookie
		setcookie('PHPSESSID', session_id(), ($time - 86400), '/');

		// Remove login status for cache
		$_SESSION['TL_USER_LOGGED_IN'] = false;

		// Add a log entry
//		if ($this->findBy('id', $intUserid) != false)
//		{
//			$GLOBALS['TL_USERNAME'] = $this->username;
			$this->log('Anonymous user has logged out', get_class($this) . ' logout()', TL_ACCESS);
//		}

		return true;
	}


	/**
	 * Dummy function, required by parent class
	 */
	protected function setUserFromDb() {}
	
	
	/**
	 * We cannot search a db, but we don't care either
	 */
	public function findBy($strRefField, $varRefId)
	{
		return true;
	}
}

