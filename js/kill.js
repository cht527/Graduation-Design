function switchkill(target){
   var kill;
   if(target=='one'){
    
     window.location.href="../main.php?kill="+"kill1";
   }
   else if(target=='two'){
    window.location.href="../main.php?kill="+"kill2";
   }
   else if(target=='both'){
    window.location.href="../main.php?kill="+"kill3";

   }
    else{
	alert("操作错误");
	}
  }
