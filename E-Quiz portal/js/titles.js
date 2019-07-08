

function deleteTest(e){
var formno=e.parentNode.id;
 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
              if(this.responseText=="1"){
              	e.parentNode.parentNode.removeChild(e.parentNode);
              	 Materialize.toast('<i class="material-icons dp48">check</i>Changes Saved!', 2000);

              }
              else if(this.responseText=="0"){
              Materialize.toast('<i class="material-icons dp48">warning</i>Something Went Wrong!', 2000);              	
              }      
            }
        };
        xmlhttp.open("POST","del-test.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("formn="+formno);
}


function changeStatus(e){
	var formno=e.parentNode.id;
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
              if(this.responseText=="1"){
              
              	if(e.innerText==="OPEN"){
              		e.innerText="CLOSE";
              		Materialize.toast('<i class="material-icons dp48">check</i>Test Status Changed To Open!', 2000);
              	}
              	else{
                   e.innerText="OPEN";
                   Materialize.toast('<i class="material-icons dp48">check</i>Test Status Changed To Closed!', 2000);
              	}

              	 
              	
              	
              }
              else if(this.responseText=="0"){
              Materialize.toast('<i class="material-icons dp48">warning</i>Something Went Wrong!', 2000);              	
              }      
            }
        };
        xmlhttp.open("POST","update-status.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("formn="+formno);
}
