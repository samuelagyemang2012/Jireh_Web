/**
 * Created by samuel on 5/22/2017.
 */


function validate(name, id, min) {
    var input = $("#" + name);

    var data = input.val();
    var span = $("#" + id);

    var m = parseInt(min);

    if (data.length < min) {
        input.css('border', '1px solid red');
        span.html("<b style='color: crimson'>Minimum: " + m + "</b>");
    } else {
        input.css('border', '1px solid #5FFC3F');
        span.html('<b></b>');
    }
}
