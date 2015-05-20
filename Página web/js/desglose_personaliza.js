/**
 * Created by josedlpozo on 30/3/15.
 */
function desglose(){
    console.log("desglose");
    $("#text").html("");
    var sensores =[];
    sensores.push($("#basico"),$("#solar"),$("#bateria"),$("#mcp"),$("#basico_moto"),$("#gps"),
        $("#rf"),$("#rf_sup"),$("#infra"));
    var i;
    var suma = 0;
    for(i=0;i<sensores.length;i++){
        console.log("for");
        console.log(sensores[i].prop("checked"));
        if(sensores[i].prop("checked")){
            $("#text").html($("#text").html() + " "+ sensores[i].attr("name")+ " - " +sensores[i].attr("value")+"€\<br\>");
            suma += (+sensores[i].attr("value"));
            console.log("for-checked");
        }
    }
    $("#text").html($("#text").html() + "\<br\>"+"Suma : "+suma+" €");
}