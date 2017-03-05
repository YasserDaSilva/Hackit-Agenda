<?php
/**
 * Created by PhpStorm.
 * User: Noureddine
 * Date: 19/02/2017
 * Time: 18:09
 */
$error='EOF';
require_once '../Mail/phpMailer.php';

function connection (){
    /*
     * sqlsrv:server = tcp:hackit-dz.database.windows.net,1433;
     *      Database = Hackiy", "ces", "{your_password_here}"
     * */
    $user ='root';
    $password = 'root';
    $db = 'hackit';
    $host = 'localhost';
    $port = 3306;

    try{
        $cnx = @mysqli_connect($host, $user, $password, $db);
    }catch (Exception $exception ){

    }


    if(!$cnx){
        return false;
    }else{
        return $cnx;
    }


}
function getUserByLastName($name){
    $cnx = connection();
    if($cnx!==false)
    {
        $cnx->real_escape_string($name);
        $query = "SELECT * FROM hacker WHERE last_name ='$name'";
        $result = $cnx->query($query);
        $cnx->close();
        if($result!==null)
        {
            return $result;
        }else{
            return null;
        }
    }else{
        return null;
    }
}
function getUserByName($name){
    $cnx = connection();
    if($cnx!==false)
    {
        $cnx->real_escape_string($name);
        $query = "SELECT * FROM hacker WHERE first_name ='$name'";
        $result = $cnx->query($query);
        $cnx->close();
        if($result!==null)
        {
            return $result;
        }else{
            return null;
        }
    }else{
        return null;
    }
}
function getUserByEmail($mail){
    $cnx = connection();
    if($cnx!==NULL)
    {
        $cnx->real_escape_string($mail);
        $query = "SELECT * FROM hacker WHERE email ='$mail'";
        $result = $cnx->query($query);
        $cnx->close();
        if($result!==null)
        {
            return $result;
        }else{
            return null;
        }
    }else{
        return null;
    }
}
function insert($first_name,$last_name,$email ,$phone, $wilaya1 ,$wilaya2,$linkedin,$github,$first_hackit,$your_self,$your_projects)
{
    $mails = getUserByEmail($email);
    while($row = mysqli_fetch_assoc($mails))
    {
        $var = $row['id'];
    }
    $mails = $var;
    if($mails === NULL)
    {
        $cnx = connection();
        if($cnx !== NULL)
        {
            $cnx->real_escape_string($first_name);
            $cnx->real_escape_string($last_name);
            $cnx->real_escape_string($email);
            $cnx->real_escape_string($phone);
            $cnx->real_escape_string($wilaya1);
            $cnx->real_escape_string($wilaya2);
            $cnx->real_escape_string($linkedin);
            $cnx->real_escape_string($github);
            $cnx->real_escape_string($first_hackit);
            $cnx->real_escape_string($your_self);
            $cnx->real_escape_string($your_projects);

            $query = "INSERT INTO hacker(id, first_name, last_name, email, phone, wilaya1, wilaya2, linkedin, github, first_hackit, your_self, your_projects) VALUES (NULL ,'$first_name' ,'$last_name','$email','$phone','$wilaya1','$wilaya2','$linkedin','$github','$first_hackit','$your_self','$your_projects')";


            $result=$cnx->query($query);
            $cnx->close();
            if($result){
                return true;
            }else{
                $GLOBALS['error']  ='Server error ';
                return false;
            }
        }
        else
        {
            $GLOBALS['error']  ='cnx error';
        }
    }
    else
    {
        $GLOBALS['error']  = 'mail exist';
    }

    return NULL;

}

function check($string){
    $string = strip_tags($string);
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    $string = htmlspecialchars($string, ENT_QUOTES);
    return $string;
}

function mailvalidation($mail){
    $exp = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/';
    if(preg_match($exp , $mail)){
        return true;
    }else{
        return false;
    }
}
function phoneValidation($phone){
    $exp = '/^(((00213|\+213|0)(5|6|7)[0-9]{8})|)$/';
    if(preg_match($exp,$phone)){
        return true;
    }else{
        return false;
    }
}


