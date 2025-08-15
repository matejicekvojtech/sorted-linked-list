<?php

namespace Tests\VM\LinkedList\Model;

use PHPUnit\Framework\TestCase;
use VM\LinkedList\Model\SortedListItem;

class SortedListItemTest extends TestCase
{
    public function testCreateIntSortedListItem(): void
    {
        $intValue = 10;
        $intItem = new SortedListItem($intValue);

        $this->assertSame($intValue, $intItem->getValue());
        $this->assertNull($intItem->getNext());
    }

    public function testCreateStringSortedListItem(): void
    {
        $stringValue = 'test';
        $stringItem = new SortedListItem($stringValue);

        $this->assertSame($stringValue, $stringItem->getValue());
        $this->assertNull($stringItem->getNext());
    }
}
