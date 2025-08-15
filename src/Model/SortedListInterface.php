<?php

namespace VM\LinkedList\Model;

use VM\LinkedList\Exception\SortedListItemTypeMismatchException;

interface SortedListInterface
{
    /**
     * Returns first item of linked list or null if list is empty
     *
     * @return SortedListItemInterface|null
     */
    public function getFirst(): ?SortedListItemInterface;

    /**
     * Checks if list is empty
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Creates new item to correct position in sorted linked list
     *
     * @param int|string $value
     * @return SortedListInterface
     * @throws SortedListItemTypeMismatchException if given value has incorrect type
     */
    public function add(int|string $value): SortedListInterface;

    /**
     * Removes all items with given value from sorted linked list
     *
     * @param int|string $value
     * @return SortedListInterface
     * @throws SortedListItemTypeMismatchException if given value has incorrect type
     */
    public function remove(int|string $value): SortedListInterface;

    /**
     * Returns first item from sorted linked list with given value
     * or null if no list item has given value
     *
     * @param int|string $value
     * @return SortedListItemInterface|null
     * @throws SortedListItemTypeMismatchException if given value has incorrect type
     */
    public function find(int|string $value): ?SortedListItemInterface;
}
