<?php
ob_start();
$title = 'Login Page';
?>

<section id="hero" class="hero">

    <img src="App/Views/assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <h3 class="card-title text-center text-white">Iniciar sesión</h3>
                        <form method="POST" action="/login">
                            <div class="form-group text-white mb-3">
                                <label for="exampleInputEmail1" class="mb-1">Email address</label>
                                <input type="email" class="form-control bg-transparent text-bg-danger" id="email" aria-describedby="emailHelp" placeholder="Enter email">

                            </div>
                            <div class="form-group mb-3 text-white">
                                <label for="pass" class="mb-1">Password</label>
                                <input type="password" class="form-control bg-transparent" id="password" placeholder="Password">
                            </div>
                            <div class="form-group mb-3 text-white d-flex justify-content-between">
                                <button class="btn btn-danger btn-sm order-0" id="logIn" type="button"> Iniciar Sesión</button>
                                <span>No tienes cuenta |<a class=" text-white btn-link" href="http://localhost:8080/register" role="button"> registrate</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    const login = document.querySelector('#logIn');

    login.addEventListener('click', () => {

        formData = {
            email: document.getElementById("email").value,
            pass: document.getElementById("password").value
        }

        solicitudFetch('http://localhost:8080/login', "POST", formData)
            .then((data) => {
                console.log(data);

                if (data.error) {
                    alert(data.error)
                    return;
                }
                const dataObj = data.message;
                Object.keys(dataObj).forEach(function(key) {
                    localStorage.setItem(key, JSON.stringify(dataObj[key]));
                });
                window.location.href = "http://localhost:8080/";
            })
            .catch((error) => {
                // Manejar cualquier error que ocurra durante la solicitud
                console.error('Error al realizar la solicitud:', error);
            });
    })

    const decodeJwtResponse = (credential) => {
        const tokenParts = credential.split('.');
        const header = JSON.parse(atob(tokenParts[0]));
        const body = JSON.parse(atob(tokenParts[1]));
        return {
            header: header,
            body: body
        };
    }
</script>
<?php
$content = ob_get_clean();

include('app.php');
?>