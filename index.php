<?php 
require('dnlib/load.php');

//index
$action->helper->route('/',function() {
global $action;

    $data['title'] = 'ResumeBank';
 $action->view->load('index_header',$data);
 $action->view->load('navbar',$data);
 $action->view->load('content');

});

//index
$action->helper->route('about_us_content',function() {
    global $action;
    
        $data['title'] = 'ResumeBank';
     $action->view->load('about_header',$data);
     $action->view->load('navbar',$data);
     $action->view->load('about_us_content');
    
    });

        //for creating resume
        $action->helper->route('action/createresume',function() {
            global $action;
            $action->onlyForAuthUser();
            $resume_data[0] = $action->session->get('Auth')['data']['id'];
            $resume_data[1] = $action->db->clean($_POST['name']);
            $resume_data[3] = $action->db->clean($_POST['headline']);
            $resume_data[4] = $action->db->clean($_POST['objective']);

            $contact['email'] = $action->db->clean($_POST['email']);
            $contact['mobile'] = $action->db->clean($_POST['mobile']);
            $contact['address'] = $action->db->clean($_POST['address']);

            $resume_data[2] = json_encode($contact);
            $resume_data[5] = json_encode($_POST['skill']);
            $education=array();
            $work=array();
            $certificate=array();


            foreach($_POST['college'] as $key=>$value) {
                $education[$key]['college'] =    $action->db->clean($value);
                $education[$key]['course'] =     $action->db->clean($_POST['course'][$key]);
                $education[$key]['e_duration'] = $action->db->clean($_POST['e_duration'][$key]);
            }
            foreach($_POST['college'] as $key=>$value) {
                $certificate[$key]['title'] =    $action->db->clean($value);
                $certificate[$key]['date'] =     $action->db->clean($_POST['date'][$key]);
            }

            foreach($_POST['company'] as $key=>$value) {
                $work[$key]['company'] = $action->db->clean($value);
                $work[$key]['jobrole'] = $action->db->clean($_POST['jobrole'][$key]);
                $work[$key]['w_duration'] = $action->db->clean($_POST['w_duration'][$key]);
                // Replace \r\n with \n in the work_desc field
                $work_desc = str_replace("\r\n", "", $_POST['work_desc'][$key]);
                $work[$key]['work_desc'] = $action->db->clean($work_desc);
            }
            
            $resume_data[6] = json_encode($work);
            $resume_data[7] = json_encode($education);
            $resume_data[8] = json_encode($certificate);

            $resume_data[9] = $action->helper->UID();

            $run=$action->db->insert('resumes','user_id,name,headline,objective,contact,skills,experience,education,certificates,url', $resume_data);
            if($run){
                $action->session->set('success','Resume Created');
                $action->helper->redirect('home');
            }else{
                $action->helper->redirect('home');
                $action->session->set('error','Something went wrong, Please try again later');
            }


            });

//for logout
$action->helper->route('action/logout',function() {
    global $action;
    $action->session->delete('Auth');
    $action->session->set('success','Logged Out');
    $action->helper->redirect('login');
    });
//for delete
$action->helper->route('resume/deleteresume/$url',function($data) {
    global $action;
    $url = $data['url'];
    $action->db->delete('resumes',"url='$url'");
    $action->session->set('success','Resume Deleted');
    $action->helper->redirect('home');
    });


                //for cv details
                $action->helper->route('cv-details/$cvtype',function($data) {
                    global $action;
                    $action->onlyForAuthUser();
                    $data['title'] = "CV Details";
                    $data['myresumes'] = 'active';
                    $action->view->load('home_header',$data);
                    $action->view->load('navbar',$data);
                    if($data['cvtype']==1){
                        $action->view->load('cv_details');
                    }else {
                        $action->helper->redirect('select-template');
                        $action->session->set('error','Invalid resume type');
                    }
                    $action->view->load('footer');
                    });

            //for template
            $action->helper->route('select-template',function($data) {
                global $action;
                $action->onlyForAuthUser();
                $data['title'] = "Select CV Template";
                $data['myresumes'] = 'active';
                $action->view->load('home_header',$data);
                $action->view->load('navbar',$data);
                $action->view->load('template_content');

                $action->view->load('footer');
                });
            

        //for resumebuild
    $action->helper->route('resumebuild/$type',function($data) {
        global $action;
        $action->onlyForAuthUser();
        $data['title'] = "Resume - Type ".$data['type'];
        $data['myresumes'] = 'active';
        $action->view->load('home_header',$data);
        $action->view->load('navbar',$data);
        if($data['type']==1){
            $action->view->load('resumebuild_content_1');
        }else {
            $action->helper->redirect('home');
        }
        $action->view->load('footer');
        });

        //for URL
    $action->helper->route('resume/$url',function($data) {
        global $action;
        $resumedata = $action->db->read("resumes","*","WHERE url='".$data['url']."'");
        
        if(!$resumedata){
            $action->helper->redirect('home');
        }
        $resumedata=$resumedata[0];
        $data['title'] = $resumedata['name'];
        $data['type'] = 1;
        $data['resume'] = $resumedata;


        if($data['type']==1){
            $action->view->load('resumebuild_content_1', $data);
        }else {
            $action->helper->redirect('home');
        }
        });
    
