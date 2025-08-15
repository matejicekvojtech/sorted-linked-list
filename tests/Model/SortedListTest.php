<?php

namespace Tests\VM\LinkedList\Model;

use PHPUnit\Framework\TestCase;
use VM\LinkedList\Exception\SortedListItemTypeMismatchException;
use VM\LinkedList\Model\SortedList;
use VM\LinkedList\Model\SortedListItem;

class SortedListTest extends TestCase
{
    /** @var string[] */
    private const array STRING_VALUES = ['a', 'bb', 'ccc', '', 'lorem ipsum dolor sit amet', 'bb', 'asdf', 'qwerty'];

    /** @var int[] */
    private const array INT_VALUES = [11, 1, 5, 3, 25, 17, 5, 8, 6];

    public function testCreateEmptySortedList(): void
    {
        $list = new SortedList();

        $this->assertTrue($list->isEmpty());
    }

    public function testInsertInt(): void
    {
        $list = $this->createListAndInsert(self::INT_VALUES);
        $this->assertListIsSorted($list);
    }

    public function testInsertString(): void
    {
        $list = $this->createListAndInsert(self::STRING_VALUES);
        $this->assertListIsSorted($list);
    }

    public function testInsertIntToStringListWillFail(): void
    {
        $list = new SortedList();

        $list->add(1);
        $this->assertFalse($list->isEmpty());

        $this->expectException(SortedListItemTypeMismatchException::class);
        $this->expectExceptionMessage('Invalid comparison between integer and string');
        $list->add('test');
    }

    public function testInsertStringToIntListWillFail(): void
    {
        $list = new SortedList();

        $list->add('test');
        $this->assertFalse($list->isEmpty());

        $this->expectException(SortedListItemTypeMismatchException::class);
        $this->expectExceptionMessage('Invalid comparison between string and integer');
        $list->add(1);
    }

    public function testFindStringInIntListWillFail(): void
    {
        $list = new SortedList();

        $list->add(1);
        $this->assertFalse($list->isEmpty());

        $this->expectException(SortedListItemTypeMismatchException::class);
        $this->expectExceptionMessage('Invalid comparison between integer and string');
        $list->find('test');
    }

    public function testFindIntInStringListWillFail(): void
    {
        $list = new SortedList();

        $list->add('test');
        $this->assertFalse($list->isEmpty());

        $this->expectException(SortedListItemTypeMismatchException::class);
        $this->expectExceptionMessage('Invalid comparison between string and integer');
        $list->find(1);
    }

    public function testRemoveFromIntList(): void
    {
        $this->removeFromList(self::INT_VALUES);
    }

    public function testRemoveFromStringList(): void
    {
        $this->removeFromList(self::STRING_VALUES);
    }

    private function removeFromList(array $values): void
    {
        $valueInList = $values[array_rand($values)];

        $list = $this->createListAndInsert($values);

        $valueItem = $list->find($valueInList);
        $this->assertNotNull($valueItem);
        $this->assertInstanceOf(SortedListItem::class, $valueItem);
        $this->assertEquals($valueInList, $valueItem->getValue());

        $list->remove($valueInList);

        $valueItem = $list->find($valueInList);
        $this->assertNull($valueItem);
    }

    private function createListAndInsert(array $values): SortedList
    {
        $list = new SortedList();
        $this->assertTrue($list->isEmpty());

        foreach ($values as $value) {
            $list->add($value);
        }

        $this->assertFalse($list->isEmpty());

        return $list;
    }

    private function assertListIsSorted(SortedList $list): void
    {
        if ($list->isEmpty()) {
            return;
        }

        $current = $list->getFirst();
        while (null !== ($next = $current->getNext())) {
            $this->assertLessThanOrEqual(0, $current->compare($next->getValue()));

            $current = $next;
        }
    }
}
