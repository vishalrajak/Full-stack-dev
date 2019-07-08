var status=0;//for add more question  if alreading adding set to 1
var noptions=1;
function show(){
	
	document.getElementById('main').style.opacity="0.4";
	soption();
}

function soption(){
	var op=document.getElementById('options');
  	op.innerHTML='<div ><input type="radio" name="mc" id="option1" /><label for="option1"></label><input type="text"   required /><button onclick="removeOptions(this);" class="btn">-</button></div>';
      var newItem = document.createElement("button");
    var textnode = document.createTextNode("Add more options");
    newItem.appendChild(textnode);
     document.getElementById('box').insertBefore(newItem,document.getElementById('add-elem'));
     newItem.classList.add("btn");
     newItem.setAttribute("onclick","return addOptions();");
     newItem.setAttribute("id","addoption");
     //document.getElementById('question').focus();
     status=1;
}

function removeOptions(e){
	var parent=e.parentNode.parentNode;
if(e.innerHTML=="Delete"){
var index=e.parentNode.id;
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                parent.innerHTML+=this.responseText;//field for question deleted message for future editing
            }
        };
        xmlhttp.open("POST","delques.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("index="+index);
}
parent.removeChild(e.parentNode);

return false;
}

function addOptions(){
var op=document.getElementById('options');
var div=document.createElement("div");
op.appendChild(div);
var radio=document.createElement("input");
radio.setAttribute("type","radio");
radio.setAttribute("name","mc");
noptions+=1;
radio.setAttribute("id","option"+noptions);
div.appendChild(radio);
var label=document.createElement("label");
label.setAttribute("for","option"+noptions);
div.appendChild(label)
var input=document.createElement("input");
input.setAttribute("type","text");
input.required="true";
var btn=document.createElement("button");
btn.appendChild(document.createTextNode("-"));
btn.setAttribute("onclick","removeOptions(this);");
btn.classList.add("btn");
div.appendChild(input);
div.appendChild(btn);
return false;
}

function cancel(){
	document.getElementById('question').value="";
	var parent=document.getElementById('options');
	var len=parent.childElementCount;
	for(var i=0;i<len;i++){
		parent.removeChild(parent.children[0]);
	}
	  document.getElementById('box').removeChild(document.getElementById('addoption'))
   document.getElementById('main').style.opacity="1";
    document.getElementById('add-elem').value="Add Question";
     document.getElementById('add-elem').removeAttribute("onclick");
   status=0;
   noptions=1;
}

$(document).delegate("#form1","submit",function(){
	var parent=document.getElementById('box');//dialogue box for question
	var ogparent=document.getElementById('main');//visible question list
	var options=document.getElementById('options');//options in dialogue box
	var cans=-1;
	for(i=0;i<options.childElementCount;i++){
		if(options.children[i].children[0].checked){
          cans=i;
          break;
		}
	}
	if(cans==-1)
	{
		alert("please select correct option");
		return false;
	}
	var details=new Array();
	details.push(cans);//ans index 0-indexing
	var block=document.createElement("div");
	block.classList.add("list");
	var close=document.createElement("a");
	close.appendChild(document.createTextNode("Delete"));
	close.style.cssFloat="right";
	close.setAttribute("href","#");
  close.setAttribute("class","btn");
	close.setAttribute("onclick","return removeOptions(this);");
	block.appendChild(close);
	var question=document.createElement("p");
	question.innerHTML=parent.children[0].value;//question
	var button=document.createElement("button");
  button.innerHTML="Edit";
  button.classList.add("btn","update");
	details.push(parent.children[0].value);
  block.appendChild(button);
  block.appendChild(question);
	for(var i=0;i<options.childElementCount;i++)
		{
			var radio=document.createElement("input");
			radio.setAttribute("type","radio");
      radio.setAttribute("id","ooption"+(i+1));//ooption refers to options displayed to user after add question
			var option=document.createElement("label");
      option.setAttribute("for","ooption"+(i+1))
			option.innerHTML=options.children[i].children[2].value;//options
			details.push(options.children[i].children[2].value);
			block.appendChild(radio);
			block.appendChild(option);
			block.appendChild(document.createElement("br"));
			if(i==cans){
				radio.setAttribute("checked","checked");
      }
      else{
      radio.setAttribute("disabled","disabled");
    }
		}
    block.appendChild(document.createElement("br"));

		//ajax call for saving to database
		var qno;
       var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                //field for question added message for future editing
                     qno=this.responseText;
                     //console.log(qno);
                     addAttributes(radio,block,qno);          
            }
        };
        xmlhttp.open("POST","addques.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("details="+JSON.stringify(details));
        


	ogparent.appendChild(block);
	cancel();

	$('#myModal').modal('close');
  Materialize.toast('<i class="material-icons dp48">check</i>Changes Saved!', 2000);

	 return false;
});

