/**
 * Created by josedlpozo on 4/4/15.
 */
function sendEmail(){

    document.getElementById("link").href = "mailto:josedlpozo@gmail.com?Subject="+document.getElementById("subject_email").value
    +"&Body="+ document.getElementById("text").value +" Mensaje de : "+document.getElementById("email_user").value;

}