/**
 * Created by samuel on 5/22/2017.
 */


function validate(name) {
    var input = $("#" + name);

    var data = input.val();

    if (data.length === 0) {
        input.css('border', '1px solid red');
    }else{
        input.css('border', '1px solid #5FFC3F');
    }
    //alert("bandbsambdsanda");
}
