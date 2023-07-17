<title>Sign up Page</title>    
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

  <div class="container">
  <div class="row">
    <div class="signup-image">
      <img src="<?=$action->helper->loadimage('pupaerial.jpg')?>" alt="Image Description" id="aerial-image" class="img-fluid">
    </div>
    <div class="col-md-3 offset-md-3">
      <main class="form-signin w-100 m-auto">
        <form method='post' action='<?=$action->helper->url('action/signup')?>'>
          <h1 class="h3 mb-3 fw-normal">Create an Account</h1>
          <div class="form-floating">
            <input type="text" class="form-control" id="floatingInput" placeholder="Full Name" name="full_name" required>
            <label for="floatingInput">Full Name</label>
          </div>
          <div class="form-floating">
            <input type="email" class="form-control" id="floatingInput2" placeholder="Email Address" name="email" required>
            <label for="floatingInput2">Email Address</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword2" placeholder="Password" name="password" required>
            <label for="floatingPassword2">Password</label>
          </div>
          <br>
          <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
          <a href='<?=$action->helper->url('login')?>' class="mt-3 d-block text-center">Already Have an Account? Sign in</a>
        </form>
      </main>
    </div>
  </div>
</div>
