	teacherUnset	= true;
	subjectUnset	= true;
	szaehler = 1;
	tzaehler = 1;
	zaehler = Array();
	zaehler['teacher'] = 0;
	zaehler['subject'] = 0;
	
function ordnung()
{	
	selectSwitch	= document.getElementById('selectSwitch').selectedIndex;
	container		= document.getElementById('chooseContainer');
	selectionTop 	= document.getElementById('selectionTop');
	listContainer 	= document.getElementById('listContainer');
	teacherSource 	= document.getElementById('teacherlist');
	subjectSource 	= document.getElementById('subjectlist');
	
	document.getElementById('selectSwitch').disabled = 'true';

			hiddenSwitch			= document.createElement('input');
			hiddenSwitch.type 		= 'hidden';
			hiddenSwitch.name 		= 'switch';
			hiddenSwitch.value 		= selectSwitch;
			container.appendChild(hiddenSwitch);
			
			teacher0				= document.createElement('select');
			teacher0.id 			= 'id_teacher0';
			teacher0.name			= 'teacher[0]';
			teacher0.innerHTML		= teacherSource.innerHTML;
						
			subject0				= document.createElement('select');
			subject0.id 			= 'id_subject0';
			subject0.name			= 'subject[0]';
			subject0.innerHTML		= subjectSource.innerHTML;
			
	if(selectSwitch == "1")
	{
			
			//selectionTop.innerHTML 	+= document.getElementById('teacherSource').innerHTML;

			selectionTop.appendChild(teacher0);
			

			addNext('subject');
			
			container.innerHTML 	+= '<input type="button" onclick="addNext(\'subject\');" value="weiteres Fach">';
	}
	else if(selectSwitch == "2")
	{

			//selectionTop.innerHTML 	+= subjectSource.innerHTML;

			selectionTop.appendChild(subject0);

			addNext('teacher');
			
			container.innerHTML 	+= '<input type="button" onclick="addNext(\'teacher\');" value="weiterer Lehrer">';


	}

}

function addNext(sort)
{
		
		obj					= document.createElement('select');
		obj.id 				= 'id_'+sort+zaehler[sort];
		obj.name			= sort+'['+zaehler[sort]+']';
		obj.innerHTML		= document.getElementById(sort+'list').innerHTML;
		
		objOut				= document.createElement('p');
		objOut.appendChild(obj);
		
		document.getElementById('listContainer').appendChild(objOut);
		zaehler[sort]++;

}


function resetList()
{
	if(confirm('Reset?'))
	{
		//document.getElementById('auswahl').disabled = "false";
		//window.location.reload();
		
	}

	
}
