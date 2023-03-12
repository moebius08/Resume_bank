

<body class="text-center">
    
    <main class="form-signin w-100 m-auto">
      <form method='post' action='<?=$action->helper->url('action/login')?>'>
        <img class="mb-4" src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="Email Address" name="email" required>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
        </div>
        <br>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign In</button>
        <a href='<?=$action->helper->url('signup')?>'class="mt-5"> Don't have an Account? Register</a>
      </form>
    </main>
    