<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FiterTest extends TestCase
{

    public function testGetList(): void {

        Functions::setTest(true);
        $filter = new Filter();
        $filter->setFiles();
        $list = $filter->getFiles();
        $this->assertTrue(count($list) === 4);
    }

    public function testGetListFiltered(): void {

        Functions::setTest(true);
        $filter = new Filter();
        $filter->setFilter("y");
        $filter->setFiles();
        $list = $filter->getFiles();
        $this->assertTrue(count($list) === 1);
    }

}