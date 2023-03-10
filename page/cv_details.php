<div class='container'>
        <h3 class="my-3">Enter Your Details</h3>
<form method='post' action="<?=$action->helper->url('action/createresume')?>" class="border border-2 rounded-2 p-2 my-3">
<div class='row justify-content-between'>
  <div class="col-6 mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
    <div class="">
      <input type="text" name="name" placeholder="John Doe"class="form-control" id="name" required>
    </div>
  </div>    
  <div class="col-6 mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Headline</label>
    <div class="">
      <input type="text" name="headline" placeholder="PHP Developer" class="form-control" id="headline" required>
    </div>
  </div>
  </div>
  <div class="mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Objective</label>
    <div class="">
    <textarea class="w-100" name="objective" id="objective" required></textarea>    
</div>
  </div>

  <hr>
  <h3>Contact Details</h3>
  <div class='row justify-content-between'>
<div class="col-6 mb-3"> 
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="">
      <input type="email" name="email" placeholder="JohnDoe@gmail.com" class="form-control" id="email" required>
    </div>
  </div>
  <div class="col-6 mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Mobile</label>
    <div class="">
      <input type="mobile" name="mobile" placeholder="91234567890" class="form-control" id="contact" required>
    </div>
  </div>
</div>
  <div class="mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Address</label>
    <div class="">
      <input type="text" name="address" placeholder="123 St. Blk 4" class="form-control" id="address" required>
    </div>
  </div>

  <hr>

  <div class="col-6 mb-3">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Skills</label>
    <div id='skills'>
    </div>
    <div class="input-group mb-3">
  <input type="text"  class="form-control" id='userskill' placeholder="HTML" aria-label="example text with button addon" aria-describedby="basic-addon2">
    <button class="btn btn-primary" type="button" id="addskill">Add Skill</button>
  </div>
  </div>
  
  <hr>
  <div class="mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label fs-4">Education</label>
    <div id='educations'>
    </div>
    <div class="d-flex gap-2">
      <input type="text" class="form-control mx-2" id="college" placeholder="Polytechnic University of the Philippines">
      <input type="text" class="form-control mx-2" id="course" placeholder="Bachelor in Computer Engineering">
      <input type="text" class="form-control mx-2" id="e_duration" placeholder="2019-2023">
      <button type="button" class="btn btn-primary" id="addeducation">Add</button>
    </div>
  </div>

  <hr>
  <div class="mb-3">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Experience</label>
    <div id='experiences'>
    </div>
    <div class="d-flex gap-2">
      <input type="text" class="form-control mx-2" id="company" placeholder="Facebook" >
      <input type="text" class="form-control mx-2" id="jobrole" placeholder="Software Engineer" >
      <input type="text" class="form-control mx-2" id="w_duration" placeholder="2023-2024" >
    </div>
    <span class="d-block mt-2">About your work</span>
    <textarea class="w-100 mb-2" id="work_desc"></textarea>
    <button type="button" class="btn btn-primary" id="addexperience">Add</button>
  </div>
  <button type="submit" class="btn btn-warning">Create Resume</button>
</form>
</div>