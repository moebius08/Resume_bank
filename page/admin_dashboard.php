<?php 
$data['resumes'] = $action->db->read('resumes', '*');
$data['users'] = $action->db->read('users', '*');
$userCount = count($data['users']);
$resumeCount = count($data['resumes']);


$usersWithResume = 0;
$usersWithoutResume = 0;
$userIdsWithResume = array();

foreach ($data['resumes'] as $resume) {
    if (!in_array($resume['user_id'], $userIdsWithResume)) {
        array_push($userIdsWithResume, $resume['user_id']);
        $usersWithResume++;
    }
}

$usersWithoutResume = count($data['users']) - $usersWithResume;

?>



<!DOCTYPE html>
 <html>
 <head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title><?=$title?></title>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel='stylesheet' href="<?=$action->helper->loadcss('home.css')?>">

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.1.2/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>
 
<!-- jQuery -->

</head>
 <body>

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

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col">
      <div class="card-header">
        <h2>All Resumes</h2>
      </div>

      <div class="row">
						<div class="col-md-6 col-lg-3 col-xl">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Registered Users: </h5>
										</div>
                                        <h5 class="card-text"><?php echo $userCount; ?></h5>
										<div class="col-auto">
										</div>
									</div>
								</div>
							</div>
						</div>
            <div class="col-md-6 col-lg-3 col-xl">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Resume Count: </h5>
										</div>  
                                        <h5 class="card-text"><?php echo $resumeCount; ?></h5>
										<div class="col-auto">
										</div>
									</div>
								</div>
							</div>
						</div>
                
                <div class="col-md-6 col-lg-3 col-xl">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Users with Resume: </h5>
										</div>
                                        <h5 class="card-text"><?php echo $usersWithResume; ?></h5>
										<div class="col-auto">
										</div>
									</div>
								</div>
							</div>
						</div>
            <div class="col-md-6 col-lg-3 col-xl">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Users without resume: </h5>
										</div>  
                                        <h5 class="card-text"><?php echo $usersWithoutResume; ?></h5>
										<div class="col-auto">
										</div>
									</div>
								</div>
							</div>
						</div>
                </div>
                </div></div>
    </div>

                <table id="users-table" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Account Status</th>
      <th>Created At</th>
      <th>Updated At</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= $user['id'] ?></td>
        <td><?= $user['full_name'] ?></td>
        <td><?= $user['email'] ?></td>
        <td><?= $user['account_status'] ?></td>
        <td><?= $user['created_at'] ?></td>
        <td><?= $user['updated_at'] ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>
  


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.1.2/js/dataTables.searchPanes.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

<script>
$(document).ready(function() {
    $('#users-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                text: 'Export to Excel',
                filename: 'users_data',
                exportOptions: {
                    modifier: {
                        search: 'applied'
                    }
                }
            }
        ]
    });
});


</script>

</body>
    </html>
