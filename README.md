PHP Tap
===

Part of the Tapshrooms family.

Usage
---
```php
include('tap.php');
$tap = new Tap();
for ($i = 0; $i < 10; $i++) {
	$tap->pressure->increase();
}
```

Output:
```
I'm a tap!
Catch me if you can!
BANG!
```