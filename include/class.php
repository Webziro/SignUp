<?php

class UserClass extends Database
{
   //Create Account/Sign up
    public function signUp($data): array
    {
        $name = htmlspecialchars($data['name']);
        $email = htmlspecialchars($data['email']);
        $password = htmlspecialchars($data['password']);
        $confirmpassword = htmlspecialchars($data['re_password']);

        if(strlen($password)<8){
            $response = array(
               "status"=>0,
                "message"=>"Password Length Must be atleast 8 Characters!",
            );
        }else if(!preg_match('/[\'^£$%&*()}{@#~?>`>,|=_+¬-]/', $password)){
$response = array(
"status"=>0,
"message"=>"Password Should Contain atleast one Special Character",
);

}else if(!preg_match('/[A-Z]/', $password)){
$response = array(
"status"=>0,
"message"=>"Password Should Contain an Uppercase",
);

}else if(empty($name) || empty($email) || empty($password) || empty($confirmpassword)){
$response = array(
"status" => 0,
"message" => "Please all Fields!"
);

}else{
if($confirmpassword != $password){
$response = array(
"status" => 0,
"message" => "There was a Password Mismatch, Try again!"
);
}else{
$stmt = $this->prepare("SELECT sys_email FROM ". reg ." WHERE sys_email = :email");
$stmt->bindParam(":email", $email);
$stmt->execute();
if ($stmt->rowCount() > 0) {
$response = array(
"status" => 0,
"message" => "Email address already in use!"
);
} else {
$hash = password_hash("$password", PASSWORD_DEFAULT);
$stmt = $this->prepare("INSERT INTO " . reg . " (sys_name, sys_email, sys_password) VALUES ( :name, :email, :password)
");
$stmt->bindParam(":name", $name);
$stmt->bindParam(":email", $email);
$stmt->bindParam(":password", $hash);
$stmt->execute();
if ($stmt->rowCount() > 0) {
$response = array(
"status" => 1,
"message" => "Account Signup Successful"
);
} else {
$response = array(
"status" => 0,
"message" => "Something went wrong, try again!"
);
}
}

}

}

return $response;

}



//Create Login
public function Login($email, $password):array
{
$stmt = $this->prepare("SELECT id as id, sys_password as _password FROM ".reg." WHERE sys_email = :email" );
$stmt->bindParam(":email", $email);
$stmt->execute();
if($stmt->rowCount()>0){

$userData = $stmt->fetch(PDO::FETCH_ASSOC);
if(password_verify($password, $userData['_password'])){

$response = array(
"status" => 1,
"userid" => $userData['id']
);
}else{

$response = array(
"status" => 0,
"message" => "Invalid Password!"
);

}
}else{
$response = array(
"status" => 0,
"message" => "Invalid Email!"
);
}
return $response;
}
}

?>