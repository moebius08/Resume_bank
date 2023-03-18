<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #800;">
    <div class="container-fluid">
        <a class="navbar-brand logo" href="<?=SITE_URL?>">Resume<strong>BANK</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav">
      <li class="about">
        <a class="nav-link" href="<?=$action->helper->url('about_us_content')?>">About Us</a>
      </li>
    </ul>

        <?php if ($action->user_id()) {
            $user = $action->db->read('users', 'account_status', "WHERE id={$action->user_id()}")[0];
            if ($user['account_status'] == 0) {
                ?>
                <ul class="navbar-nav d-flex ml-auto">
                    <li class="nav-item">
                        <a class="nav-link <?=@$myresumes?>" href="<?=$action->helper->url('home')?>">My Resumes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$action->helper->url('action/logout')?>">Logout</a>
                    </li>
                </ul>
                <?php
            } else {
                ?>
                <ul class="navbar-nav d-flex ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$action->helper->url('database')?>">Database</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$action->helper->url('action/logout')?>">Logout</a>
                    </li>
                </ul>
                <?php
            }
        } else {
            ?>
            <ul class="navbar-nav d-flex ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=$action->helper->url('login')?>">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$action->helper->url('signup')?>">Sign up</a>
                </li>
            </ul>
            <?php
        }
        ?>
    </div>
</nav>
