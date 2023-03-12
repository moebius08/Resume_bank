

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-2">
      <div class="card my-5">
        <div class="card-body text-center">
          <img src="https://icon-library.com/images/anonymous-avatar-icon/anonymous-avatar-icon-25.jpg" alt="avatar"
            class="rounded-circle img-fluid" style="width: 150px;">
          <h5 class="my-3"><?=$user['full_name']?></h5>
          <div class="d-flex justify-content-center mb-2">
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-8">
      <div class="card-header">
        <a href="<?=$action->helper->url('select-template')?>" class="btn btn-primary">Create New Resume</a>
      </div>
      <div class="card my-3">
        <div class="card-body">
          <?php
          foreach($resumes as $resume){
          ?>
          <div class="card my-3">
            <div class="card-body">
              <h5 class="card-title"><?=$resume['headline']?></h5>
              <p class="card-text"><?=$resume['objective']?></p>
              <a href="<?=$action->helper->url("resume/".$resume['url'])?>" class="btn btn-success">View</a>
              <a href="<?=$action->helper->url("resume/deleteresume/".$resume['url'])?>" class="btn btn-danger">Delete</a>
              <a href="#" class="btn btn-secondary" onclick="copyurl(`<?=$action->helper->url("resume/".$resume['url'])?>`)">Copy URL</a>
            </div>
          </div>
          <?php
          }
          if(count($resumes)<1){
          ?>
          <div class="card my-3">
            <div class="card-body">
              <h1 class="text-center text-muted">No Resume Created</h1>
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
