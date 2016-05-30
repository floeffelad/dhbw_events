<?php
namespace DHBW\DhbwEvents\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Florian Löffelad <loeffelad@dhbw.de>, DHBW
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *

 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * An Event
 */
class Demand extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {


	/**
	 * @var string A search word
	 **/
	protected $searchWord;

	/**
	 * @var \DHBW\DhbwEvents\Domain\Model\Category The demanded category
	 **/
	protected $category;

	/**
	 * @var string
	 **/
	protected $minDate;

	/**
	 * @var string
	 **/
	protected $maxDate;


	/**
	 * @param string The search word of the demand
	 * @return void
	 */
	public function setSearchWord($searchWord) {
		$this->searchWord = $searchWord;
	}

	/**
	 * @return string The search word of the demand
	 */
	public function getSearchWord() {
		return $this->searchWord;
	}

	/**
	 * @param string The minDate criteria of the demand
	 * @return void
	 */
	public function setMinDate($minDate) {
		$this->minDate = $minDate;
	}

	/**
	 * @return string The minDate criteria of the demand
	 */
	public function getMinDate() {
		return $this->minDate;
	}

	/**
	 * @param string The maxDate criteria of the demand
	 * @return void
	 */
	public function setMaxDate($maxDate) {
		$this->maxDate = $maxDate;
	}

	/**
	 * @return string The maxDate criteria of the demand
	 */
	public function getMaxDate() {
		return $this->maxDate;
	}

	/**
	 * @param \DHBW\DhbwEvents\Domain\Model\Category The demanded category
	 * @return void
	 */
	public function setCategory(\DHBW\DhbwEvents\Domain\Model\Category $category = NULL) {
		$this->category = $category;
	}

	/**
	 * @return \DHBW\DhbwEvents\Domain\Model\Category The demanded category
	 */
	public function getCategory() {
		return $this->category;
	}

}
