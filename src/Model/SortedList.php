<?php

namespace VM\LinkedList\Model;

use Webmozart\Assert\Assert;

final class SortedList implements SortedListInterface
{
    private ?SortedListItemInterface $first = null;

    /**
     * @inheritDoc
     */
    public function getFirst(): ?SortedListItemInterface
    {
        return $this->first;
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return null === $this->first;
    }

    /**
     * @inheritDoc
     */
    public function add(int|string $value): SortedListInterface
    {
        // list is empty - insert single item
        // or head value is greater than given value - insert item as head
        if (null === $this->first || 1 <= $this->first->compare($value)) {
            $item = new SortedListItem($value)
                ->setNext($this->first)
            ;
            $this->first = $item;

            return $this;
        }

        $current = $this->first;
        Assert::notNull($current);

        // find position for given value
        // iterating stops if next value is greater or equal than given value
        while (null !== ($next = $current->getNext()) && 0 >= $next->compare($value)) {
            $current = $next;
        }

        // create new item and link it on found position
        $item = new SortedListItem($value)
            ->setNext($next)
        ;
        $current->setNext($item);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function remove(int|string $value): SortedListInterface
    {
        if (null === $this->first) {
            // nothing to remove from empty list
            return $this;
        }

        // first item has value equal to given value
        if (0 === $this->first->compare($value)) {
            $this->first = $this->first->getNext();

            return $this;
        }

        $current = $this->first;
        // stop iterating if next value is greater than given value
        while (null !== ($next = $current?->getNext()) && 1 >= $next->compare($value)) {
            // link to next value if next value is equal to given value
            if (0 === $next->compare($value)) {
                $next = $next->getNext();
                $current->setNext($next);

                continue;
            }

            $current = $next;
        }

        // item with given value not found
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function find(int|string $value): ?SortedListItemInterface
    {
        if (true === $this->isEmpty()) {
            return null;
        }

        $current = $this->first;
        while (null !== $current) {
            // found item equal to given value
            if (0 === $current->compare($value)) {
                return $current;
            }

            // stop iterating if current value is greater than given value
            if (1 <= $current->compare($value)) {
                break;
            }

            $current = $current->getNext();
        }

        return null;
    }
}
