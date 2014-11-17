<?php

//Function to get the contents of an attribute of an HTML tag
function get_attribute_contents($element)
{
	$obj_attribute = array();
	foreach ($element->attributes as $attribute) {
		$obj_attribute[$attribute->name] = $attribute->value;
	}
	return $obj_attribute;
}

//Function to get contents of a child element of an HTML tag
function get_child_contents($element)
{
	$obj_child = array();
	foreach ($element->childNodes as $subElement) {
	if ($subElement->nodeType != XML_ELEMENT_NODE) {
		if(trim($subElement->wholeText) != "")
		{
		$obj_child["value"] = $subElement->wholeText;
		}
	}
	else {
		if($subElement->getAttribute('id'))
		{
		$obj_child[$subElement->tagName."#".$subElement->getAttribute('id')] = get_tag_contents($subElement);
		}
		else 
		{
			$obj_child[$subElement->tagName] = get_tag_contents($subElement);
		}
	}
		}
	return $obj_child;
}

//Function to get the contents of an HTML tag
function get_tag_contents($element)
{
	$obj_tag = array();
	    if(get_attribute_contents($element))
	    {
		$obj_tag["attributes"] = get_attribute_contents($element);
	    }
	    if(get_child_contents($element))
	    {
		$obj_tag["child_nodes"]= get_child_contents($element);
	    }

	return $obj_tag;
}

//Function to convert a DOM element to an object
function element_to_obj($element) {
	$object = array();
	$tag = $element->tagName;
	$object[$tag] = get_tag_contents($element);
    return $object;
}

//Function to convert an HTML to a DOM element
function html_to_obj($html) {
	$dom = new DOMDocument();
	$dom->loadHTML($html);
	$docElement=$dom->documentElement;
	return element_to_obj($dom->documentElement);
}



//Reading the contents of an HTML file
$html = file_get_contents('http://testing.moacreative.com/job_interview/php/index.html');
header("Content-Type: text/plain");

//Coverting the HTML to JSON
$output = json_encode(html_to_obj($html));

//Writing the JSON output to an external file
$file = fopen("json_output.json","w");
fwrite($file,$output);
fclose($file);

echo "HTML to JSON conversion has been completed.\n";
echo "Please refer to json_output.json to view the JSON output.";


?>