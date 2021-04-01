$(document).ready(function (e) {
    //initialize datapicker
    $('#from_short_date').datetimepicker({
        pickTime: false,
        format: "yyyy-MM-dd"
    });
    $('#to_short_date').datetimepicker({
        pickTime: false,
        format:"yyyy-MM-dd"

    });

    $("#form").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "upload.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                //$("#preview").fadeOut();
                $("#err").fadeOut();
            },
            success: function (data) {

                $("#success").css("display", "block");
                $("#success").html("loaded sucessfully").fadeIn();
                setTimeout(() => {
                    $("#success").css("display", "none");
                }, 1000);
            },
            error: function (e) {
                $("#err").html(e).fadeIn();
            }
        });
    }));
    $("#filter_option").on("change",function(){
        var selectoption=$("#filter_option").val();
        if(selectoption=="employee_name" || selectoption=="event_name" ){
            $("#date_filter").css("display","none");
            $("#text_filter").css("display","block");
        }
        else{
            
            $("#text_filter").css("display","none");
            $("#date_filter").css("display","block");
        }
    });
});