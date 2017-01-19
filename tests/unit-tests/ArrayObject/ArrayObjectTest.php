<?php
/**
 * Created by PhpStorm.
 * User: Bartosz Bartniczak <kontakt@bartoszbartniczak.pl>
 */

namespace BartoszBartniczak\ArrayObject;


class ArrayObjectTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \BartoszBartniczak\ArrayObject\ArrayObject::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(\ArrayObject::class, new ArrayObject());

        $arrayObject = new ArrayObject([1, 2, 3]);
        $this->assertEquals(3, $arrayObject->count());
    }

    /**
     * @covers \BartoszBartniczak\ArrayObject\ArrayObject::shift
     */
    public function testShift()
    {
        $arrayObject = new ArrayObject([1, 2, 3]);
        $this->assertEquals(1, $arrayObject->shift());
        $this->assertEquals(2, $arrayObject->shift());
        $this->assertEquals(3, $arrayObject->shift());
    }

    /**
     * @covers \BartoszBartniczak\ArrayObject\ArrayObject::filter
     */
    public function testFilter()
    {
        $arrayObject = new ArrayObject([1, 2, 3]);
        $filteredData = $arrayObject->filter(function ($element) {
            return $element >= 2;
        });
        $this->assertEquals(2, $filteredData->count());
        $this->assertNotSame($arrayObject, $filteredData);
    }

    /**
     * @covers \BartoszBartniczak\ArrayObject\ArrayObject::pop
     */
    public function testPop()
    {
        $arrayObject = new ArrayObject([1, 2, 3]);
        $this->assertSame(3, $arrayObject->pop());
        $this->assertSame(2, $arrayObject->pop());
        $this->assertSame(1, $arrayObject->pop());
    }

    /**
     * @covers \BartoszBartniczak\ArrayObject\ArrayObject::isNotEmpty
     */
    public function testIsNotEmpty()
    {
        $arrayOfObjects = new ArrayObject();
        $this->assertFalse($arrayOfObjects->isNotEmpty());

        $arrayOfObjects->append(new \DateTime());
        $this->assertTrue($arrayOfObjects->isNotEmpty());
    }

    /**
     * @covers \BartoszBartniczak\ArrayObject\ArrayObject::isEmpty
     */
    public function testIsEmpty()
    {
        $arrayOfObjects = new ArrayObject();
        $this->assertTrue($arrayOfObjects->isEmpty());

        $arrayOfObjects->append(new \DateTime());
        $this->assertFalse($arrayOfObjects->isEmpty());
    }

    /**
     * @covers \BartoszBartniczak\ArrayObject\ArrayObject::merge
     */
    public function testMerge()
    {
        $first = new \DateTime();
        $second = new \DateTime();
        $arrayOfObjectsFirst = new ArrayObject([$first]);
        $arrayOfObjectsSecond = new ArrayObject([$second]);
        $arrayOfObjectsFirst->merge($arrayOfObjectsSecond);
        $this->assertEquals(2, $arrayOfObjectsFirst->count());
        $this->assertSame($first, $arrayOfObjectsFirst->offsetGet(0));
        $this->assertSame($second, $arrayOfObjectsFirst->offsetGet(1));
    }

    /**
     * @covers \BartoszBartniczak\ArrayObject\ArrayObject::keys
     */
    public function testKeys()
    {
        $arrayObject = new ArrayObject([1, 2, 3, 4, 5]);
        $this->assertEquals(new ArrayObject([0, 1, 2, 3, 4]), $arrayObject->keys());

        $arrayObject = new ArrayObject([12 => 1, 13 => 2, 14 => 3, 15 => 4, 16 => 5]);
        $this->assertEquals(new ArrayObject([12, 13, 14, 15, 16]), $arrayObject->keys());

        $arrayObject = new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5]);
        $this->assertEquals(new ArrayObject(['a', 'b', 'c', 'd', 'e']), $arrayObject->keys());

        $arrayObject = new ArrayObject([12 => 1, 'b' => 2, 14 => 3, 'd' => 4, 16 => 5]);
        $this->assertEquals(new ArrayObject([12, 'b', 14, 'd', 16]), $arrayObject->keys());
    }

    /**
     * @covers \BartoszBartniczak\ArrayObject\ArrayObject::first
     */
    public function testFirst()
    {
        $arrayObject = new ArrayObject([1, 2, 3, 4, 5]);
        $this->assertSame(1, $arrayObject->first());

        $arrayObject = new ArrayObject([12 => 1, 13 => 2, 14 => 3, 15 => 4, 16 => 5]);
        $this->assertSame(1, $arrayObject->first());

        $arrayObject = new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5]);
        $this->assertSame(1, $arrayObject->first());

        $arrayObject = new ArrayObject([12 => 1, 'b' => 2, 14 => 3, 'd' => 4, 16 => 5]);
        $this->assertSame(1, $arrayObject->first());
    }

    /**
     * @covers \BartoszBartniczak\ArrayObject\ArrayObject::last
     */
    public function testLast()
    {
        $arrayObject = new ArrayObject([1, 2, 3, 4, 5]);
        $this->assertSame(5, $arrayObject->last());

        $arrayObject = new ArrayObject([12 => 1, 13 => 2, 14 => 3, 15 => 4, 16 => 5]);
        $this->assertSame(5, $arrayObject->last());

        $arrayObject = new ArrayObject(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5]);
        $this->assertSame(5, $arrayObject->last());

        $arrayObject = new ArrayObject([12 => 1, 'b' => 2, 14 => 3, 'd' => 4, 16 => 5]);
        $this->assertSame(5, $arrayObject->last());
    }

}
