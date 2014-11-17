<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title>TreeView</title>

  <style type="text/css">
  p 
  {
    font-size: 120%;
    font-weight:bold;
    color: rgb(2,25,98);
    border-bottom: thin dotted #369;
  }
  
  li { cursor: pointer; cursor: hand; }
  
  .text 
  { 
    cursor : default; 
  }
  
  ul.LinkedList,ul.LinkedList ul 
  { 
    list-style-type: none; 
    margin:0; 
    padding:0; 
  } 
  
  ul.LinkedList ul 
  { 
    margin-left:10px; 
    background: url(images/vline.png) repeat-y; 
  } 
  
  ul.LinkedList li 
  { 
    margin:0; 
    padding:0 12px; 
    font-size:14px;  
    line-height:20px; 
    color:#369; 
    font-weight:bold; 
  } 

 ul.LinkedList ul li 
 { 
    background: url(images/node.png) no-repeat; 
 } 

 ul.LinkedList ul li.last, 
 ul.LinkedList ul li:last-child,
 ul.LinkedList li
 { 
    background: #fff url(images/lastnode.png) no-repeat; 
 } 

  </style>

  <script type="text/JavaScript">

  
    // This function is called on loading of the page
    function addEvents() 
    {
    	var html=sessionStorage.getItem("sent");
        document.getElementById("id01").innerHTML = html;
        activateTree(document.getElementById("LinkedList1"));
    }

    
    // This function traverses the list and add links 
    // to nested list items
    function activateTree(list) 
    {
      // Collapse the tree
      for (var i=0; i < list.getElementsByTagName("ul").length; i++) 
          {
    	  	list.getElementsByTagName("ul")[i].style.display="none";            
     	  }                                                                  
      // Add the click-event handler to the list items
      if (list.addEventListener) 
          {
    	  	list.addEventListener("click", toggleBranch, false);
      	  } 
  	  else if (list.attachEvent)   // For IE
  	  	  { 
    	  	list.attachEvent("onclick", toggleBranch);
      	  }
      // Make the nested items look like links
      addLinksToBranches(list);
    }

    
    // This is the click-event handler
    function toggleBranch(event) 
    {
      var branch, subBranches;
      if (event.target) 
          {
    	    branch = event.target;
          } 
      else if (event.srcElement) 
          { // For IE
    	    branch = event.srcElement;
      	  }
      subBranches = branch.getElementsByTagName("ul");
      if (subBranches.length > 0) 
          {
        	if (subBranches[0].style.display == "block") 
            	{
          			subBranches[0].style.display = "none";
       			} 
   			else 
   	   			{
          			subBranches[0].style.display = "block";
        		}
      	  }
    }

    // This function makes nested list items look like links
    function addLinksToBranches(list) 
    {
      var branches = list.getElementsByTagName("li");
      var i, n, subBranches;
      if (branches.length > 0) 
          {
        	for (i=0, n = branches.length; i < n; i++) 
            	{
          			subBranches = branches[i].getElementsByTagName("ul");
          			if (subBranches.length > 0) 
              			{
            				addLinksToBranches(subBranches[0]);
            				branches[i].className = "HandCursorStyle";
            				branches[i].style.color = "blue";
            				subBranches[0].style.color = "black";
            				subBranches[0].style.cursor = "auto";
          				}
        		}
      	  }
    }
  </script>
</head>

<body onload="addEvents();">
<p>Please click on the tag names to toggle...</p>
<div id="id01">
</div>
</body>
</html>
