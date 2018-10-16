<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class DataProviderDependencyTest extends PHPUnit\Framework\TestCase
{
    public function testReference(): void
    {
        $this->markTestSkipped('This testController should be skipped.');
        $this->assertTrue(true);
    }

    /**
     * @see https://github.com/sebastianbergmann/phpunit/issues/1896
     * @depends testReference
     * @dataProvider provider
     */
    public function testDependency($param): void
    {
    }

    public function provider()
    {
        $this->markTestSkipped('Any testController with this data provider should be skipped.');

        return [];
    }
}
