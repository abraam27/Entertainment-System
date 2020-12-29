$(document).ready(function(){
   $("#exampleInput").keyup(function(){
       // get data from input
       var code = $(this).val();
       // load ajax]
       $.ajax({
            url:"ta2reshaData.php?code="+code,
            success:function(data){
                $("#info").html(data);
            },
            error:function(data){
                $("#info").html(data);
            }
        });
   });
});
$(document).ready(function(){
   $(".productDiv").click(function(){
       // get data from input
       var productID = $(this).attr("value");
       // load ajax]
       $.ajax({
            url:"makeOrderData.php?productID="+productID,
            success:function(data){
                $("#info").html(data);
            },
            error:function(data){
                $("#info").html(data);
            }
        });
   });
});