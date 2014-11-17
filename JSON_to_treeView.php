<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>JSON to TreeView</title>

  <style type="text/css">

  </style>

  <script type="text/JavaScript">

  //This function reads the JSON file and calls function to convert JSON to HTML
  function read_json_file(url)
  {
	  if(typeof XMLHttpRequest != "undefined")
		  {
	        var xmlhttp = new XMLHttpRequest();
		  }
	  else if(typeof window.ActiveXObject != "undefined"){
	        try {
	        	xmlhttp = new ActiveXObject("Msxml2.XMLHTTP.4.0");
	        }
	        catch(e){
	            try {
	            	xmlhttp = new ActiveXObject("MSXML2.XMLHTTP");
	            }
	            catch(e){
	                try {
	                	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	                }
	                catch(e){
	                	xmlhttp = null;
	                }
	            }
	        }
	    }
	    xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
			{
		      var jsonArr = JSON.parse(xmlhttp.responseText);
	          var html = json_to_html(jsonArr);
		      var windowObjectReference;
              var strWindowFeatures = "menubar=yes,location=yes,resizable=yes,scrollbars=yes,status=yes";
              sessionStorage.setItem("sent", html);

              //The HTML form of the JSON is displayed as an interactive tree view in a new window
              windowObjectReference = window.open("TreeView.php", "TreeView", strWindowFeatures);
		   }
		}
		xmlhttp.open("GET", url, true);
		xmlhttp.send();
  
  }

  //This function converts the JSON object to HTML
  function json_to_html(json_arr) 
  {
	  if(Object.keys(json_arr)[0]!='html')
	  {
		  var out = '<ul>';
	  }
	  else
	  {
	    var out = '<ul id="LinkedList1" class="LinkedList">';
	  }
	    var count = 0;
	    Object.keys(json_arr).forEach(function (key) 
	    	    {
	               count++;
	               
	               if(typeof json_arr[key] != 'object')
	       			{
	            	    out += '<li class="text">' + key ;
	    	   			out += ' : '+json_arr[key] ;
	       			}
	      			else
		       		{
	      				out += '<li class="changecolour">' + key ;
			      		out+= json_to_html(json_arr[key]);  
		       		}
		       		out+='</li>';
	       
	    		});
	    out+='</ul>';
	    return out;
	}

  //Onload function which starts the convertion from JSON to HTML
  function start_convert() 
  {
    read_json_file('json_output.json');
  }

  </script>
</head>

<body onload="start_convert();">
<h2>View your JSON in 'TreeView' Format.</h2>
<p>Please wait till the tree view window opens....</p>
<div id="id01"></div>
</body>
</html>
