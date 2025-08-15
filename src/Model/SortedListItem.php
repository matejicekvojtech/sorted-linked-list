<?php

namespace VM\LinkedList\Model;

use VM\LinkedList\Exception\SortedListItemTypeMismatchException;

final class SortedListItem implements SortedListItemInterface
{
    private ?SortedListItemInterface $next = null;

    public function __construct(
        private readonly int|string $value
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function getValue(): int|string
    {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function getNext(): ?SortedListItemInterface
    {
        return $this->next;
    }

    /**
     * @inheritDoc
     */
    public function setNext(?SortedListItemInterface $next): SortedListItemInterface
    {
        $this->next = $next;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function compare(int|string $value): int
    {
        if (is_int($this->value) && is_int($value)) {
            return $this->value <=> $value;
        }

        if (is_string($this->value) && is_string($value)) {
            return strcmp($this->value, $value);
        }

        throw new SortedListItemTypeMismatchException(
            sprintf('Invalid comparison between %s and %s', gettype($this->value), gettype($value))
        );
    }
}
