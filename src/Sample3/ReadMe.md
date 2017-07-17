# Sample 3

## introduction

| class | purpose     |
| ----- |-------------|
| A     | a service class to provide and check entitlement keys. The keys are read from the configuration repository. |
| A1    | class A refactored (see explanation) |
| B     | Same as A, but the configuration repository is injected as a dependency | 
| C     | A repository that provides key/value pairs. The key value pairs are read from a persistent storage. We use here the file system for simplicity, but i could also be a database. |
 
 
## the goals
 
1. Check that `Sample3::getEntitlements()` will return an array.
1. Check that `Sample3::getEntitlements()` will return an empty array when no entitlements are present in the storage.
1. Check that `Sample3::getEntitlements()` will return two keys when two entitlements are present in the storage.
1. Check that `Sample3::isEntitledTo()` will return false when given key is not within the list of entitlements.
1. Check that `Sample3::isEntitledTo()` will return true when given key is within the list of entitlements.
1. Ensure that behaviour of unit test won't change when the storage changes.
 
 
## writing the unit tests

### the challange
 ```php
     public function testGetEntitlements() {
         $a = new A();
         $k = $a->getEntitlements();
         $this::assertCount(2, $k);
     }
 ```
 `$a->getEntitlements()` will return a list of all entitlements, read from the persitant store.
 The unit test will pass as long as there are excatly two entitlements persisted in the storage, 
 but when it changes the test will fail. So we would. miss our goal #6.
 
 So whe have to mock the repository that provides the key/value pairs from the entitlement store:
 
### mocking the repository (class C)
 
```php
    $cr = $this->getMockBuilder(C::class)
        ->disableOriginalConstructor()
        ->setMethods(['getConfig'])
        ->getMock();
    $cr->expects($this::once())
        ->method('getConfig')
        ->with('entitlements')
        ->willReturn(['de.frankfleige.phpunit.sample3.1', 'de.frankfleige.phpunit.sample3.2']);
```            
First we create a mocked instance, but without calling the original constructor of A. 
Thats because the original constructor would initialize the key/value pairs from the persistant storage:

Second we tell the unit test that we expect exactly one call of the method `getConfig($key)` with the key `entitlements`.
This call will return a fi`xed array with two entitlement keys.

### replacing the original with the mock

This is where trouble begins when writing the unit test for A. 
Whe have to replace the original class A with its mocked one.

```php
    /**
     * will get an instance of the configuration repository
     * @return C
     */
    public function getConfigurationRepository() {
        return C::getInstance();
    }
```

To to that we have to replace the method `getConfigurationRepository`, so 
that it will return the mocked instance of C instead of the original one.

```php
    // $cr is the mocked instance of C (see above)
    $a = $this->getMockBuilder(A::class)
        ->disableOriginalConstructor()
        ->setMethods(['getConfigurationRepository'])
        ->getMock();
    $a->expects(self::once())
        ->method('getConfigurationRepository')
        ->willReturn($cr);
```
So when we now run our unit test, ...

```php
    /** @var Sample3 $a */
    $k = $a->getEntitlements();
    $this::assertInternalType("array", $k);
    $this::assertCount(2, $k);
```

... it will fail! Why? Let's have a look at the constructor of A:

```php
    public function __construct() {
        $this->keys = [];
        $this->initEntitlements();
    }
```

As you can see, there is a call of the `initEntitlements` method:

```php
    private function initEntitlements() {
        $this->entitlements = $this->getConfigurationRepository()->getConfig('entitlements');
    }
```

Because we disabled the original constructor when creating the mocked instance of A, 
the internal entitlement storage of A has not been initialized. 
How get we out of this? Well, there is no other way than to refactor the code:

1. Removing the initialization of the internal entitlement storage from the constructor.

```php
    public function __construct() {
        $this->entitlements = [];
    }
```

2. Changing the scope of `initEntitlements()` to `public`

```php
    public function initEntitlements() {
        $this->entitlements = $this->getConfigurationRepository()->getConfig('entitlements');
    }
```

3. Extend all instantiations of `A` with a call of `initEntitlements()`

```php
    $a = new A();
    $a->initEntitlements();
    // ... do something else with a public interface of $a ...
```

With the refactored class A1 we can achieve all our goals for the unit test.

### how dependency injection would help

When C is injected as a dependency, things will get a lot easier 
(regarding writing unit tests... ;-)). We only have to create an instance of mocked class C (see above)
and inject it to B when creating an instance of it:

```php
    // $cr is an instance of the mocked class C
    $b = new B($cr);
```