/*
#	function addList(sort, sourceArray, position = 'listContainer')
#	sort: Gruppenname, sourceArray: Quellarray, position: ID des Parent
#
*/

	var zaehler = Array();

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


function optionAdd(array, parrentObjID)
{
	parrentObj = document.getElementById(parrentObjID);
	parrentObj.options[parrentObj.length] = new Option('-------', '0',true);
	for(key in array)
	{
		parrentObj.options[parrentObj.length] = new Option(array[key]['name'], array[key]['id']);
	}
}

function resetList()
{
	if(confirm('Reset?'))
	{
		
	}

	
}
