

$('document').ready(
    function(){
        $("#name").focus();
        $("#registro").children('form').submit(function(){
            event.preventDefault();
            var nome = $("#name").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var password_confirmation = $("#password_confirmation").val();

            Registra(nome,email, password,password_confirmation);

        });
          
    }
);


function Registra(nome,email, password,password2){
    var resposta;
    $.ajax({
        method:"POST",
        url:urlCAd,
        data:{"name":nome,"email":email,"password":password,"password_confirmation":password2},
        success:function(response) {

                resposta = response.cod;
                resposta = parseInt(resposta);
                if(resposta===201)
                {
                   localStorage.setItem('email',email);
                   localStorage.setItem('password',password); 
                   alert("usuario cadastrado com sucesso!"); 
                   window.location.replace(Redirect);
                } 
        },
        error:function(response) {  alert("email já cadastrado"); console.log("deu erro"); },
    });
}