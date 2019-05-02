<?php
require "../app/models/LoginModel.php";

class LoginService extends Database
{

    public function login($mailuid, $password): bool
    {
        if (empty($mailuid) || empty($password)) {
            return false;
        } else {
            $sql = "SELECT * FROM users WHERE uidUsers = :username OR emailUsers = :email;";
            $statement = $this->conn->prepare($sql);
            //mysqli_stmt_bind_param($statement, "ss", $mailuid, $mailuid);
            $statement->bindParam(":username", $mailuid);
            $statement->bindParam(":email", $mailuid);
            $statement->execute();
            $row = $statement->fetchAll(PDO::FETCH_ASSOC);
            $user = $row[0];
            $dbPassword = $user['pwdUsers'];
            /*if ($row = $statement->fetchAll(PDO::FETCH_ASSOC)) {
                $userId = $row['idUsers'];
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                $pwdCheck = password_verify($hashedPwd, $row['pwdUsers']);

                if ($pwdCheck == false) {
                    return false;
                } else {
                    $_SESSION['userId'] = $userId;
                    return true;
                }
            } else {
                return false;
            }
            */
            if (password_verify($password, $dbPassword)) {
                $userId = $user['idUsers'];
                $username = $user['uidUsers'];
                settype($id, 'int');

                $_SESSION["userId"] = $userId;
                $_SESSION["userUid"] = $username;
                return true;
            }
            else {
                return false;
            }
        }
    }
}