if(isset($_POST['first_name']) )
{
    if(!empty($_POST['first_name']) )
    {
        $first_name = check($_POST['first_name']);
        if (!preg_match("/^[a-zA-Z]{3,40}( [a-zA-Z]{3,40}){0,2}$/",$first_name))
        {
            $class_div='first_name';
            $reponse = "Only letters allowed in name";
        }
        else
        {
            if(isset($_POST['last_name']) )
            {
                if(!empty($_POST['last_name']) )
                {
                    $last_name = check($_POST['last_name']);
                    if (!preg_match("/^[a-zA-Z]{3,40}( [a-zA-Z]{3,40}){0,2}$/",$last_name))
                    {
                        $class_div='last_name';
                        $reponse = "Only letters allowed in last name";
                    }
                    else
                    {
                        if(isset($_POST['email']) )
                        {
                            if(!empty($_POST['email']) )
                            {
                                $email = check($_POST['email']);
                                if(!mailvalidation($email))
                                {
                                    $class_div = 'email';
                                    $reponse = 'mail invalide';
                                }
                                else
                                {
                                    if (isset($_POST['phone']) && isset($_POST['wilaya1']) && isset($_POST['wilaya2']) && isset($_POST['linkedin']) && isset($_POST['github']) )
                                    {
                                        if(isset($_POST['first_hackit']) && isset($_POST['your_self']) &&isset($_POST['your_projects']))
                                        {
                                            if(phoneValidation($_POST['phone'])){
                                                $first_name = check($_POST['first_name']);
                                                $last_name = check($_POST['last_name']);
                                                $email = check($_POST['email']);
                                                $phone = check($_POST['phone']);
                                                $wilaya1 = check($_POST['wilaya1']);
                                                $wilaya2 = check($_POST['wilaya2']);
                                                $linkedin = check($_POST['linkedin']);
                                                $github = check($_POST['github']);
                                                $first_hackit = check($_POST['first_hackit']);
                                                $your_self = check($_POST['your_self']);
                                                $your_projects = check($_POST['your_projects']);

                                                if(!empty($wilaya1)){
                                                    if(!empty($your_self)){
                                                        if(!empty($your_projects)) {

                                                            $result = insert($first_name, $last_name, $email, $phone, $wilaya1, $wilaya2, $linkedin, $github, $first_hackit, $your_self, $your_projects);
                                                            if ($result === true) {
                                                                $class_div = '';
                                                                try {
                                                                    $reponse = 'OK';
                                                                    mailTo($email, $first_name, $last_name);
                                                                } catch (Exception $ex) {
                                                                    $reponse = 'OK';
                                                                }

                                                            } else {
                                                                $class_div = '';
                                                                $reponse = $your_projects.' '.$your_self;
                                                            }
                                                        }else{
                                                            $class_div="your_projects";
                                                            $reponse='about your projects is required';
                                                        }
                                                    }else{
                                                        $class_div="your_self";
                                                        $reponse='about yourself is required';
                                                    }
                                                }else{
                                                    $class_div="wilaya1";
                                                    $reponse='school is required';
                                                }
                                            }
                                            else{
                                                $class_div="phone";
                                                $reponse = 'phone number invalid';
                                            }
                                        }
                                        else
                                        {
                                            $class_div="phone";
                                            $reponse = 'Form error';
                                        }

                                    }
                                    else
                                    {
                                        $class_div ='phone';
                                        $reponse = 'Form error';
                                    }


                                }
                            }
                            else
                            {
                                $class_div = 'email';
                                $reponse='mail is required';
                            }
                        }
                        else
                        {
                            $class_div = 'email';
                            $reponse = 'Form error';
                        }
                    }
                }
                else
                {
                    $class_div='last_name';
                    $reponse='last name is required';
                }
            }
            else
            {
                $class_div='last_name';
                $reponse = 'Form error';
            }

        }
    }
    else
    {
        $class_div='first_name';
        $reponse='Name is required';
    }
}
else
{
    $class_div = 'first_name';
    $reponse = 'Form error';
}



echo json_encode(['reponse' => $reponse,'class_div'=>$class_div]);

?>
