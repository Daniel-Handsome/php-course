<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Shop\Entity\User;//使用者 ORM Model
use Validator; //驗證器
use hash; //雜湊
use Mail; //郵件

//sigh
  //註冊頁
    class UserAuthController extends Controller{

        public function SignUpPage(){
            $Binding = [
                'title' => '註冊',
            ];
            return view('auth.signUp',$Binding);
        }
//處理註冊資料
        public function SignUpProcess(){

            $input = request()->all();
//判斷規則
            $rules = [
                'nickname'=>[
                    'required','max:50'
                ],
                'email'=>[
                    'required','max:50','email'
                ],
                'password'=>[
                    'required','min:6','max:20','same:password_repeat'
                ],
                'password_repeat'=>[
                    'required','min:6','max:20'
                ],
                'type'=>[
                    'required','in:A,G'
                ]
            ];
            //驗證資料
            $validator=Validator::make($input, $rules);
            if($validator->fails()){
                return redirect('user/auth/sign-up')->withErrors($validator)->withInput();
            }
                 //密碼加密
            $input['password']= Hash::make($input['password']);

                 //var_dump($input);

                 //註冊通知信
                    $mail_binding=[
                        'nickname' =>$input['nickname']
                    ];

                Mail::send('email.SignUpEmail', $mail_binding,
                function($mail) use($input){
                    //收件人
                    $mail->to($input["email"]);
                    //寄件人
                    $mail->from("adwxsghu@gmail.com");
                    //主旨
                    $mail->subject("恭喜註冊 Shop laravel 成功");
                });

                redirect('user/auth/sign-in');
        }

    //登入頁面
    public  function SignInPage(){
        $binding=[
            'title' => '會員登入'
        ];
        return view('auth.signIn',$binding);
    }
       //登入驗證
    public function SingInProcess(){
        $input = request()->all();
        //判斷規則
                    $rules = [

                        'email'=>[
                            'required','min:50','email'
                        ],
                        'password'=>[
                            'required','min:6','max:20','same:password_repeat'
                        ],
                    ];
                    //驗證資料 p1
                    $validator=Validator::make($input, $rules);

                    if($validator->falls()){
                        return redirect('user/auth/sigh-in')->withErrors($validator)->withInput();
                    }

                    //驗證資料 p2
                    $User = User::where('email',$input['email'])->firstOrFail();

                    //檢查密碼

                    $Password_check = Hash::check($input['pasword'],$User->password );

                    //驗證失敗
                    if(!$Password_check){
                        $error_message = [
                            'msg' =>['密碼驗證失敗']
                        ];
                        return redirect('user/auth/sigh-in')->withErrors($Password_check)->withInput();
                    }
                    //密碼驗證成功
                    session()->put('user_id',$User->id);

                    return redirect()->retended('/user/auth/sign-in');

                }
       //會員登出
        public function signOut(){
            session()->forget('user_id');

            return redirect('/user/auth/sign-in');

        }
}
    ?>
