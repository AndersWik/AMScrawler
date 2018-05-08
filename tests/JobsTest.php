<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class JobsTest extends TestCase
{

    public function testGetIsMatchTrue(): void {

        $job = new Jobs();
        $job->setContent("test git test");
        $this->assertTrue($job->getIsMatch('git'));
    }

    public function testGetIsMatchFalse(): void {

        $job = new Jobs();
        $job->setContent("test git test");
        $this->assertFalse($job->getIsMatch('qwerty'));
    }

    public function testSetAddText(): void {

        Functions::setTest(true);
        $job = new Jobs();
        $job->setAddText("2017-example.json");
        $this->assertTrue($job->getIsMatch('git'));
    }
    
}