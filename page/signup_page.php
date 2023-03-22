

<body class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <img src="<?=$action->helper->loadimage('pupaerial.jpg')?>" alt="Image Description">
      </div>
      <div class="col-md-8">
        <main class="form-signin w-100 m-auto">
          <form method='post' action='<?=$action->helper->url('action/signup')?>'>
            <h1 class="h3 mb-3 fw-normal">Create an Account</h1>
    
            <div class="form-floating">
          <input type="name" class="form-control" id="floatingInput" placeholder="Full Name" name="full_name" required>
        </div>
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="Email Address" name="email" required>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
        </div>
        <br>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
        <a href='<?=$action->helper->url('login')?>'class="mt-5"> Already Have an Account? Sign in</a>
      </form>
    </main>
  </div>
</div>
</div>
</body>
    