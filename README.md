<h2>Olá!</h2>
<h4>Bem vindo ao projeto <span style="color:red">MovieFlix</span></h4>

<ol>
    <li>Clone o repositório;</li>
    <li>Dentro da pasta raiz do projeto, execute o comando: <code>composer install</code></li>
    <li>Aguarde o projeto ser instalado e configurado.</li>
    <li>Acesse o projeto <a href="http://localhost:8000">aqui</a></li>
</ol>

---

<h5>Observações:</h5>
<p>Foi gerado um usuário inicial para poder fazer testes ao sistema:</p>

- usuário: user@movieflix.com.br
- senha: movieflix


|           Route          |         Controller      |        Method       | Authenticated |    Type   |
|:------------------------:|:-----------------------:|:-------------------:|:-------------:|:---------:|
| /                        |  StartController        | index               | no            | GET       |
| login                    | Auth/LoginController    | login               | no            | GET/POST  |
| register                 | Auth/RegisterController | register            | no            | GET/POST  |
| movies                   | MoviesController        | list                | yes           | GET       |
| favorites                | MoviesController        | favorites           | yes           | GET       |
| addToFavorites/{id}      | MoviesController        | addToFavorites      | yes           | POST      |
| removeFromFavorites/{id} | MoviesController        | removeFromFavorites | yes           | POST      |

Obrigado! <a href="https://github.com/leandjoao">@leandjoao</a>
