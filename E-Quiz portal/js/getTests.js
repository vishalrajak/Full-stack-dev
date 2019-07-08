 function reset(event) {
 //console.log("lol");
        document.getElementById('select-professor').selectedIndex=0;

}

$(document).ready(function(){
    if($('#list-test').length==1){
  var professor=document.getElementById("linuser").value;
    //alert(professor);
    //console.log(professor);

    if(document.getElementById("select_test")!=null){
document.getElementById("select_test").style.display="none";
}
  document.getElementById("loading").style.display="block";
  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var tests=JSON.parse(this.responseText);
                if(document.getElementById("select_test")!=null){
                 document.getElementById("select_test").style.display="block";
                }
             document.getElementById("loading").style.display="none";
                //console.log(tests);
                var parent=document.getElementById("list-test");
                parent.innerHTML="<option disabled selected value='0'>Select Test</option>";
                for(var i=0;i<tests.length;i++){
                  var option=document.createElement("option");
                  option.setAttribute("value",tests[i][0]);
                  option.setAttribute("name","test");
                  option.setAttribute("data-status",tests[i][2]);
                  option.innerHTML=tests[i][1];
                  parent.appendChild(option);
                  //console.log(option);
            
                }
               $('select').material_select();
            }
        };
        xmlhttp.open("GET","get-test.php?name="+professor, true);
        xmlhttp.send();
    }
    else{
         $('select').material_select('destroy');
    }
});



function getDetails(fno){
     document.getElementById("test-table").style.display="none";
  document.getElementById("loading").style.display="block";
 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("test-table").style.display="table";
  document.getElementById("loading").style.display="none";
             document.getElementById("test-table").innerHTML=this.responseText;                

            }
        };
        xmlhttp.open("GET","get-students.php?fno="+fno, true);
        xmlhttp.send();   
}




$(document).ready(function(){
  $('#select-prof-div').on('change','select',function(){

  var professor=document.getElementById("select-professor").value;
    //alert(professor);
    //console.log(professor);

    if(document.getElementById("select_test")!=null){
document.getElementById("select_test").style.display="none";
}
  document.getElementById("loading").style.display="block";
  var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var tests=JSON.parse(this.responseText);
                if(document.getElementById("select_test")!=null){
                 document.getElementById("select_test").style.display="block";
                }
             document.getElementById("loading").style.display="none";
                //console.log(tests);
                var parent=document.getElementById("test-list");
                parent.innerHTML="<option disabled selected value='0'>Select Test</option>";
                for(var i=0;i<tests.length;i++){
                  var option=document.createElement("option");
                  option.setAttribute("value",tests[i][0]);
                  option.setAttribute("name","test");
                  option.setAttribute("data-status",tests[i][2]);
                  option.innerHTML=tests[i][1];
                  parent.appendChild(option);
                  //console.log(option);

            
                }

               $('#test-list').material_select();
            }
        };
        xmlhttp.open("GET","get-test.php?name="+professor, true);
        xmlhttp.send();

  });
    
});

$(document).ready(function(){
  //alert("lol");
 $('select').material_select();
});



$(document).delegate('#join','change',function(){
  
  var val=parseInt($(this).val());
  //alert(val);
var pass=document.getElementById("pass");
  pass.innerHTML="";
  pass.innerHTML="<option selected disabled value='0'>Choose...</option>";
  for(var i=val+4;i<=val+10;i++){
    //console.log(i);
    pass.innerHTML+="<option value="+i+">"+i+"</option>";
  }
  $('#pass').material_select();

});

function showPassword(){
document.getElementById("give-test").style.display="none";
var status=document.getElementById("test-list").options[document.getElementById("test-list").selectedIndex].getAttribute("data-status");
//alert(status);
if(status=="1"){
  document.getElementById("test-verification").innerHTML="<input type='password' id='verify-pass' name='nverify-pass' /><label>Test Password</label><button class='btn' onclick='verifyPass(this)'>Verify</button>";

}
else if(status=="0"){
document.getElementById("test-verification").innerHTML="";

var prof=document.getElementById("select-professor").value;
  var formn=document.getElementById("test-list").value;
  
 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
           document.getElementById("loading").style.display="block";
                 document.getElementById("give-test").style.display="none";
            if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText);
              if(this.responseText=="-1"){
                 //console.log(this.responseText);  
                  document.getElementById("loading").style.display="none";
                 document.getElementById("give-test").style.display="inline";
                 Materialize.toast('<i class="material-icons dp48">check</i>Verified For Test With No Password', 2000);

              }
              else{
                document.getElementById("loading").style.display="none";
              Materialize.toast('<i class="material-icons dp48">check</i>Not Verified', 2000);
              }
            }
        };
        xmlhttp.open("POST","test-pass-verify.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("formn="+encodeURIComponent(formn)+
              "&professor="+encodeURIComponent(prof));



}
}
  
 function verifyPass(e){
  var prof=document.getElementById("select-professor").value;
  var formn=document.getElementById("test-list").value;
  var pass=document.getElementById("verify-pass").value;
  if(pass!==""){
    //console.log("if");
document.getElementById("loading").style.display="block";
document.getElementById("give-test").style.display="none";
 var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              //console.log(this.responseText);
              if(this.responseText=="1"){
                var parent=e.parentNode;
                parent.removeChild(parent.children[0]);
                parent.removeChild(parent.children[0]);
                parent.removeChild(e);
                parent.innerHTML+="<span><i class='material-icons dp48'>check</i>Verified</span>";
                 Materialize.toast('<i class="material-icons dp48">check</i>Verified', 2000);
                 document.getElementById("loading").style.display="none";
                 document.getElementById("give-test").style.display="inline";

              }
              else if(this.responseText=="0"){
              document.getElementById("loading").style.display="none";
              Materialize.toast('<i class="material-icons dp48">close</i>Wrong Password!', 2000);               
              }      
            }
        };
        xmlhttp.open("POST","test-pass-verify.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("formn="+encodeURIComponent(formn)+
              "&professor="+encodeURIComponent(prof)+
              "&nverify-pass="+encodeURIComponent(pass) );


  }
  else{
    //console.log("else");
     
     Materialize.toast('<i class="material-icons dp48">close</i>Enter Password Please!', 3000);
    return;
  }
 }