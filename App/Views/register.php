<?php
ob_start();
$title = 'Register Page';
?>

<section id="hero" class="hero">

    <img src="App/Views/assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card bg-transparent">
                    <div class="card-body">
                        <h3 class="card-title text-center text-white">Registrate</h3>
                        <form method="POST" action="http://localhost:8080/api/user">
                            <div class="form-group text-white mb-3">
                                <label for="name" class="mb-1">Name</label>
                                <input type="text" class="form-control bg-transparent text-bg-danger" id="name" aria-describedby="NameHelp" placeholder="Enter Name">

                            </div>
                            <div class="form-group text-white mb-3">
                                <label for="email" class="mb-1">Email address</label>
                                <input type="email" class="form-control bg-transparent text-bg-danger" id="email" aria-describedby="emailHelp" placeholder="Enter email">

                            </div>
                            <div class="form-group mb-3 text-white">
                                <label for="password" class="mb-1">Password</label>
                                <input type="password" class="form-control bg-transparent" id="password" placeholder="Password">
                            </div>
                            <div class="form-group mb-3 text-white">
                                <label for="confirmar-pasword" class="mb-1">Confirmar Password</label>
                                <input type="password" class="form-control bg-transparent" id="confirmar-pasword" placeholder="Confirmar Password">
                            </div>
                            <div class="form-group mb-3 text-white d-flex justify-content-between">
                                <button class="btn btn-danger btn-sm order-0 singin" type="button"> Registrarse</button>
                                <span>No tienes cuenta |<a class=" text-white btn-link" href="http://localhost:8080/login" role="button"> Iniciar Sesión</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    const $form = document.querySelector('form');
    const $singin = document.querySelector('.singin');

    $singin.addEventListener("click", () => {
        let name = document.getElementById("name").value;
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let confirmar_password = document.getElementById("confirmar-pasword").value;
        let url = $form.getAttribute('action');
        let method = $form.getAttribute('method');

        formData = {
            "fullname": name,
            "email": email,
            "pass": password,
            "pass_confirmation": confirmar_password,
        }
        solicitudFetch(url, "POST", formData)
            .then((data) => {
                if (data.error) {
                    alert(data.error);
                    return;
                }
                const dataObj = data.message;
                Object.keys(dataObj).forEach(function(key) {
                    localStorage.setItem(key, JSON.stringify(dataObj[key]));
                });
                window.location.href = "http://localhost:8080/";
            })
            .catch((error) => {
                console.error('Error al realizar la solicitud:', error);
            });
    });
</script>
<?php
$content = ob_get_clean();

include('app.php');
?>