
var  email    = localStorage.getItem('email');
var  password = localStorage.getItem('password');
var  Auth_Id  = localStorage.getItem('auth');


$('document').ready(function(){
                if(Auth_Id !=null){console.log("info "+Auth_Id+"---");}
               /***************************************************/     
                if(Auth_Id==null){$('#navigation').slideUp(2);}
               /***************************************************/
               $("#email").val(email); 
               $("#password").val(password); 
               var emailx    = $("#email").val();
               var passwordx = $("#password").val();
               /***************************************************/
                    $('.btn').click(function(){
                         event.preventDefault();
                         $.ajax({
                              method:"POST",
                              url:EndLogin,
                              data:{
                                        email:     $("#email").val(),
                                        password:  $("#password").val(),
                                   },
                              success:function(response){
                                   console.log(response); 
                                   localStorage.setItem('auth',response.AuthId);
                                   localStorage.setItem('token',response.token);
                                   $('#navigation').slideDown();
                              },
                              error:function(response){console.log(response), console.log("erro"); }     
                         });
                         /*********************************/
                              console.log("\r \n");
                              console.log("password = "+$("#password").val() );
                              console.log("email = "+$("#email").val() );
                         /*********************************/

               });
           
               
});

function getToken(token){
    localStorage.setItem('MyMoviesToken', token);
}