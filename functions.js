/**
 * Created by tarun on 11/17/15.
 */
function pstate(){
   var x =  document.getElementById('prop_st');
    var y = document.getElementById('prop_st_other');

    if(x.value === "Other"){
        y.style.display='';
    }else{
        y.style.display='none';
    }


}