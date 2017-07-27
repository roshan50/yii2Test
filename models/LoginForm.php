<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        //if ($this->validate()) {

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
       // }
        // return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }

    //I add this function according to http://www.larryullman.com/
    //Simple%20Authentication%20with%20the%20Yii%20Framework%20_%20Larry%20Ullman.htm

    public function authenticate($attribute,$params)
    {
        if (!$this->hasErrors())  // we only want to authenticate when no input errors
        {
            $identity = new UserIdentity($this->username, $this->password);
            $identity->authenticate2();
            switch ($identity->errorCode){
                case UserIdentity::ERROR_NONE:
                    $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
                    Yii::app()->user->login($identity,$duration);
                    break;
                case UserIdentity::ERROR_USERNAME_INVALID:
                    $this->addError('username','Username is incorrect.');
                    break;
                default: // UserIdentity::ERROR_PASSWORD_INVALID
                    $this->addError('password','Password is incorrect.');
                    break;
            }
        }
    }


//    public function authenticate2(){
//        $user = User::model()->findByAttributes(array('username'=>$this->username));
//        if ($user===null) { // No user found!
//            $this->errorCode=self::ERROR_USERNAME_INVALID;
//        } else if ($user->pass !== SHA1($this->password) ) { // Invalid password!
//            $this->errorCode=self::ERROR_PASSWORD_INVALID;
//        } else { // Okay!
//            $this->errorCode=self::ERROR_NONE;
//        }
//        return !$this->errorCode;
//    }
}
