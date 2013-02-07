function load(target)
{
	 var url = "app="+target
	 $.ajax({
	 	 type : "POST",
		 url  : "data/ajax.php",
		 data : url,
		 success: function(data){var data = JSON.parse(data); var content = parseFormJson(data);$("#content").html(content);}
	 });
}

function backToHome()
{
	$("#content").animate({opacity : 0}, 300);
	$("#content").css("display","none");
	$("#content").css("background-color","white");
	$("#content").removeClass("ajax");
	$("#content-home").css("display","block");
	$("#content-home").animate({opacity : 1}, 1000);
}	


function fadeInContent(color,target)
{
	$("#content-home").animate({opacity : 0}, 300);
	$("#content-home").css("display","none");
	$("#content").css("display","block");
	$("#content").addClass("ajax");
	load(target);
	$("#content").animate({backgroundColor: color, opacity : 1},1000);
}

function parseFormJson(data)
{
	var content = createContainer("div","ajax-content","ajax-content",false,"ajax-content");
	var tmp;
	var sub;
	
	for(key in data)
	{
		var cElement = data[key];
		alert(cElement.type);
		tmp	= createFormElement(cElement.type,cElement.objType,cElement.name,cElement.id,cElement.value,cElement.cssClass,cElement.method);
		for(subKey in cElement.sub)
		{
			var cSubElement = cElement.sub[subKey];
			sub = createFormElement(cSubElement.objType,cSubElement.type,cSubElement.name,cSubElement.id,cSubElement.value,cSubElement.cssClass,cSubElement.method)
			tmp.appendChild(sub);
		}
		content.appendChild(tmp);
	}
	delete(key);
	return content;
}

function createFormElement(objType,type,name,id,value,cssClass, method = false)
{
	var tmpObj			= document.createElement(objType);
	tmpObj.type 		= type;
	tmpObj.name			= name;
	tmpObj.id			= id;
	tmpObj.value		= value;
	tmpObj.className	= cssClass;
	if(method)
	{
		tmpObj.method	= method;
	}
	
	return tmpObj;
}


/**
 * createContainer function.
 * create a Container Object from the given args
 * @access public
 * @param mixed type
 * @param mixed setID
 * @param bool setName (default: false)
 * @param bool content (default: false)
 * @param bool cssClass (default: false)
 * @return container Object
 */
function createContainer(type, setID, setName = false, content = false, cssClass = false)
{
	// Creating an Element
	var tmp	= document.createElement(type);
	// Set Object different Names and IDs when is is nessesary
	if(setID.length)
	{
		if(setName)
		{
			tmp.name	= setName;
			tmp.id		= setID;
		}
		else
		{
			tmp.id		= setID;
			tmp.name	= setID;
		}
	}
	// Adding content to the Object
	if(content)
	{
		tmp.innerHTML += content;
	}
	// Adding a css class to the Object
	if(cssClass)
	{
		tmp.className = cssClass;
	}
	
	return tmp;
}