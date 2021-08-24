# csv
OOP wrapper for PHP's csv functions, with column mapping for easy code maintenance.
# Easy to use and maintain the code using it
The code can be easily adopted to changing requirements and input file formats.

Consider CSV data of the world's heaviest animals having position, animal and weight in 1 line as column headings.
```php
<?php
use \Okneloper\Csv\Stream\Input\FileStream;
use \Okneloper\Csv\CsvReader;

// read CSV data from a file
$dataSource = new FileStream($file);

// creata a reader
$csv = new CsvReader($dataSource);

// read rows one by one
while ($row = $csv->read()) {
    echo $row->position; // value for the row in column 0 with header 'position'
    echo $row->animal;   // value for the row in column 1 with header 'animal'
    echo $row->weight;   // value for the row in column 2 with header 'weight'
    echo $row["weight"]; // also supports array syntax 
}

```

# Usage 
Use a CSV file as a data source
```php
    $dataSource = new \Okneloper\Csv\Stream\Input\FileStream($file);
```
Or alternatively use a string containing CSV data
```php
    $dataSource = new \Okneloper\Csv\Stream\StringStream("position,animal,weight\n1,Blue whale,180 tonnes\n2,African Elephant,6350 kg\n3,Brown Bear,1 ton");
```
Create a reader using the data source
```php
    $csv = new \Okneloper\Csv\CsvReader($dataSource);
```
Read the data
```php
    while ($row = $csv->read()) {
        print_r($row->toArray());
    }
```
Mapped data can be accessed as array elements:
```php
echo $row['position'];
```
or object properties: 
```php
echo $row->position;
```

## Column mapping ##
### Mapping to header ###
By default, the data is mapped to the header row.
```php
$csv = new \Okneloper\Csv\CsvReader($dataSource);
```
Outputs
```
Array
(
    [position] => 1
    [animal] => Blue whale
    [weight] => 180 tonnes
)
...
```
### Custom mapping ###
If you get a new CSV to process every once in a regularly and the column order or names may change, custom mapping helps
 to deal with it:
```php
$csv = new \Okneloper\Csv\CsvReader($dataSource, true, ['Nr', 'Who', 'HowMuch']);
```
```
Array
(
    [Nr] => 1
    [Who] => Blue whale
    [HowMuch] => 180 tonnes
)
...
```

### No header ###
```php
$csv = new \Okneloper\Csv\CsvReader($dataSource, false, ['Nr', 'Who', 'HowMuch']);
```
```
Array
(
    [Nr] => position
    [Who] => animal
    [HowMuch] => weight
)
Array
(
    [Nr] => 1
    [Who] => Blue whale
    [HowMuch] => 180 tonnes
)
...
```

### No header, no mapping ###
```php
$csv = new \Okneloper\Csv\CsvReader($dataSource, false, null);
```
```php
Array
(
    [0] => position
    [1] => animal
    [2] => weight
)
Array
(
    [0] => 1
    [1] => Blue whale
    [2] => 180 tonnes
)
...
```
