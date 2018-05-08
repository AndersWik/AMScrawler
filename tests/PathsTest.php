<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PathsTest extends TestCase
{

    public function testGetRootPath() {

        Functions::setTest(false);
        $root = dirname(__DIR__);
        $path = Paths::getRootPath();
        $this->assertEquals($root, $path);
    }
    
    public function testGetCookiePath() {

        Functions::setTest(false);
        $root = dirname(__DIR__);
        $path = Paths::getCookiePath();
        $this->assertEquals($root."/data/cookie.txt", $path);
    }

    public function testGetIdsPath() {

        Functions::setTest(false);
        $root = dirname(__DIR__);
        $path = Paths::getIdsPath();
        $this->assertEquals($root."/data/ids.txt", $path);
    }

    public function testGetOptionsPath() {

        Functions::setTest(false);
        $root = dirname(__DIR__);
        $path = Paths::getOptionsPath();
        $this->assertEquals($root."/data/options.json", $path);
    }

    public function testGetKeysPath() {

        Functions::setTest(false);
        $root = dirname(__DIR__);
        $path = Paths::getKeysPath("file.json");
        $this->assertEquals($root."/data/keys.json", $path);
    }

    public function testGetGroupsPath() {

        Functions::setTest(false);
        $root = dirname(__DIR__);
        $path = Paths::getGroupPath("file.json");
        $this->assertEquals($root."/data/groups/file.json", $path);
    }

    public function testGetGroupPath() {

        Functions::setTest(false);
        $root = dirname(__DIR__);
        $path = Paths::getGroupPath("test");
        $this->assertEquals($root."/data/groups/test", $path);
    }

    public function testGetTemplatesPath() {

        Functions::setTest(false);
        $root = dirname(__DIR__);
        $path = Paths::getTemplatesPath("test");
        $this->assertEquals($root."/src/app/templates/", $path);
    }

    public function testGetTemplatePath() {

        Functions::setTest(false);
        $root = dirname(__DIR__);
        $path = Paths::getTemplatePath("test.phtml");
        $this->assertEquals($root."/src/app/templates/test.phtml", $path);
    }
    
}