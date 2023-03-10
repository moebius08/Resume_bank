

<body class="text-center">
    
    <main class="form-signin w-100 m-auto">
      <form method='post' action='<?=$action->helper->url('action/signup')?>'>
        <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Create new Account</h1>
    
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
    