$(document).delegate("#add","click",function(event){
    	event.preventDefault();
      if(status!=0){
		return false;
	}
        $('#myModal').modal('open');
        show();
        return false;
});

$(document).delegate("#cancel","click",function(){
              cancel();
             $('#myModal').modal('close');
                return false;

    });


function loadQuestions(){
 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          document.getElementById("loading").style.display="none";
            if (this.readyState == 4 && this.status == 200) {
              document.getElementById("main").innerHTML=this.responseText;
              
            }
        };
        xmlhttp.open("GET","load-preview.php", true);

        xmlhttp.send();	
}



function addAttributes(radio,block,qno){//function to add name to radio and add id i.e question no to block div
var length=block.childElementCount-1;
for(var i=3;i<length;i=i+3){
 (block.children[i]).setAttribute("name","anslist"+qno);
  block.children[i].id+=qno;
  //console.log("done");
  block.children[i+1].setAttribute("for",block.children[i+1].getAttribute("for")+qno);
}
         block.setAttribute("id",qno);

}




$(document).delegate(".update","click",function(){
editQuestion(this);
$('#myModal').modal('open');
});



function editQuestion(e){
  document.getElementById("loading").style.display="block";
	var id=e.parentNode.id;
  var xmlhttp = new XMLHttpRequest();
  var question=new Array();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            document.getElementById("loading").style.display="none";
              question=JSON.parse(this.responseText);
              //console.log(question);
              var coption=parseInt(question[question.length-1]);
              document.getElementById('question').value=question[0];
     var options=document.getElementById('options');
     for(var i=1;i<question.length-1;i++){
     	console.log(question[i]);
     	if(i==coption+1){
      options.innerHTML+='<div><input type="radio" name="mc" id="option'+i+'" checked="checked"/><label for="option'+i+'"></label><input type="text"  required value="'+question[i]+'"/><button onclick="removeOptions(this);" class="btn">-</button></div>';
     	}
     	else
      {options.innerHTML+='<div><input type="radio" name="mc" id="option'+i+'"/><label for="option'+i+'"></label><input type="text"  required value="'+question[i]+'"/><button onclick="removeOptions(this);" class="btn">-</button></div>';
      }
     }
     document.getElementById('add-elem').value="Update";
     document.getElementById('add-elem').setAttribute("onclick","updateQuestion("+id+")");
         var newItem = document.createElement("button");
    var textnode = document.createTextNode("Add more options");
    newItem.appendChild(textnode);
     document.getElementById('box').insertBefore(newItem,document.getElementById('add-elem'));
     newItem.classList.add("btn");
     newItem.setAttribute("onclick","return addOptions();");
     newItem.setAttribute("id","addoption");
     noptions=parseInt(document.getElementById("options").childElementCount);


              
            }
       };
        xmlhttp.open("GET","get-ques.php?id="+id, true);

        xmlhttp.send();
     
}



function updateQuestion(id){
var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          document.getElementById('main').removeChild(document.getElementById(id));
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
              
              
            }
        };
        xmlhttp.open("GET","update-ques.php?id="+id, true);

        xmlhttp.send();
        

}

function showPassBox(e){
  if(e.value=="1" && e.checked){
    document.getElementById("pass-box").style.display="block";
    document.getElementById("pass-box").required=true;
  }
  else{
   document.getElementById("pass-box").style.display="none";
    document.getElementById("pass-box").required=false; 
  }
}