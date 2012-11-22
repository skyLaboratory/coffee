	teacherUnset	= true;
	subjectUnset	= true;
	subjectzaehler = 1;
	teacherzaehler = 1;
	
function ordnung(auswahl)
{	
	container 		= document.getElementById('chooseContainer');
	teacherSource 	= document.getElementById('teacherSource');
	subjectSource 	= document.getElementById('subjectSource');
	disable('auswahl');
	
	if(auswahl == "1")
	{
			teacherTop 				= document.createElement('div');
			teacherTop.id 			= 'teacherList';
			teacherTop.className 	= 'selectTop';
			//teacherTop.innerHTML 	= 'Lehrer: ';
			teacherTop.innerHTML 	+= teacherSource.innerHTML;
			container.appendChild(teacherTop);
				
			
			subjectContainer		= document.createElement('div');
			subjectContainer.id 	= 'subjectContainer';
			subjectContainer.className 	= 'selectContainer';
			container.appendChild(subjectContainer);
			
			subject0				= document.createElement('div');
			subject0.id 			= 'subject0';
			subject0.innerHTML		= subjectSource.innerHTML;
			subjectContainer.appendChild(subject0);
			
			container.innerHTML 	+= '<input type="button" onclick="addSubject();" value="weiteres Fach">';
	}
	else if(auswahl == "2")
	{

			subjectTop 				= document.createElement('div');
			
			subjectTop.id 			= 'subjectList';
			subjectTop.className 	= 'selectTop';
			
			subjectTop.innerHTML 	= subjectSource.innerHTML;
			container.appendChild(subjectTop);
				
			
			teacherContainer		= document.createElement('div');
			teacherContainer.id 	= 'teacherContainer';
			teacherContainer.className 	= 'selectContainer';
			
			container.appendChild(teacherContainer);
			
			teacher0				= document.createElement('div');
			teacher0.id 			= 'teacher0';
			teacherContainer.appendChild(teacher0);
			teacher0.innerHTML		= teacherSource.innerHTML;
			
			container.innerHTML 	+= '<input type="button" onclick="addTeacher();" value="weiterer Lehrer">';
	
			subjectUnset = false;
	
			
		

	}

}
function addSubject()
{

		subjectContainer 	= document.getElementById('subjectContainer'); 
		newSubject 		= document.createElement('div');
		subjectContainer.appendChild(newSubject);
		newSubject.id	= 'subject'+subjectzaehler;
		newSubject.innerHTML = document.getElementById('subjectSource').innerHTML;
		subjectzaehler++;

}
function addTeacher()
{

		teacherContainer 	= document.getElementById('teacherContainer'); 
		newTeacher 		= document.createElement('div');
		teacherContainer.appendChild(newTeacher);
		newTeacher.id	= 'teacher'+teacherzaehler;
		newTeacher.innerHTML = document.getElementById('teacherSource').innerHTML;
		teacherzaehler++;

}
function disable(object)
{
	document.getElementById(object).disabled="true";
}

function resetList()
{
	if(confirm('Reset?'))
	{
		document.getElementById('auswahl').disabled = "false";
		//window.location.reload();
		
	}

	
}
