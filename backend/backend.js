	teacherUnset	= true;
	subjectUnset	= true;
	szaehler = 1;
	tzaehler = 1;
	
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
			
			listContainer.appendChild(subject0);
			
			
			container.innerHTML 	+= '<input type="button" onclick="addSubject();" value="weiteres Fach">';
	}
	else if(selectSwitch == "2")
	{

			//selectionTop.innerHTML 	+= subjectSource.innerHTML;

			selectionTop.appendChild(subject0);

			listContainer.appendChild(teacher0);
			
			
			container.innerHTML 	+= '<input type="button" onclick="addTeacher();" value="weiterer Lehrer">';


	}

}
function addSubject()
{

		subject					= document.createElement('select');
		subject.id 				= 'id_subject'+szaehler;
		subject.name			= 'subject['+szaehler+']';
		subject.innerHTML		= subjectSource.innerHTML;
		
		document.getElementById('listContainer').appendChild(subject);
		szaehler++;
		
		

}
function addTeacher()
{
		teacher					= document.createElement('select');
		teacher.id 				= 'id_teacher'+tzaehler;
		teacher.name			= 'teacher['+tzaehler+']';
		teacher.innerHTML		= teacherSource.innerHTML;
		
		document.getElementById('listContainer').appendChild(teacher);
		tzaehler++;

}

function resetList()
{
	if(confirm('Reset?'))
	{
		document.getElementById('auswahl').disabled = "false";
		//window.location.reload();
		
	}

	
}
