<title>Login Page</title>    
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #800;">
    <div class="container-fluid">
      <a class="navbar-brand logo" href="index.php">Resume<strong>BANK</strong></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <ul class="navbar-nav mr-auto" >
    </ul>
  </nav>

<body class="text-start">
  <div class="container">
    <div class="row">
      <div class="login-image">
        <img src="<?=$action->helper->loadimage('pupimg.jpg')?>" alt="Image Description" id="my-image">
      </div>
    <div class="col-md-5">
      <main class="form-signin w-100 m-auto">
        <form method='post' action='<?=$action->helper->url('action/login')?>'>
          <h1 class="h3 mb-3 fw-normal">Login</h1>

          <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput" placeholder="Email Address" name="email" required>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
          </div>
          <br>
          <button class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>
          <a href='<?=$action->helper->url('signup')?>' class="mt-5">Don't have an Account? Register</a>
        </form>
      </main>
    </div>
  </div>
</div>