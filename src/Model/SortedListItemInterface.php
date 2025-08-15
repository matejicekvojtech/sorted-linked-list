<?php

namespace VM\LinkedList\Model;

use VM\LinkedList\Exception\SortedListItemTypeMismatchException;

interface SortedListItemInterface
{
    /**
     * Returns value of sorted list item
     *
     * @return int|string
     */
    public function getValue(): int|string;

    /**
     * Returns pointer to next linked sorted list item or null if current item is last
     *
     * @return SortedListItemInterface|null
     */
    public function getNext(): ?SortedListItemInterface;

    /**
     * Sets pointer to next linked item in sorted list or null if this should be last item
     *
     * @param SortedListItemInterface|null $next
     * @return SortedListItemInterface
     */
    public function setNext(?SortedListItemInterface $next): SortedListItemInterface;

    /**
     * Compares current item value with given value
     *
     * @return int <p><ul>
     * <li>lower than 0 if current item has lower value than compared value</li>
     * <li>0 if current item has value equal to compared value</li>
     * <li>greater than 0 if current item has greater value than compared value</li>
     * </ul></p>
     *
     * @throws SortedListItemTypeMismatchException if comparing two different value types
     */
    public function compare(int|string $value): int;
}
