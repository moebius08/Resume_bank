
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="<?=$action->helper->loadjs('main.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
            const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
        <?php 
        $error = $action->session->get('error');
        $success = $action->session->get('success');
        if($error){
        ?>
        Toast.fire({
        icon: 'error',
        title: '<?=$error?>'
        });

            <?php
            $action->session->delete('error');
        }                    
if($success){
        ?> 
        Toast.fire({
        icon: 'success',
        title: '<?=$success?>'
        });

            <?php
            $action->session->delete('success');
        }
        ?>
        //add skill
        $("#addskill").click(function(){
            var skill = $('#userskill').val();
            if(!skill){
            Toast.fire({
                icon: 'error',
                title: 'Enter a skill'
        });
        return;
            }
            $("#skills").append(`<span class="badge badge-danger p-1 m-1">${skill} <input type='hidden' name='skill[]' value='${skill}' /><span class="text-dark removeskill" onclick='removeskill(this)'> X</span></span>`);
            $('#userskill').val('');
        }) 

        function removeskill(button) {
            $(button).parent().remove();
        }


        $("#addeducation").click(function(){
            var college = $('#college').val();
            var course = $('#course').val();
            var e_duration = $('#e_duration').val();
            if(!course){
            Toast.fire({
                icon: 'error',
                title: 'Enter a course'
             });
            return;
            }
            if(!e_duration){
            Toast.fire({
                icon: 'error',
                title: 'Enter a duration'
             });
            return;
            }
            if(!college){
            Toast.fire({
                icon: 'error',
                title: 'Enter a college/institute'
             });
            return;
            }
            $("#educations").append(`
            <div class="d-inline-block border rounded p-2 my-2">
            <input type='hidden' name='college[]' value='${college}' />
            <input type='hidden' name='course[]' value='${course}' />
            <input type='hidden' name='e_duration[]' value='${e_duration}' />
            <h4>${college}</h4>
            <p>${course} - (${e_duration})</p>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeeducation(this)">Remove</button>
            </div>`);
            $('#college').val('');
            $('#course').val('');
            $('#e_duration').val('');
        }) 

        function removeeducation(button) {
            $(button).parent().remove();
        }

        $("#addexperience").click(function(){
            var company = $('#company').val();
            var jobrole = $('#jobrole').val();
            var w_duration = $('#w_duration').val();
            var about = $('#work_desc').val();
            if(!company){
            Toast.fire({
                icon: 'error',
                title: 'Enter a company'
             });
            return;
            }
            if(!jobrole){
            Toast.fire({
                icon: 'error',
                title: 'Enter a job role'
             });
            return;
            }
            if(!w_duration){
            Toast.fire({
                icon: 'error',
                title: 'Enter a duration'
             });
            return;
            }
            if(!about){
            Toast.fire({
                icon: 'error',
                title: 'Enter a description'
             });
            return;
            }
            $("#experiences").append(`
            <div class="d-inline-block border rounded p-2 my-2">
            <input type='hidden' name='company[]' value='${company}' />
            <input type='hidden' name='jobrole[]' value='${jobrole}' />
            <input type='hidden' name='w_duration[]' value='${w_duration}' />
            <textarea class="d-none" name="work_desc[]">
            ${about}
            </textarea>
            <h4>${company}</h4>
            <h5>${jobrole} - (${w_duration})</h5>
            <p>${about}</p>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeexperience(this)">Remove</button>
            </div>`);
            $('#company').val('');
            $('#jobrole').val('');
            $('#w_duration').val('');
            $('#work_desc').val('');
        })

        function removeexperience(button) {
            $(button).parent().remove();
        }

        document.addEventListener("keydown", function(event) {
  if (event.key === "Enter") {
    event.preventDefault();
  }
});

function copyurl(url) {
    navigator.clipboard.writeText(url);
    Toast.fire({
        icon: 'success',
        title: 'Share link Copied'
    })

}

        
    </script>
</body>
    </html>