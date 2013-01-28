#NiceTime

A simple class for creating formatted output of time periods in facebook style.

It is based on a simple function from one of the comments on the php.net PHP manual for the php time() function:
http://php.net/manual/en/function.time.php#89415

##Examples

Here is a list of possible ouput generated by objects of class *\Remluben\DateFormat\NiceTime* without any customization

* 1 minute ago
* 3 minutes from now
* 5 days ago
* 1 day from now
* 6 months ago
* 1 year ago
* 2 decades ago

##Customizing

After creating an \Remluben\DateFormat\NiceTime object instance it is essential to modify all labels so they suite your custom needs

```php
    $nt = new \Remluben\DateFormat\NiceTime();
```

###bad date label

In the following example we show the bad date label's getter method
and use it's setter method to set it to an empty string.

```php
    // the default \Remluben\DateFormat\NiceTime bad date label is 'Bad date'
    $nt->getBadDateLabel(); 
    $nt->setBadDateLabel('');
```
Whenever we call the object's *format()* method with an invalid date string,
it is going to return an empty string.

###no date label

In the following example we show the no date label's getter method
and use it's setter method to set it to an empty string.

```php
    // the default NiceDate bad date label is 'No date provided'
    $nt->getNoDateLabel(); 
    $nt->setNoDateLabel('');
```

Whenever we call the object's *format()* method with an empty date string,
it is going to return an empty string instead of it's default label 'No date provided'.

###future tense

The future tense string is used to format future datetimes and is expected to contain *%s*
sign where the time time value is going to be parsed into.

By default it's value is '%s from now', which seems quite okay in English. However for
some languages the format of this string probably varies a lot from it's english version.

```php
    // the default NiceDate future tense is '%s from now'
    $nt->getFutureTense(); 
    $nt->setFutureTense('in %s');
```

###past tense

By default it's value is '%s ago'. 

For further information see *future tense*

###periods

With periods we probably come across the most difficult part of customization.

The default periods are:

* second/s
* minute/s
* hour/s
* week/s
* month/s
* year/s
* decade/s

Note, that the */* sign is used as separator for singular / plural words. 
This is essential, as we want to get formats as *1 day ago*, but also *2 days ago*.


**Example**

```php
    $nt->setPeriods(array(
            'second/s',
            'minute/s',
            'hour/s',
            'week', // oh no we made a mistake here
            'month/s',
            'year/s',
            'decade/s',
    ));
    $date = date('Y-m-d', time() - 60 * 60 * 24 * 14); // two weeks ago
    // bad formatting as we missed the slash when configuring the periods above
    $nt->format($date); // => 2 week ago 
```

##Method chaining

As described within the section *customizing* above, there exists a lot of
methods to customize a \Remluben\DateFormat\NiceTime object's behaviour.

Method chaining allows you to do this in a nice and clean way:

```php
    $nicetime = new \Remluben\DateFormat\NiceTime();
    // some funny customizing here - use method chaining
    $nicetime->setBadDateLabel('wtf')
             ->setNoDateLabel('lol this is no date')
             ->setFutureTense('%s from now - what else?')
             ->setPastTense('%s ago... puh');
    // now some output
    // 2 hours ago... puh
    echo $nicetime->format(date('Y-m-d H:i:s', time() - (2 * 60 * 60)));
    // 1 day from now - what else?
    echo $nicetime->format(date('Y-m-d H:i:s', time() + (24 * 60 * 60)));
```
