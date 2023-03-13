<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col">
      <div class="card-header">
        <h2>All Resumes</h2>
        <input type="text" name="searchbox" id="searchbox" class="filterinput form-control" placeholder="Search Talents">
      </div>
      <div class="card my-3">
        <div class="card-body">
          <?php
          $count = 0;
          foreach($resumes as $resume){

            // Decoding JSON fields
            $resume['contact'] = str_replace('\\',"",$resume['contact']);
            $resume['skills'] = str_replace('\\',"",$resume['skills']);
            $resume['works'] = str_replace('\\',"",$resume['experience']);
            $resume['education'] = str_replace('\\',"",$resume['education']);

            $contact = json_decode($resume['contact']);
            $skills = json_decode($resume['skills']);
            $works = json_decode($resume['experience']);
            $education = json_decode($resume['education']);

            if (!empty($resume['objective'])) {
              $resume['objective'] = str_replace('\\',"",$resume['objective']);
              $objective = json_decode($resume['objective']);
          }

            // creating a new row after every 2 cards
            if ($count % 2 == 0) {
              echo '<div class="row">';
            }
            ?>
            <div class="col-md-6">
              <div class="card my-3">
                <div class="card-body">
                  <h5 class="card-title"><?=$resume['headline']?></h5>
                  <p class="card-text"><?=$resume['objective']?></p>
                  <label for="job">Experience/s: </label>
                  <?php 
								if(count($works)<1) {
									?>
									<div class="job last">

									<h6>Fresher</h6>

									</div>

									<?php 
								}
								?>

						<?php 
								foreach($works as $work) {
									?>
								<div class="job">
								<h6><?=$work->company?> (<?=$work->w_duration?>)</h6>
								<h6><?=$work->jobrole?></h6>
								<p> <?=$work->work_desc?> </p>
								</div>
									
									<?php 
								}
								?>
                  <label for="skills">Skills: </label>
                  <?php 
                  foreach($skills as $skill) {
                    ?>
                    <span id='skills' class="badge badge-danger p-1 m-1"><?= $skill ?></span>
                    <?php 
                  }
                  ?>
                  <br>
              
                  <a href="<?=$action->helper->url("resume/".$resume['url'])?>" class="btn btn-success">View</a>
                </div>
              </div>
            </div>
            <?php
            // closing the row after every 2 cards
            if ($count % 2 == 1 || $count == count($resumes) - 1) {
              echo '</div>';
            }
            $count++;
          }
          if(count($resumes) % 2 == 1){
            // add an empty card to the end if the number of resumes is odd
            echo '<div class="col-md-6"></div>';
          }
          if(count($resumes)<1){
            ?>
            <div class="card my-3">
              <div class="card-body">
                <h1 class="text-center text-muted">No Resumes Created</h1>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
