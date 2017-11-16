document.getElementById('mainFrame').onload = function()
{
    addDots();
}

// function injected_main() {
// 	// var iframe = top.frames[0].document.querySelectorAll('td.left')[0];
// 	// iframe.addEventListener('click', function () {
// 	//     setTimeout(addDots, 1000);
// 	// });
// 	//addDots();
// }

function addDots() {
	c = document.getElementById('mainFrame').contentWindow.c;
	v = document.getElementById('mainFrame').contentWindow.v;
	var obj = top.frames[1].document.querySelectorAll('form')[0];
	var td = top.frames[1].document.querySelectorAll('form table td');
	if(v == undefined) {
		for(i=0; i < c; ++i) {
			if(obj.elements[2*i].value==1) {
				var d=document.createElement('i');
				d.style.color='#eee';
				d.innerHTML = ".";
				td[4*i+2].appendChild(d);
			}
		}
	}
	else {
		for(i=0; i < c; ++i) {
			if(v[i]==1) {
				var d=document.createElement('i');
				d.style.color='#eee';
				d.innerHTML = ".";
				td[4*i+2].appendChild(d);
			}
		}
	}
}