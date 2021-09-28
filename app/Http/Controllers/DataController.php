<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DataController extends Controller
{

    public function insertdata(Request $request) {
        
        if($request->submit)
        {
            $validated = $request->validate([
                'fname'     => 'required',
                'lname'     => 'required',
                'email'     => 'required|unique:students',
                'pwd'       => 'required',
                'contact'   => 'required',
                'gender'    => 'required',
                'dd'        => 'required',
                'mm'        => 'required',
                'yy'        => 'required',
                // 'entrydate' => 'required',
                'hobby'     => 'required',
                'image'     => 'required',
            ]);

            if($request->file()) 
            {
                $fileName = time().'-'.$request->image->getClientOriginalName();
                $request->image->move('upload/', $fileName);
            }
            else
            {
                $fileName = "";
            }
            
            $birthdateArr = array($request->dd,$request->mm,$request->yy);
            $birthdate = implode("-", $birthdateArr);

            $hobbyArr = $request->hobby;
            if(!empty($hobbyArr))
            {
                $hobbyStr = implode(",", $hobbyArr);
            }
            else
            {
                $hobbyStr = "";
            }

            $saveArr = array(
                'fname'     => $request->fname,
                'lname'     => $request->lname,
                'email'     => $request->email,
                'pwd'       => $request->pwd,
                'contact'   => $request->contact,
                'gender'    => $request->gender,
                'birthdate' => $birthdate,
                // 'entrydate' => $request->entrydate,
                'hobby'     => $hobbyStr,
                'image'     => $fileName
            );

            DB::table('students')->insert($saveArr);
            return redirect('/view');
        }
        return view('insertdata');
    }


    public function viewdata(Request $request) {

        $searchTxt = $request->get('searchTxt');
        // echo $searchTxt;

        if($searchTxt == "")
        {
            $users = DB::table('students')->Paginate(3);
            // echo "<pre>";
            // print_r($users); die;
        }
        else
        {
            $users = DB::table('students')->where('fname','like','%'.$searchTxt.'%')->orWhere('email','like','%'.$searchTxt.'%')->Paginate(3);
            // echo "<pre>";
            // print_r($users); die;
            $users->appends(['searchTxt'=>$searchTxt]);
        }

        $array['myusers'] = $users;
        $array['title'] = 'Laravel - Milan';
        return view('viewdata',$array);
    }



    public function updatedata(Request $request,$edit_id) {

        $user = DB::table('students')->where('id',$edit_id)->first();
        // echo "<pre>";
        // print_r($user); die;
            
        $array['user'] = $user;
        $array['hobby'] = explode(',', $user->hobby);    
        $array['birthdate'] = explode('-', $user->birthdate);

        if($request->submit)
        {
            $validated = $request->validate([
                'fname'     => 'required',
                'lname'     => 'required',
                'email'     => 'required',
                'pwd'       => 'required',
                'contact'   => 'required',
                'gender'    => 'required',
                'dd'        => 'required',
                'mm'        => 'required',
                'yy'        => 'required',
                // 'entrydate' => 'required',
                'hobby'     => 'required',
            ]);
            if($request->file()) 
            {
                $fileName = time().'-'.$request->image->getClientOriginalName();
                $request->image->move('upload/', $fileName);
                if(!empty($user->image))
                {
                    unlink(public_path('upload/'.$user->image));            
                }
                else
                {
                    $user->image = "";
                }
            }
            else
            {
                $fileName = @$user->image;
            }

            $birthdateArr = array($request->dd,$request->mm,$request->yy);
            $birthdate = implode("-", $birthdateArr);

            $hobbyArr = $request->hobby;
            $hobbyStr = implode(",", $hobbyArr);

            $saveArr = array(
                'fname'     => $request->fname,
                'lname'     => $request->lname,
                'email'     => $request->email,
                'pwd'       => $request->pwd,
                'contact'   => $request->contact,
                'gender'    => $request->gender,
                'birthdate' => $birthdate,
                // 'entrydate' => $request->enterydate,
                'hobby'     => $hobbyStr,
                'image'     => $fileName
            );

            DB::table('students')->where('id',$edit_id)->update($saveArr);
            return redirect('/view');

        }

        return view('insertdata',$array);
    }


    public function deletedata($delete_id) {

        $user = DB::table('students')->where('id',$delete_id)->first();
        // echo "<pre>";
        // print_r($user); die;
        
        if(!empty($user->image))
        {
            unlink(public_path('upload/'.$user->image));            
        }
        else
        {
            $user->image = "";
        }
        
        DB::table('students')->where('id',$delete_id)->delete();
        return redirect('/view');
    }  

}