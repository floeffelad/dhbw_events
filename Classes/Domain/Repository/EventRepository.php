<?php
namespace DHBW\DhbwEvents\Domain\Repository;


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
 * The repository for Events
 */
class EventRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Finds all offers that meets the specified demand.
	 *
	 * @param \DHBW\DhbwEvents\Domain\Model\Demand $demand
	 * @param array $propertiesToSearch A array of properties to be searched for occurrances of the search word
	 * @return Tx_Extbase_Persistence_QueryResultInterface The events
	 */

	public function findDemanded(\DHBW\DhbwEvents\Domain\Model\Demand $demand = NULL, array $propertiesToSearch = array()){
		$query       = $this->createQuery();
		$constraints = array();
		$today = date('Y-m-d',time());

		if ($demand === NULL) {
		$query->matching($query->greaterThanOrEqual('date',  $today));
		$query->setOrderings(array(
			'date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING)
		);
			return $query->execute();
		}

		if ($demand !== NULL) {
			if ($demand->getCategory() !== NULL) {
				$constraints[] = $query->contains('categories', $demand->getCategory());
			}
			if ($demand->getCategory() === 0) {
				$constraints[] = $query->greaterThanOrEqual('date',  $today);
			}

			if (
				is_string($demand->getSearchWord())
				&& strlen($demand->getSearchWord()) > 0
				&& count($propertiesToSearch) > 0
			) {
				$searchWordConstraints = array();
				foreach ($propertiesToSearch as $propertyName) {
					$searchWordConstraints[] = $query->like($propertyName, '%' . $demand->getSearchWord() . '%');
				}
				$constraints[] = $query->logicalOr($searchWordConstraints);
			} 
			if ($demand->getSearchWord() === "") {
				$constraints[] = $query->greaterThanOrEqual('date',  $today);
			}

			$demandedMaxDate = $demand->getMaxDate();
			$demandedMinDate = $demand->getMinDate();

			if (!empty($demandedMaxDate)&&($demandedMinDate) ) {

				$demandedMaxDate = date("Y-m-d", strtotime($demand->getMaxDate()));
				$demandedMinDate = date("Y-m-d", strtotime($demand->getMinDate()));

				$constraints[] = $query->logicalAnd(
					$query->logicalOr(
						$query->equals('date', NULL),
						$query->equals('date', 0),
						$query->lessThanOrEqual('date', $demandedMaxDate)
					),
					$query->logicalOr(
						$query->equals('date', NULL),
						$query->equals('date', 0),
						$query->greaterThanOrEqual('date', $demandedMinDate)
					)
				);
			}

			$query->matching($query->logicalAnd($constraints));
			$query->setOrderings(array(
			'date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING));
			return $query->execute();
		}
	}

	public function findForTeaserView() {
		$today = date('Y-m-d',time());

		$query = $this->createQuery();
		$query->setLimit(3);
		$query->matching($query->greaterThanOrEqual('date',  $today));
		$query->setOrderings(array(
			'date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING)
		);
		return $query->execute();
	}
}