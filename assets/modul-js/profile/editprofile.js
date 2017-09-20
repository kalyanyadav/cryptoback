var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() { 
            var fname=$("#fname").val();
            var lname=$("#lname").val();
            var gender=$("#gender").val();
            var email=$("#cemail").val();
            var mobile=$("#mobile").val();
            var phone=$("#phone").val();
            var address=$("#address").val();
            var city=$("#city").val();
            var state=$("#state").val();
            var country=$("#country").val();
            var zip=$("#zip").val();
            var dataString = 'fname='+fname+'&lname='+lname+'&email='+email+'&gender='+gender+'&mobile='+mobile+'&phone='+phone+'&address='+address+'&city='+city+'&state='+state+'&country='+country+'&zip='+zip;
           
             $.ajax({
                type: "POST",
                url: "/profile/edit/update",
                data: dataString,
                cache: false,
                beforeSend: function(){ 
                    $("#submitprofile").hide();
                    $("#waiting").show();
                    $("#suksesupdate").hide();
                    $("#gagalupdate").hide();
                },
                complete: function(e, xhr, settings){
                    if(e.status === 200){
                        $("#submitprofile").show();
                        $("#waiting").hide();
                        $("#suksesupdate").show();
                        //$("#gagalupdate").hide();
                    }else{
                        $("#submitprofile").show();
                        $("#waiting").hide();
                        //$("#suksesupdate").show();
                        $("#gagalupdate").show();
                    }
                }
                
            });
        
        return false;
        }
    });

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#editForm").validate();
    });


}();