//for home
$action->helper->route('home',function() {
    global $action;
    $action->onlyForAuthUser();
    $data['title'] = 'ResumeBank';
    $data['myresumes'] = 'active';
    $users = $action->db->read('users','id,full_name',"WHERE id='".$action->user_id()."'");
    $users = $users[0];
    $data['user'] = $users;

    $data['resumes']=$action->db->read('resumes','*',"WHERE user_id=".$action->user_id());

    $user_account_status = get_user_account_status($action);
    if ($user_account_status != 0) {
        echo "Access denied. You don't have permission to access this page.";
        $action->helper->redirect('/');
        exit;
    }

     $action->view->load('home_header',$data);
     $action->view->load('navbar',$data);
     $action->view->load('home_content',$data);
     $action->view->load('footer');
    });

    //for all resume
    $action->helper->route('database',function() {
    global $action;
    $data['title'] = 'ResumeBank';
    $data['myresumes'] = 'active';
    $data['resumes'] = $action->db->read('resumes', '*');
    $user_account_status = get_user_account_status($action);
    if ($user_account_status != 1 && $user_account_status != 2) {
        echo "Access denied. You don't have permission to access this page.";
        $action->helper->redirect('/');
        exit;
    }

     $action->view->load('all_resume_header',$data);
     $action->view->load('navbar',$data);
     $action->view->load('all_resume',$data);
     $action->view->load('all_resume_footer');
    });

    // Function to get the current user's account status
function get_user_account_status($action) {
    $user_id = $action->user_id();
    $user = $action->db->read('users', 'account_status', "WHERE id='$user_id'");
    return $user[0]['account_status'];
}

// Example usage in the admin_dashboard route
$action->helper->route('admin_dashboard', function() {
    global $action;
    $data['title'] = 'ResumeBank';
    $data['myresumes'] = 'active';
    $data['resumes'] = $action->db->read('resumes', '*');
    $data['users'] = $action->db->read('users', '*',"WHERE account_status=0 OR account_status=1");
    
    $user_account_status = get_user_account_status($action);
    if ($user_account_status != 2) {
        echo "Access denied. You don't have permission to access this page.";
        $action->helper->redirect('home');
        exit;
    }
    
    $users = $action->db->read('users', 'id,full_name', "WHERE id='".$action->user_id()."'");
    $data['user'] = $users[0];
    
    $action->view->load('admin_dashboard', $data);
});

// Example usage in the admin_dashboard route
$action->helper->route('super_admin', function() {
    global $action;
    $data['title'] = 'ResumeBank';
    $data['myresumes'] = 'active';
    $data['resumes'] = $action->db->read('resumes', '*');
    $data['users'] = $action->db->read('users', '*',"WHERE account_status=2");
    
    $user_account_status = get_user_account_status($action);
    if ($user_account_status != 3) {
        echo "Access denied. You don't have permission to access this page.";
        $action->helper->redirect('home');
        exit;
   }
    
    $users = $action->db->read('users', 'id,full_name', "WHERE id='".$action->user_id()."'");
    $data['user'] = $users[0];
    
    $action->view->load('super_admin_dashboard', $data);
});


$action->helper->route('action/add_admin', function() { 
    global $action;
    if (isset($_POST['full_name']) && isset($_POST['email']) && isset($_POST['password'])) {
    
        $error =$action->helper->isAnyEmpty($_POST);
    if($error){
        $action->session->set('error',"$error is empty!");
        print_r($_POST);
        $action->helper->redirect('super_admin');
    
    }else {        
        $signup_data[0]=$action->db->clean($_POST['full_name']);
        $signup_data[1]=$action->db->clean($_POST['email']);
        $signup_data[2]=$action->db->clean($_POST['password']);
        $signup_data[3]= '2';
        $users = $action->db->read('users','email',"WHERE email='$signup_data[1]'");
        if(count($users)> 0) {
            $action->session->set('error',"$signup_data[1] is already registered");
            $action->helper->redirect('super_admin');
        }else {
            $action->db->insert('users','full_name, email, password, account_status', $signup_data);
            $action->session->set('success','Registered Successfully');
            $action->helper->redirect('super_admin');
        }
    }
}});
    


        // Updating Account Status
    $action->helper->route('action/user_update', function() {
        global $action;

        if(isset($_POST['updateBtn'])) {

        $user_id = $_POST['User_id'];
        $account_status = $_POST['account_status'];

        // Perform update query here with the $user_id and $account_status
        // Update query
            $table_name = "users"; // replace with your table name
            $action->db->update($table_name, 'account_status', [$account_status], "id = $user_id");
        $action->helper->redirect('admin_dashboard');}
    });

    


    // For deleting Data
    $action->helper->route('action/user_delete', function() {
        global $action;
        if(isset($_POST['DeleteUserBtn'])) {
        $user_id = $_POST['delete_id'];
        $table_name = "users"; // replace with your table name
        $conditions = "id = $user_id";
        $action->db->delete($table_name, $conditions); // execute the delete query
        $action->helper->redirect('admin_dashboard');
    }
        });

        $action->helper->route('action/super_delete', function() {
            global $action;
            if(isset($_POST['DeleteUserBtn'])) {
            $user_id = $_POST['delete_id'];
            $table_name = "users"; // replace with your table name
            $conditions = "id = $user_id";
            $action->db->delete($table_name, $conditions); // execute the delete query
            $action->helper->redirect('super_admin');
        }
            });
        
    

