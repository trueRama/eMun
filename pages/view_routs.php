<?php
//application web system calls and routs
global $page;
include ("includes/header.php");
if(isset($_SESSION['user_id'])){
    include ("includes/content_start.php");
    if($page != ""){
        $access = $_SESSION['user_id'];
        echo $access;
        if($access == ""){
            echo header("location:$BASEURL");
        }
        //app page routs
        if($page == "addDoctors"){
            //add doctors to the system
            include ("api_v1/admin/add_doctors.php");
        }elseif ($page == "emunDoctors"){
            //manage doctors
            include ("pages/admin/emun_doctors.php");
        }elseif ($page == "health_hub"){
            //manage health hub
            include ("pages/admin/health_hub.php");
        }elseif ($page == "liveSessions"){
            //assign doctors
            include("pages/admin/emun_sessions.php");
        }elseif ($page == "centers"){
            //assign doctors
            include("pages/admin/emun_centers.php");
        }elseif ($page == "unassigned_ers"){
            //assign doctors
            include("pages/admin/unassigned_ers.php");
        }elseif ($page == "assigned_ers"){
            //assign doctors
            include("pages/admin/assigned_ers.php");
        }elseif ($page == "my_er"){
            //patient er
            include("pages/app/er/my_er.php");
        }elseif ($page == "send_er"){
            //send patient emergency
            include("api_v1/send_er.php");
        }elseif ($page == "send_pr") {
            //send patient emergency
            include("api_v1/send_pr.php");
        }elseif ($page == "appointments"){
            //my_appointments
            include("pages/admin/unassigned_prs.php");
        }elseif ($page == "completed"){
            //my_appointments
            include("pages/admin/assigned_prs.php");
        }elseif ($page == "er_details"){
            //er_details
            include("pages/app/er/er_details.php");
        }elseif ($page == "pr_details"){
            //pr_details
            include("pages/app/pr/pr_details.php");
        }elseif ($page == "stories"){
            //eMun_stories
            include("pages/app/stories/emun_stories.php");
        }elseif ($page == "profile"){
            //user profile
            include ("pages/auth/profile.php");
        }elseif ($page == "logout"){
            if($account_type == "doctor"){
                //Update data
                $messageinsertSQL = "UPDATE emun_doctor SET status = 0 WHERE user_id = '$user_id'";
                $messageinsertQuery = mysqli_query($conn, $messageinsertSQL);
            }
            //logout user
            session_destroy();
//            echo header("location:$BASEURL");
            echo "<meta http-equiv='refresh'; url='$BASEURL'>";
        }
    }else{
        include ("pages/app/dashboard.php");
    }
    include ("includes/content_end.php");
}else{
    //sign_up user
    if($page == "signUp"){
        include ("pages/auth/sign_up.php");
    }
    //login api
    elseif($page == "login_user"){
        include ("api_v1/auth/loginController.php");
    }
    //sign_up api
    elseif ($page == "signUp_user"){
        include ("api_v1/auth/sign-upController.php");
    }else{
        //login user
        include ("pages/auth/login.php");
    }
}
include ("includes/footer.php");