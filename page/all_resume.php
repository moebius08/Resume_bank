<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col">
      <div class="card-header">
        <h2>All Resumes</h2>
      </div>
      <table id="resumes-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Course/s</th>
            <th>Email</th>
            <th>Cellphone Number</th>
            <th class="skills-header">Skills</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($resumes as $resume): ?>
            <?php
            // Decoding JSON fields
            $resume['contact'] = str_replace('\\', '', $resume['contact']);
            $resume['skills'] = str_replace('\\', '', $resume['skills']);
            $resume['works'] = str_replace('\\', '', $resume['experience']);
            $resume['education'] = str_replace('\\', '', $resume['education']);
            $contact = json_decode($resume['contact']);
            $skills = json_decode($resume['skills']);
            $works = json_decode($resume['experience']);
            $education = json_decode($resume['education']);
            if (!empty($resume['objective'])) {
              $resume['objective'] = str_replace('\\', '', $resume['objective']);
              $objective = json_decode($resume['objective']);
            }
      
            ?>
            <tr>
              <td><?= $resume['name'] ?></td>
              <?php if(count($education)<1) {
									?>
									<div class="yui-u">
                  <td>No Education</td>
                	</div>
									<?php 
								}
              foreach ($education as $degree): ?>
                <td><?= $degree->course ?></td>
               <?php endforeach; ?>

              <td><?=@$contact->email?>
              </td>
              <td>
              <?=@$contact->mobile?>
              </td>
              <td><?php foreach ($skills as $skill): ?>
                  <span class="badge badge-danger p-1 m-1"><?= $skill ?></span>
                <?php endforeach ?></td>
              <td><a href="<?= $action->helper->url("resume/".$resume['url']) ?>" class="btn btn-success">View</a></td>
            </tr>
          <?php endforeach ?>
        </tbody>
        <tfoot>
        <tr>
            <th>Full Name</th>
            <th>Course/s</th>
            <th>Email</th>
            <th>Cellphone Number</th>
            <th>Skills</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
      <?php if (count($resumes) < 1): ?>
        <div class="card my-3">
          <div class="card-body">
            <h1 class="text-center text-muted">No Resumes Created</h1>
          </div>
        </div>
      <?php endif ?>
    </div>
  </div>
</div>
