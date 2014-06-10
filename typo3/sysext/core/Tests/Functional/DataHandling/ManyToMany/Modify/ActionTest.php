<?php
namespace TYPO3\CMS\Core\Tests\Functional\DataHandling\ManyToMany\Modify;

/***************************************************************
 * Copyright notice
 *
 * (c) 2014 Oliver Hader <oliver.hader@typo3.org>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

require_once dirname(dirname(__FILE__)) . '/AbstractActionTestCase.php';

/**
 * Functional test for the DataHandler
 */
class ActionTest extends \TYPO3\CMS\Core\Tests\Functional\DataHandling\ManyToMany\AbstractActionTestCase {

	/**
	 * @var string
	 */
	protected $assertionDataSetDirectory = 'typo3/sysext/core/Tests/Functional/DataHandling/ManyToMany/Modify/DataSet/';

	/**
	 * MM Relations
	 */

	/**
	 * @test
	 * @see DataSet/Assertion/addCategoryRelation.csv
	 */
	public function addCategoryRelation() {
		parent::addCategoryRelation();
		$this->assertAssertionDataSet('addCategoryRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category A', 'Category B', 'Category A.A'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/deleteCategoryRelation.csv
	 */
	public function deleteCategoryRelation() {
		parent::deleteCategoryRelation();
		$this->assertAssertionDataSet('deleteCategoryRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category A'));
		$this->assertThat($responseSections, $this->getRequestSectionStructureDoesNotHaveRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category B', 'Category C', 'Category A.A'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/changeCategoryRelationSorting.csv
	 */
	public function changeCategoryRelationSorting() {
		parent::changeCategoryRelationSorting();
		$this->assertAssertionDataSet('changeCategoryRelationSorting');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category A', 'Category B'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/modifyCategoryRecordOfCategoryRelation.csv
	 */
	public function modifyCategoryOfRelation() {
		parent::modifyCategoryOfRelation();
		$this->assertAssertionDataSet('modifyCategoryOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Testing #1', 'Category B'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/modifyContentRecordOfCategoryRelation.csv
	 */
	public function modifyContentOfRelation() {
		parent::modifyContentOfRelation();
		$this->assertAssertionDataSet('modifyContentOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionHasRecordConstraint()
			->setTable(self::TABLE_Content)->setField('header')->setValues('Testing #1'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/modifyBothRecordsOfCategoryRelation.csv
	 */
	public function modifyBothsOfRelation() {
		parent::modifyBothsOfRelation();
		$this->assertAssertionDataSet('modifyBothsOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Testing #1', 'Category B'));
		$this->assertThat($responseSections, $this->getRequestSectionHasRecordConstraint()
			->setTable(self::TABLE_Content)->setField('header')->setValues('Testing #1'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/deleteContentRecordOfCategoryRelation.csv
	 */
	public function deleteContentOfRelation() {
		parent::deleteContentOfRelation();
		$this->assertAssertionDataSet('deleteContentOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionDoesNotHaveRecordConstraint()
			->setTable(self::TABLE_Content)->setField('header')->setValues('Testing #1'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/deleteCategoryRecordOfCategoryRelation.csv
	 */
	public function deleteCategoryOfRelation() {
		parent::deleteCategoryOfRelation();
		$this->assertAssertionDataSet('deleteCategoryOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureDoesNotHaveRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category A'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/copyContentRecordOfCategoryRelation.csv
	 */
	public function copyContentOfRelation() {
		parent::copyContentOfRelation();
		$this->assertAssertionDataSet('copyContentOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . $this->recordIds['newContentId'])->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category B', 'Category C'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/copyCategoryRecordOfCategoryRelation.csv
	 */
	public function copyCategoryOfRelation() {
		parent::copyCategoryOfRelation();
		$this->assertAssertionDataSet('copyCategoryOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category A', 'Category A (copy 1)'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/localizeContentRecordOfCategoryRelation.csv
	 */
	public function localizeContentOfRelation() {
		parent::localizeContentOfRelation();
		$this->assertAssertionDataSet('localizeContentOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, self::VALUE_LanguageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdLast)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category B', 'Category C'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/localizeCategoryRecordOfCategoryRelation.csv
	 */
	public function localizeCategoryOfRelation() {
		parent::localizeCategoryOfRelation();
		$this->assertAssertionDataSet('localizeCategoryOfRelation');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageId, self::VALUE_LanguageId)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdFirst)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('[Translate to Dansk:] Category A', 'Category B'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/moveContentRecordOfCategoryRelationToDifferentPage.csv
	 */
	public function moveContentOfRelationToDifferentPage() {
		parent::moveContentOfRelationToDifferentPage();
		$this->assertAssertionDataSet('moveContentOfRelationToDifferentPage');

		$responseSections = $this->getFrontendResponse(self::VALUE_PageIdTarget)->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . self::VALUE_ContentIdLast)->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category B', 'Category C'));
	}

	/**
	 * @test
	 * @see DataSet/Assertion/copyPage.csv
	 */
	public function copyPage() {
		parent::copyPage();
		$this->assertAssertionDataSet('copyPage');

		$responseSections = $this->getFrontendResponse($this->recordIds['newPageId'])->getResponseSections();
		$this->assertThat($responseSections, $this->getRequestSectionHasRecordConstraint()
			->setTable(self::TABLE_Page)->setField('title')->setValues('Relations'));
		$this->assertThat($responseSections, $this->getRequestSectionHasRecordConstraint()
			->setTable(self::TABLE_Content)->setField('header')->setValues('Regular Element #1', 'Regular Element #2'));
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . $this->recordIds['newContentIdFirst'])->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category A', 'Category B'));
		$this->assertThat($responseSections, $this->getRequestSectionStructureHasRecordConstraint()
			->setRecordIdentifier(self::TABLE_Content . ':' . $this->recordIds['newContentIdLast'])->setRecordField('categories')
			->setTable(self::TABLE_Category)->setField('title')->setValues('Category B', 'Category C'));
	}

}
