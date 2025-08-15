# Sorted Linked List Library
This library was created as task for ShipMonk recruit process.

## Usage
This list can hold integer or string values sorted in ascending order. Value types of items in single list cannot mix (all values are either integer or string).

### Create list
```php
use VM\LinkedList\Model\SortedList
/* ... */
$list = new SortedList();
```

### Insert value
```php
$list = new SortedList();

$list->add(123);
// list: 123

$list->add(111);
// list: 111 -> 123
/* ... */
```
### Find value
```php
$item = $list->find(5);
// item: null

$item = $list->find(123);
// item: SortedListItem {value: 123, next: null}

$item = $list->find(111);
// item: SortedListItem {
//      value: 111,
//      next: SortedListItem {
//          value: 123,
//          next: null
//      }
//  }
/* ... */
```
### Remove value
```php
$list->remove(5);
// list: 111 -> 123

$list->remove(111);
// list: 123
```
### Author
[Vojtěch Matějíček](mailto:matejicek.vojtech@gmail.com)
