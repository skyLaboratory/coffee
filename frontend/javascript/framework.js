function load(target)
{
	$.getJSON(target,function(data){parser(data);});
}

function backToHome()
{
	$("#content").animate({opacity : 0}, 300);
	$("#content").css("display","none");
	$("#content").css("background-color","white");
	$("#content-home").css("display","block");
	$("#content-home").animate({opacity : 1}, 1000);
}	


function fadeInContent(color,target)
{
	$("#content-home").animate({opacity : 0}, 300);
	$("#content-home").css("display","none");
	$("#content").css("display","block");
	$("#content").animate({backgroundColor: color, opacity : 1},1000);
}

function parser(data)
{
	
	document.getElementById("content-home").style.display = "none";

	
	var content		= createContainer("div","ajax-container");
	var headline 	= createContainer("h1","h1",false,data.title);
	content.appendChild(headline);
	
	for(key in data.content)
	{
		var pContainer	= createContainer("div", data.content[key].id, data.content[key].name, false, data.content[key].className);
		var pHeadline 	= createContainer("h2", "", "", data.content[key].title);
		var pContent	= createContainer("p", "","",data.content[key].content);

		pContainer.appendChild(pHeadline);
		pContainer.appendChild(pContent);
		
		content.appendChild(pContainer);
		
		delete(pContainer);
		delete(pHeadline);
		delete(pContent);
	}
	
	$("#content").html(content);
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