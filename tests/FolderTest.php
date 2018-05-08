<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FolderTest extends TestCase
{

    public function testSetFilter(): void {

        $folder = new Folder(Paths::getRootPath()."/tests/data/");
        $folder->setFilter("test");
        $filter = $folder->getFilter();
        $this->assertEquals($filter, "test");
    }

    public function testGetList(): void {

        $folder = new Folder(Paths::getRootPath()."/tests/data/jobs/");
        $list = $folder->getList();
        $this->assertTrue(count($list) === 4);
    }

    public function testGetListFiltered(): void {

        $folder = new Folder(Paths::getRootPath()."/tests/data/jobs/");
        $folder->setFilter("2018");
        $list = $folder->getListFiltered();
        $this->assertTrue(count($list) === 1);
    }
    
}