<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use APP\Shop\Entity\Merchandise;
use APP\Shop\Entity\transaction;
use APP\Shop\Entity\User;
use Illuminate\Auth\Events\Validated;
use Validator;
use image;
use BD;
use Exception;

class MerchandiseController extends Controller{
    //先新增商品資料
    public function merchandiseCreatProcess(){
        //商品基本資料
        $merchandise_data = [
            'status'  => 'c',
            'name' => '',
            'name_en' => '',
            'introduction' => '',
            'introduction_en' => '',
            'photo' =>'',
            'price' => '0',
            'remain_count' => '0'
        ];
    $Merchandise = Merchandise::create($merchandise_data);

    return redirect('/merchandise/' . $Merchandise->id .'/edit');
    }
//處理商品資料
    public function merchandiseItemEditPage($Merchandis_id){
        //取得商品資料
        $Merchandise = Merchandise::findOrFail($Merchandis_id);
        if(!is_null($Merchandise->photo)){
            $Merchandise->photo = url($Merchandise->photo);
        }

        $biding = [
            'title' => '編輯商品',
            'Merchandise' => $Merchandise
        ];
        return view('merchandise.editMerchandise',$biding);

    }
    public function MerchandisePutProcess(){
        $Merchandise= Merchandise::findOrFail($Merchandis_id);
        $input = request()->all();
        //驗證規則
        $rules = [
            'status' =>[
                'required', 'in:C,S'
            ],
            'mame' =>[
                'reqired','max:50'
            ],
            'mame_en' =>[
                'reqired','max:50'
            ],
            'introduction' =>[
                'reqired','max:2000'
            ],
            'introduction_en' =>[
                'reqired','max:2000'
            ],
            'price' =>[
                'reqired','integer','min:0'
            ],
            'photo'=>[
                'file','image','max:10240'//10mb
            ],
            'remain_count' =>[
                'reqired','integer','min:0'
            ],
        ];

        //驗證資料
        $validator = Validator::make($input,$rules);

        if($validator->fauls){
            return redirect('/merchandise/'.$Merchandise->id.'/edit')->withErrors($validator)->withInput();
        }

        $merchandise_id = $Merchandise->id;

        //處理商品照片
        if(isset($input['photo'])){
            $photo = $input['photo'];
            $file_ext = $photo->getClienOriginalExtension();
            $file_name = uniqid(). ".".$file_ext;
            $file_relative_path = "image/merchdise/".$file_name;
            $file_path = public_path($file_relative_path);
            $image =  Image::make($photo)->fit(450,300)->save($file_path);
            $input['photo'] = $file_relative_path;
        }

        //更新商品資料
        $Merchandise->update($input);
        return redirect('merchandise/'.$Merchandis->id.'/edit');
    }



//商品管理清單
    public function MerchandiseManageListPage(){
            $row_page=1;

            $MerchandisePaginate = Merchandise::orderBy('creat_at','desc')
                            ->paginate($row_page);
            foreach($MerchandisePaginate as $Merchandise){
                if(!is_null($Merchandise->photo)){
                    $Merchandise->photo = url($Merchandise->photo);
                }
            }
            $biding = [
                'title' => '管理商品',
                'MerchandisePaginate' =>  $MerchandisePaginate
            ];

            return view('merchandise.listMerchandise',$biding);
        }


    //商品清單頁
    public function MerchandiseListPage(){
        $row_page=1;

            $MerchandisePaginate = Merchandise::orderBy('creat_at','desc')
                                            ->where('status','s') //可販售
                                            ->paginate($row_page);
            foreach($MerchandisePaginate as $Merchandise){
                if(!is_null($Merchandise->photo)){
                    $Merchandise->photo = url($Merchandise->photo);
                }
            }
            $biding = [
                'title' => '商品列表',
                'MerchandisePaginate' =>  $MerchandisePaginate
            ];

            return view('merchandise.listMerchandise',$biding);
        }
        //商品單品資料檢測
        public function MerchandiseItemPage($Merchandis_id){
            //取得商品資料
            $Merchandise = Merchandise::where('Status','s')->findOrFail($Merchandis_id);
            if(!is_null($Merchandise->photo)){
                $Merchandise->photo = url($Merchandise->photo);
            }

            $bidding = [
                'title' => '商品頁',
                'Merchandise' => $Merchandise
            ];
            return view('merchandise.showMerchandise',$bidding);

        }
        //商品購買
        public function MerchdiseItemBuyProcess($Merchandis_id){
            $input = request()->all();

            //驗證規則
            $rules = [
                'buy_count' =>[
                'required','integer','min:1'
            ]
            ];


            //驗證資料
            $validator = Validated::make($input, $rules);

            if($validator->fails()){
                return redirect('/machdise/'.$Merchandis_id)->withErrors($validator)->withInput();

            }
            //這點在這 鎖住
            try{
                $user_id = session()->get('user_id');
                $User = User::findOrFail($user_id);

            //交易開始
            DB::beginTransaction();

            $Merchandise =  Merchandise::findOrFail($Merchandise_id);

            $buy_count =$input('buy_count');

            $after_buy_count = $Merchandise->remin_count - $buy_count
            if($after_buy_count<0){
                throw new Exception('商品數量不足');
            }
            $Merchandise->remin_count = $after_buy_count;
            $Merchandise->save();

            $all_price  =  $buy_count * $Merchandise->price;

            $transaction_data = [
                'user_id'=> $User->id,
                'merchandise_id' => $Merchandise->id,
                'price' => $Merchandise->price,
                'buy_count' => $buy_count,
                'total_price' =>$all_price
            ];

            transaction::creat($transaction_data);


            DB::commit();

            $message =[
                'msg' ==>[
                    '購買成功!'
                ]
            ];

            return redirect()
                        ->to('/merchandise/' .$Merchandise->id)
                        ->withErrors($message);



            }catch(Exception $exception){

            DB::rollback();

            $errormessage =[
                'msg' =>[
                    $exception->getMessage()
                ]
            ];

            return redirect()
                        ->back()
                        ->withErrors($errormessage)
                        ->withInput();


        }



        }
    }
?>
