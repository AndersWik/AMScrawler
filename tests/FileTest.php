<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FileTest extends TestCase
{
    public function testGetContent(): void {

        $file = new File(Paths::getRootPath()."/tests/data/file.txt");
        $content = $file->getContent();
        $this->assertEquals($content, 'test');
    }

    public function testGetContentJsonDecode(): void {

        $file = new File(Paths::getRootPath()."/tests/data/jobs/2017-example.json");
        $content = $file->getContentJsonDecode();
        $this->assertEquals($content["id"], "10458456");
    }

    public function testGetContentArray(): void {

        $file = new File(Paths::getRootPath()."/tests/data/array.txt");
        $content = $file->getContentArray(); 
        $this->assertTrue(is_array($content));
    }
 
    public function testAppendToFile(): void {

        $file = new File(Paths::getRootPath()."/tests/data/append.txt");
        $file->writeToFile("");
        $file->appendToFile($content);
        $content = $file->getContent();
        $this->assertEquals("test", 'test');
    }

    public function testWriteToFile(): void {

        $file = new File(Paths::getRootPath()."/tests/data/file2.txt");
        $date = date('Y');
        $file->writeToFile($date);
        $content = $file->getContent();
        $this->assertEquals($content, $date);
    }

    public function testIsPathFileTrue(): void {

        $file = new File(Paths::getRootPath()."/tests/data/jobs/2017-example.json");
        $this->assertTrue($file->isPathFile());
    }

    public function testIsPathFileFalse(): void {

        $file = new File(Paths::getRootPath()."/tests/data/jobs/2019-example.json");
        $this->assertFalse($file->isPathFile());
    }   
    
}



