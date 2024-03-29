<?php
ob_start();
$title = 'Home Page';

print_r($_SESSION['user']);

?>
<style>
  .index-page .header {
    --background-color: transparent;
    --heading-color: #444444;
    --nav-color: #444444;
    --nav-hover-color: #d83535;
    margin-bottom: 200px;
  }
</style>
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="container-fluid d-flex align-items-center justify-content-between">

    <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
      <h1>Test</h1>
    </a>

    <!-- Nav Menu -->
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index.html#hero" class="active">Home</a></li>
        <li><a href="index.html#about">Usuarios</a></li>
      </ul>

      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <button class="btn-getstarted border-0">Cerrar Sesión</button>

  </div>
</header>
<section id="hero" class="mt-5">
  <main class="container">
    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
      <div class="col-lg-6 px-0">
        <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
        <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
        <p class="lead mb-0"><a href="#" class="text-body-emphasis fw-bold">Continue reading...</a></p>
      </div>
    </div>

    <div class="row mb-2">

    </div>

    <div class="row g-5">
      <div class="col-md-8">
        <h3 class="pb-4 mb-4 fst-italic border-bottom">
          From the Firehose
        </h3>
        <article class="blog-post">
          <h2 class="display-5 link-body-emphasis mb-1">New feature</h2>
          <p class="blog-post-meta">December 14, 2020 by <a href="#">Chris</a></p>

          <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
          <ul>
            <li>First list item</li>
            <li>Second list item with a longer description</li>
            <li>Third list item to close it out</li>
          </ul>
          <p>This is some additional paragraph placeholder content. It's a slightly shorter version of the other highly repetitive body text used throughout.</p>
        </article>

        <nav class="blog-pagination" aria-label="Pagination">
          <a class="btn btn-outline-primary rounded-pill" href="#">Older</a>
          <a class="btn btn-outline-secondary rounded-pill disabled" aria-disabled="true">Newer</a>
        </nav>


        <div class="my-5">
          <h3 class="text-center"> Área de comentarios</h3>

          <div class="comment-area">

          </div>
        </div>

      </div>

      <div class="col-md-4">
        <div class="position-sticky" style="top: 2rem;">
          <div class="p-4 mb-3 bg-body-tertiary rounded">
            <h4 class="fst-italic">About</h4>
            <p class="mb-0">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>
          </div>

          <div>
            <h4 class="fst-italic">Recent posts</h4>
            <ul class="list-unstyled">
              <li>
                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                  <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#777" />
                  </svg>
                  <div class="col-lg-8">
                    <h6 class="mb-0">Example blog post title</h6>
                    <small class="text-body-secondary">January 15, 2024</small>
                  </div>
                </a>
              </li>
              <li>
                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                  <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#777" />
                  </svg>
                  <div class="col-lg-8">
                    <h6 class="mb-0">This is another blog post title</h6>
                    <small class="text-body-secondary">January 14, 2024</small>
                  </div>
                </a>
              </li>
              <li>
                <a class="d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center py-3 link-body-emphasis text-decoration-none border-top" href="#">
                  <svg class="bd-placeholder-img" width="100%" height="96" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#777" />
                  </svg>
                  <div class="col-lg-8">
                    <h6 class="mb-0">Longer blog post title: This one has multiple lines!</h6>
                    <small class="text-body-secondary">January 13, 2024</small>
                  </div>
                </a>
              </li>
            </ul>
          </div>

          <div class="p-4">
            <h4 class="fst-italic">Archives</h4>
            <ol class="list-unstyled mb-0">
              <li><a href="#">March 2021</a></li>
              <li><a href="#">February 2021</a></li>
              <li><a href="#">January 2021</a></li>
              <li><a href="#">December 2020</a></li>
              <li><a href="#">November 2020</a></li>
              <li><a href="#">October 2020</a></li>
              <li><a href="#">September 2020</a></li>
              <li><a href="#">August 2020</a></li>
              <li><a href="#">July 2020</a></li>
              <li><a href="#">June 2020</a></li>
              <li><a href="#">May 2020</a></li>
              <li><a href="#">April 2020</a></li>
            </ol>
          </div>

          <div class="p-4">
            <h4 class="fst-italic">Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>

  </main>

  <footer class="py-5 text-center text-body-secondary bg-body-tertiary">
    <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
    <p class="mb-0">
      <a href="#">Back to top</a>
    </p>
  </footer>


</section>


<script>
  const areaComments = document.querySelector(".comment-area");

  const addCommentForm = () => {
    let area = `
        <textarea class="w-100 comm-add" name="coommant" id="txa-comment" user=""  rows="10"></textarea>
        <div class="d-flex justify-content-end">
          <button class="btn btn-success btn-sm btn-agregarcomment" id="btn-agregarcomment" type="button">Agregar Comentario</button>
        </div>
      `;
    areaComments.insertAdjacentHTML('beforeend', area);
  }

  addCommentForm();
  document.addEventListener("click", (e) => {
    if (e.target.classList.contains("btn-agregarcomment")) {
      e.preventDefault();
      const textareaAncestor = e.target.parentNode.previousElementSibling;

      formData = {
        coment_text: textareaAncestor.value,
        hash: JSON.parse(localStorage.getItem("token"))
      }

      let url = "http://localhost:8080/api/comment";

      solicitudFetch(url, "POST", formData)
        .then((data) => {
          console.log(data);
          if (data.error) {
            alert(data.error);
            return;
          }
          addUserComment(data.message.comment);
        })
        .catch((error) => {
          console.error('Error al realizar la solicitud:', error);
        });
    }
  });

  const btnGetstarted = document.querySelector('.btn-getstarted');
  btnGetstarted.addEventListener('click', () => {
    localStorage.clear();
    solicitudFetch("http://localhost:8080/logout", "GET")
      .then((data) => {
        window.location.href = "http://localhost:8080/"
      })
      .catch((error) => {
        console.error('Error al realizar la solicitud:', error);
      });
  })

  const addUserComment = (data) => {
    const coment_text = document.querySelector('.comm-add').value = "";

    card = `<div class="card mb-5 bg-light" id="${data.id}">
              <div class="card-body">
                <h5 class="card-title use_name mb-0">${data.user_fullname}</h5>
                <a class="card-subtitle mb-3 text-body-secondary">${data.user_email}</a>
                <p class="card-text mt-5">
                ${data.coment_text}
                </p>
                <a href="#" class="card-link edit" user_id="${data.user_id}">Editar</a>
                <a href="#" class="card-link delete" user_id="${data.user_id}">Eliminar</a>
                <a href="#" class="card-link like">Likes: <span class="likes">${data.likes}</span></a>
              </div>
            </div>`;
    areaComments.insertAdjacentHTML('afterbegin', card);
  }
  
  const getAllComents = () => {
    let url = "http://localhost:8080/api/comments";

    solicitudFetch(url, "GET", null)
      .then((data) => {
        if (data.error) {
          alert(data.error);
          return;
        }
        data.message.forEach(function(comment) {
          addUserComment(comment);
        });
      })
      .catch((error) => {
        console.error('Error al realizar la solicitud:', error);
      });
  }
  getAllComents();
</script>

<?php
$content = ob_get_clean();


include('app.php');
?>