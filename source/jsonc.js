function jsonc_decode(string) {
	var data_keys, data_values, k, k2, key;
	var array = JSON.parse(string);
	var keys = array["keys"];
	array = array["response"];
	for(var x in keys) {
		key = keys[x];
		if(array[key] === undefined)
			throw new Exception("Key '"+key+"' does not exist");

		data_keys = array[key]["keys"];
		data_values = array[key]["data"];

		array[key] = [];
		for(k in data_values) {
			array[key][k] = [];
			for(k2 in data_values[k])
				array[key][k][data_keys[k2]] = data_values[k][k2];
		}

	}
	return array;
}

$(function() {
	$.ajaxSetup({
		accepts: {
			'jsonc': 'application/x-jsonc'
		},
		converters: {
			'text jsonc': jsonc_decode
		},
		dataType: 'jsonc'
	});
});