//for signup
$action->helper->route('signup',function($data) {
    global $action;
    $action->onlyForUnauthUser();
    $data['title'] = 'Signup - ResumeBank';
    $action->view->load('header',$data);
    $action->view->load('signup_page');
    $action->view->load('footer');
});
//for signup action
$action->helper->route('action/signup',function() {
    global $action;
    $error =$action->helper->isAnyEmpty($_POST);
    if($error){
        $action->session->set('error',"$error is empty!");
        $action->helper->redirect('signup');
    
    }else {        
        $signup_data[0]=$action->db->clean($_POST['full_name']);
        $signup_data[1]=$action->db->clean($_POST['email']);
        $signup_data[2]=$action->db->clean($_POST['password']);
        $users = $action->db->read('users','email',"WHERE email='$signup_data[1]'");
        if(count($users)> 0) {
            $action->session->set('error',"$signup_data[1] is already registered");
            $action->helper->redirect('signup');
        }else {
            $action->db->insert('users','full_name, email, password', $signup_data);
            $action->session->set('success','Registered Successfully');
            $action->helper->redirect('login');
        }
    }
});

$action->helper->route('action/super_update', function() {
    global $action;

    

    if(!empty($_POST)) {
        echo'Form submitted';
    $user_id = $_POST['User_id'];
    
    $error =$action->helper->isAnyEmpty($_POST);
    // Perform update query here with the $user_id and $account_status
    // Update query
    }if($error){
        $action->session->set('error',"$error is empty!");
        print_r($_POST);
    }else{
        $signup_data = array(
        $action->db->clean($_POST['full_name']),
        $action->db->clean($_POST['email']),
        $action->db->clean($_POST['password'])
    );
    $users = $action->db->read('users','email',"WHERE email='$signup_data[1]'");
    if(count($users)> 0) {
        $action->session->set('error',"$signup_data[1] is already registered");
        $action->helper->redirect('super_admin');
    }else {
        $table_name = "users"; // replace with your table name
    $action->db->update($table_name, 'full_name,email,password', $signup_data, "id = $user_id");
    $action->helper->redirect('super_admin');
    }
    }
});
//for login
$action->helper->route('login',function($data) {
    global $action;
    $action->onlyForUnauthUser();
    $data['title'] = 'Login - ResumeBank';
    $action->view->load('header',$data);
    $action->view->load('login_content');
    $action->view->load('footer');
});
//for login action
$action->helper->route('action/login', function() {
    global $action;
    
    $error = $action->helper->isAnyEmpty($_POST);
    
    if ($error) {
        $action->session->set('error', "$error is empty!");
    } else {
        $email = $action->db->clean($_POST['email']);
        $password = $action->db->clean($_POST['password']);
        
        $user = $action->db->read('users', 'id, email, account_status', "WHERE email='$email' AND password='$password'");
        
        if (count($user) > 0 ) {
            $user_status = $user[0]['account_status'];
            
            if ($user_status == 0) {
                $action->session->set('Auth', [
                    'status' => true,
                    'data' => $user[0]
                ]);
                
                $action->session->set('success', 'Signed in Successfully');
                $action->helper->redirect('home');
            } elseif ($user_status == 1) {
                $action->session->set('Auth', [
                    'status' => true,
                    'data' => $user[0]
                ]);
                
                $action->session->set('success', 'Signed in Successfully');
                $action->helper->redirect('database');
            } elseif ($user_status == 2) {
                $action->session->set('Auth', [
                    'status' => true,
                    'data' => $user[0]
                ]);
                $action->session->set('success', 'Signed in Successfully');
                $action->helper->redirect('admin_dashboard');
            }elseif ($user_status == 3) {
                $action->session->set('Auth', [
                    'status' => true,
                    'data' => $user[0]
                ]);
                $action->session->set('success', 'Signed in Successfully');
                $action->helper->redirect('super_admin');
        
        } else {
            $action->session->set('error', "Incorrect email or password");
            $action->helper->redirect('login');
        }
        
    }
}});




if(!Helper::$isPageisAvailable) { 
    global $action;

    $data['title'] = 'Error 404';
 $action->view->load('home_header',$data);
 $action->view->load('not_found');
 $action->view->load('footer');
}
                   
?> 