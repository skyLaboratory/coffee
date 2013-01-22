/*
#	function addList(sort, sourceArray, position = 'listContainer')
#	sort: Gruppenname, sourceArray: Quellarray, position: ID des Parent
#
*/

var zaehler = Array();
var counter = 1;
function ordnung()
{	
	selectSwitch	= document.getElementById('selectSwitch').selectedIndex;
	container		= document.getElementById('chooseContainer');
	selectionTop 	= document.getElementById('selectionTop');
	listContainer 	= document.getElementById('listContainer');
	
	document.getElementById('selectSwitch').disabled = 'true';

	hiddenSwitch			= document.createElement('input');
	hiddenSwitch.type 		= 'hidden';
	hiddenSwitch.name 		= 'switch';
	hiddenSwitch.value 		= selectSwitch;
	container.appendChild(hiddenSwitch);
			
	if(selectSwitch == "1")
	{
		addList('teacher', teacherList, position = 'selectionTop');
		addList('subject', subjectList);
		container.innerHTML 	+= '<input type="button" onclick="addList(\'subject\',subjectList);" value="weiteres Fach">';
	}
	else if(selectSwitch == "2")
	{
		addList('subject',subjectList, position = 'selectionTop');
		addList('teacher', teacherList);	
		container.innerHTML 	+= '<input type="button" onclick="addList(\'teacher\',teacherList);" value="weiterer Lehrer">';
	}

}

function addList(sort, sourceArray, position = 'listContainer')
{
		if(!zaehler[sort]) 
		{
			zaehler[sort] = 0;
		}
			
		obj					= document.createElement('select');
		obj.id 				= 'id_'+sort+zaehler[sort];
		obj.name			= sort+'['+zaehler[sort]+']';
		
		objOut				= document.createElement('p');
		objOut.appendChild(obj);
		document.getElementById(position).appendChild(objOut);
		optionAdd(sourceArray, obj.id);
		zaehler[sort]++;

}


function newRoomChangeField()
{
	var container;
	var placeholder;
	
	placeholder		= document.createElement("span");
	placeholder.innerHTML += " ------> ";
	
	if(!counter)
	{
		counter = 0;
	}
	container		= document.createElement('div');
	container.id	= counter;
	container.name	= counter;
	
	document.getElementById("roomPlan").appendChild(container);
	
	addRoomList(rooms,"from["+counter+"]",container.id);
	document.getElementById(container.id).appendChild(placeholder);
	addRoomList(rooms,"to["+counter+"]",container.id);
	counter++;
}


function addRoomList(sourceArray,id,position)
{
	var obj;
	var objOut;
	obj			= document.createElement('select');
	obj.id		= id;
	obj.name	= id;
	
	document.getElementById(position).appendChild(obj);
	optionAdd(sourceArray, obj.id);
	
}

function safe()
{
	document.getElementById("roomPlan").submit();
}


function optionAdd(array, parrentObjID)
{
	parrentObj = document.getElementById(parrentObjID);
	parrentObj.options[parrentObj.length] = new Option('-------', '0',true);
	for(key in array)
	{
		if(array[key]['vorname'])
			parrentObj.options[parrentObj.length] = new Option(array[key]['vorname']+" "+array[key]['name'], array[key]['id']);
		else
			parrentObj.options[parrentObj.length] = new Option(array[key]['name'], array[key]['id']);

	}
}

function resetList()
{
	if(confirm('Reset?'))
	{
		
	}

	
}
