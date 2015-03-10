alert('formeORpanne Test');
var element = document.getElementsByClassName('formeORpanne');

for (var i = 0; i < element.length; i++) {
  if(element[i] >= 0){	
    element[i].style.color = 'green';
  }
  else{
  	element[i].style.color = 'red';
  }  	
}