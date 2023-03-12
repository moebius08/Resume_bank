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

        //for logouts
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

            foreach($_POST['college'] as $key=>$value) {
                $education[$key]['college'] =    $action->db->clean($value);
                $education[$key]['course'] =     $action->db->clean($_POST['course'][$key]);
                $education[$key]['e_duration'] = $action->db->clean($_POST['e_duration'][$key]);
            }

            foreach($_POST['company'] as $key=>$value) {
                $work[$key]['company'] = $action->db->clean($value);
                $work[$key]['jobrole'] = $action->db->clean($_POST['jobrole'][$key]);
                $work[$key]['w_duration'] = $action->db->clean($_POST['w_duration'][$key]);
                $work[$key]['work_desc'] = $action->db->clean($_POST['work_desc'][$key]);
            }
            $resume_data[6] = json_encode($work);
            $resume_data[7] = json_encode($education);
            $resume_data[8] = $action->helper->UID();

            $run=$action->db->insert('resumes','user_id,name,headline,objective,contact,skills,experience,education,url', $resume_data);
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
    print_r($data['user']);

    $data['resumes']=$action->db->read('resumes','*',"WHERE user_id=".$action->user_id());


     $action->view->load('home_header',$data);
     $action->view->load('navbar',$data);
     $action->view->load('home_content',$data);
     $action->view->load('footer');
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
    print_r($_POST);
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
$action->helper->route('action/login',function() {
    global $action;
    $error =$action->helper->isAnyEmpty($_POST);
    if($error){
        $action->session->set('error',"$error is empty!");
    }else {
        $email = $action->db->clean($_POST['email']);
        $password = $action->db->clean($_POST['password']);
        $user = $action->db->read('users','id,email',"WHERE email='$email' AND password='$password'");
        if(count($user)>0 ){
            $action->session->set('Auth',['status'=>true,'data'=>$user[0]]);
            $action->session->set('success','Signed in Successfully');
            $action->helper->redirect('home');
        }else {
            $action->session->set('error',"Incorrect email or password");
            $action->helper->redirect('login');
        }
    }
    
});

if(!Helper::$isPageisAvailable) { 
    global $action;

    $data['title'] = 'Error 404';
 $action->view->load('home_header',$data);
 $action->view->load('not_found');
 $action->view->load('footer');
}
                   
?> 