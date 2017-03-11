$('.carousel').carousel({
  interval: 2000
})
$("#message-close").click(function(e){
     $("#message").fadeOut('slow');
      e.preventDefault();
})
$(".contact_form").on("click","#send",function(e){
    e.preventDefault();
    var url=$(".contact_form").attr('action');
    //alert($(".contact_form").serialize());
    //exit(); 
    $.ajax({
        url:url,
        data:$(".contact_form").serialize(),
        method:"POST",
        datatype:"JSON",
        success:function(message){
           // alert("sdfsdaf");
            var message=$.parseJSON(message);
            $("#message").css("display","block");
            $("#message").attr("class","alert "+message.class)
            // $( "#message" ).addClass(message.class);
             $("#message p").html(message.data);
             if(message.status==1){
                 $('.contact_form')[0].reset();  
             }
         
            console.log(message);
            
        }
       
        
        
      
      
        
    })

    
    
})