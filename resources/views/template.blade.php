<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <title>Alfahelix | @yield('titulo')</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
  <link href="/css/style.css" rel="stylesheet">
  <link rel="icon" href="/img/favicon.png">

  <script type="text/javascript" src="js/jquery.js"></script>
</head>

<body>
  <header class="navbar navbar-dark d-flex flex-wrap justify-content-center py-3">

    <a href="https://www.alfahelix.com.br/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
      <img src="/img/logo.svg" alt="Certificados Alfahelix">
    </a>

    <ul class="nav nav-pills navbar-dark">
      <li class="nav-item active">
        <a class="nav-link text-light" href="/">Verificar certificado <span class="visually-hidden">(atual)</span></a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-light" href="/gerar">Emitir certificado</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="https://www.alfahelix.com.br/editora">Editora</a>
      </li>

      @auth
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-light" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name;}}</a>
        <div class="dropdown-menu" aria-labelledby="dropdownId">
          <a class="dropdown-item" href="/restrito">Área restrita</a>
          <form action="/logout" method="POST">
            @csrf
            <input type="submit" class="btn btn-danger w-100 mt-2" value="Sair">
          </form>
        </div>
      </li>
      @endauth

      @guest
      <li class="nav-item">
        <a class="nav-link text-light" href="/login">Login</a>
      </li>
      @endguest

      <li class="nav-item">
        <a class="nav-link text-light" target="blank" href="https://www.facebook.com/alfahelix.com.br">Contato</a>
      </li>

    </ul>
  </header>

  <main>
    @yield('conteudo')
  </main>

  <footer>
    <div class="container">
      <p><b>©<?php echo date("Y"); ?> Alfahelix | <a style="color:#111" href="https://alfahelix.com.br">Home</a> | <a style="color:#111" href="https://alfahelix.com.br/cursos">Cursos</a> | <a style="color:#111" href="https://alfahelix.com.br/livros">Livros</a> | <a style="color:#111" href="http://twitter.com/alfahelixbr">Contato</a></b><br><a href="https://alfahelix.com.br/politica-de-privacidade/">Política de privacidade e termos de uso</a></p>
    </div>

    <!-- JS -->
    
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
      ga('create', 'UA-62944985-1', 'auto');
      ga('send', 'pageview');
    </script>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>

  </footer>
</body>

</html>