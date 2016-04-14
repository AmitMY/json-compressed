# JSONc (JSON compressed)
A compressed way to parse objects/asociative arrays

## How does it work?
When you have an associative array, it breaks into an array of keys, and array of values.

# Small example:
`{"data": [{"my_key": "my_val1"},{"my_key": "my_val2"},{"my_key": "my_val3"},{"my_key": "my_val4"},{"my_key": "my_val5"},{"my_key": "my_val6"},{"my_key": "my_val7"},{"my_key": "my_val8"},{"my_key": "my_val9"}]}` = 209

Compressed:

`{"data": {"keys": ["my_key"], "data":["my_val1","my_val2","my_val3","my_val4","my_val5","my_val6","my_val7","my_val8","my_val9"]}}` = 130

Ratio: 130/209 = 62%

# Big example (example/example.php):
Same ratio for 100, 1000, or 50000 rows. ~ 45% for fair data

Number of rows:
50,000

JSON Compressed size:
21.55MB

JSON size:
47.3MB

Compressed size compared to uncompressed size:
45.57%

## Usage
```js
    $.ajax({dataType: "jsonc"});
```
```php
    jsonc_encode($my_array, $my_keys);
```
Where $my_keys is an array of the keys that contain the associative arrays. In my example, just `["data"]`

## Dependencies
- jQuery (code contains an ajax type extension)