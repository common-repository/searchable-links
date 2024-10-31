window.onload = namesSearch;

function namesSearch() {
	var div = document.getElementsByTagName("span");
	var divlength = div.length;
	var x = 0;
	
	while (x<divlength)	{
		if (div[x].className!="searchOne") {
			if (div[x].className!="searchTwo") {
				x++;
				continue;
				} else {
				var dir = div[x];
				var value = div[x].innerHTML;
			}
		var names = value.split(",");

	dir.innerHTML = "";
	var i = 0;

	while (i<names.length) {
		var comma = ", ";
		if (i == names.length-1) {
		var comma = "";
		}

		var addresult = document.createTextNode(names[i]);
		var addcomma = document.createTextNode(comma);
		var link = document.createElement("a");
		var indnames = names[i].split(" ");

		var j = 0;
		var searchnames = "";
		var plus = "=";

		while (j<indnames.length) {
			if (j!=0) {
			plus = "+";
			}
			searchnames = searchnames + plus + indnames[j];
			j++;
			}

		var search = "index.php?s";
		searchnames = search + searchnames;

		link.setAttribute("href",searchnames);
		link.appendChild(addresult);
		dir.appendChild(link);
		dir.appendChild(addcomma);
		i++;	
	}		

		x++;
		continue;
		} else {
		var dir = div[x];
		var value = div[x].innerHTML;
		}
	
		var names = value.split(",");

	dir.innerHTML = "";
	var i = 0;

	while (i<names.length) {
		var comma = ", ";
		if (i == names.length-1) {
		var comma = "";
		}

		var addresult = document.createTextNode(names[i]);
		var addcomma = document.createTextNode(comma);
		var link = document.createElement("a");
		var indnames = names[i].split(" ");

		var j = 0;
		var searchnames = "";
		var plus = "=";

		while (j<indnames.length) {
			if (j!=0) {
			plus = "+";
			}
			searchnames = searchnames + plus + indnames[j];
			j++;
			}

		var search = "index.php?s";
		searchnames = search + searchnames;

		link.setAttribute("href",searchnames);
		link.appendChild(addresult);
		dir.appendChild(link);
		dir.appendChild(addcomma);
		i++;	
	}		
		x++;
	}
	return false;
}