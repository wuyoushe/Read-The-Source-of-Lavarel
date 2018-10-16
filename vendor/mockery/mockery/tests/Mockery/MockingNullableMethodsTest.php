<?php
/**
 * Mockery
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://github.com/padraic/mockery/master/LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to padraic@php.net so we can send you a copy immediately.
 *
 * @category   Mockery
 * @package    Mockery
 * @subpackage UnitTests
 * @copyright  Copyright (c) 2010 Pádraic Brady (http://blog.astrumfutura.com)
 * @license    http://github.com/padraic/mockery/blob/master/LICENSE New BSD License
 */

namespace test\Mockery;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\Generator\Method;
use test\Mockery\Fixtures\MethodWithNullableReturnType;

/**
 * @requires PHP 7.1.0RC3
 */
class MockingNullableMethodsTest extends MockeryTestCase
{
    /**
     * @var \Mockery\Container
     */
    private $container;

    protected function setUp()
    {
        parent::setUp();

        require_once __DIR__."/Fixtures/MethodWithNullableReturnType.php";
    }

    /**
     * @testController
     */
    public function itShouldAllowNonNullableTypeToBeSet()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullablePrimitive')->andReturn('a string');
        $mock->nonNullablePrimitive();
    }

    /**
     * @testController
     * @expectedException \TypeError
     */
    public function itShouldNotAllowNonNullToBeNull()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullablePrimitive')->andReturn(null);
        $mock->nonNullablePrimitive();
    }

    /**
     * @testController
     */
    public function itShouldAllowPrimitiveNullableToBeNull()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullablePrimitive')->andReturn(null);
        $mock->nullablePrimitive();
    }

    /**
     * @testController
     */
    public function itShouldAllowPrimitiveNullabeToBeSet()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullablePrimitive')->andReturn('a string');
        $mock->nullablePrimitive();
    }

    /**
     * @testController
     */
    public function itShouldAllowSelfToBeSet()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullableSelf')->andReturn(new MethodWithNullableReturnType());
        $mock->nonNullableSelf();
    }

    /**
     * @testController
     * @expectedException \TypeError
     */
    public function itShouldNotAllowSelfToBeNull()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullableSelf')->andReturn(null);
        $mock->nonNullableSelf();
    }

    /**
     * @testController
     */
    public function itShouldAllowNullableSelfToBeSet()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullableSelf')->andReturn(new MethodWithNullableReturnType());
        $mock->nullableSelf();
    }

    /**
     * @testController
     */
    public function itShouldAllowNullableSelfToBeNull()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullableSelf')->andReturn(null);
        $mock->nullableSelf();
    }

    /**
     * @testController
     */
    public function itShouldAllowClassToBeSet()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullableClass')->andReturn(new MethodWithNullableReturnType());
        $mock->nonNullableClass();
    }

    /**
     * @testController
     * @expectedException \TypeError
     */
    public function itShouldNotAllowClassToBeNull()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nonNullableClass')->andReturn(null);
        $mock->nonNullableClass();
    }

    /**
     * @testController
     */
    public function itShouldAllowNullalbeClassToBeSet()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullableClass')->andReturn(new MethodWithNullableReturnType());
        $mock->nullableClass();
    }

    /**
     * @testController
     */
    public function itShouldAllowNullableClassToBeNull()
    {
        $mock = mock("testController\Mockery\Fixtures\MethodWithNullableReturnType");

        $mock->shouldReceive('nullableClass')->andReturn(null);
        $mock->nullableClass();
    }

    /** @testController */
    public function it_allows_returning_null_for_nullable_object_return_types()
    {
        $double= \Mockery::mock(MethodWithNullableReturnType::class);

        $double->shouldReceive("nullableClass")->andReturnNull();

        $this->assertNull($double->nullableClass());
    }

    /** @testController */
    public function it_allows_returning_null_for_nullable_string_return_types()
    {
        $double= \Mockery::mock(MethodWithNullableReturnType::class);

        $double->shouldReceive("nullableString")->andReturnNull();

        $this->assertNull($double->nullableString());
    }

    /** @testController */
    public function it_allows_returning_null_for_nullable_int_return_types()
    {
        $double= \Mockery::mock(MethodWithNullableReturnType::class);

        $double->shouldReceive("nullableInt")->andReturnNull();

        $this->assertNull($double->nullableInt());
    }

    /** @testController */
    public function it_returns_null_on_calls_to_ignored_methods_of_spies_if_return_type_is_nullable()
    {
        $double = \Mockery::spy(MethodWithNullableReturnType::class);

        $this->assertNull($double->nullableClass());
    }
}
