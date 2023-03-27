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
  <link rel='stylesheet' href="<?=$action->helper->loadcss('home.css')?>">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.6.2/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/2.1.2/css/searchPanes.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

 
<!-- jQuery -->
<style>
    .card-header {
        padding-bottom: 10px;
    }
    .row {
  padding-bottom: 30px;
}
    </style>
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
                            <a class="nav-link" href="<?=$action->helper->url('admin_dashboard')?>">Admin Dashboard</a>
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
        <h2>User Database</h2>
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
    <table id="users-table" class="table table-bordered table-striped table-with-padding">
  <thead>
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Account Status</th>
      <th>Created At</th>
      <th>Updated At</th>
      <th>Actions</th>
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
        <td>
			<button type="button" class='btn btn-primary updateBtn'><i class='fas fa-fw fa-pen'></i> Edit </button>
			<button type='button' class='btn btn-danger deleteBtn'><i class='fas fa-fw fa-trash'></i>Delete</button>
		</td>
      </tr>
    <?php endforeach ?>
  </tbody>

  <div class="modal fade" id="centeredEditingModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title"><i class="fas fa-fw fa-pen"></i>Edit Account</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<!-- modal edit form-->
								</div>
								<!-- di pa gawa -->

								<div class="card">
									<div class="card-body">

										<form action="<?=$action->helper->url('action/user_update')?>" method="POST">
											<input type="hidden" name="update_id" id="update_id">


											<div class="form-group">
												<label class="form-label">ID</label>
												<input type="text" class="form-control" name="User_id" id="User_id" readonly>
											</div>
											<div class="form-group">
												<label class="form-label">Full Name</label>
												<input type="text" class="form-control" name="User_name" id="User_name" readonly>
											</div>
											<div class="form-group">
												<label class="form-label">Email</label>
												<input type="text" class="form-control" name="User_email" id="User_email" readonly>
											</div>
											<div class="form-group">
												<label class="form-label">Account Status</label><br>
											
												&nbspChange User Account Status? <br>
												&nbsp<select class="form-select" aria-label="Default select example" id="account_status" name="account_status" required>
                                                
                                                    <option value=0>0</option>
                                                    <option value=1>1</option>
                                                </select>
											
												
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												<button type="submit" name="updateBtn" class="btn btn-primary" data-toggle="modal" data-target="#savingEdit"> Save changes</button>
											</div>

										</form>
										<!--end of modal form-->
									</div>
								</div>
							</div>
						</div>
					</div>
                    <!-- start Deleting record modals-->
					<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-sm modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h3 class="modal-title">Warning</h3>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?=$action->helper->url('action/user_delete')?>" method="POST">
									<div class="modal-body m-3">
										<input type="hidden" name="delete_id" id="delete_id">
										<p class="mb-0">Are you sure you are going to make changes?</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
										<button type="submit" name="DeleteUserBtn" class="btn btn-danger">Delete data</button>
									</div>
								</form>

							</div>
						</div>
					</div>
					<!-- END deleting modals-->

  
</table>
  


<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/searchpanes/2.1.2/js/dataTables.searchPanes.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

<script>
$(function() {
			// Datatables basic
			$('#users-table').DataTable({
				responsive: true
			});
		});

$(document).ready(function() {

$('.updateBtn').on('click', function() {

    $('#centeredEditingModal').modal('show');

    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    console.log(data);

    $('#User_id').val(data[0]);
    $('#User_name').val(data[1]);
    $('#User_email').val(data[2]);
    $('#account_status').val(data[3]);

});
});

$(document).ready(function() {

$('.deleteBtn').on('click', function() {

    $('#DeleteModal').modal('show');

    $tr = $(this).closest('tr');

    var data = $tr.children("td").map(function() {
        return $(this).text();
    }).get();

    console.log(data);

    // // $('#update_id').val(data[0]);
    $('#delete_id').val(data[0]);


});
});


</script>

</body>
    </html>
