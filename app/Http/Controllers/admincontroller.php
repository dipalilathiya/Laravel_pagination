<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Tbladmin;
use Illuminate\Http\Request;

class admincontroller extends Controller
{
   public function register(Request $req)
   {
      if ($req->session()->has('id')) {
         $errors = [];
         if (isset($req->submit)) {
            $name = $req->name;
            $contact = $req->contact;
            $email = $req->email;
            $password = $req->password;
            $arr = array('name' => $name, 'contact' => $contact, 'email' => $email, 'password' => $password);

            $rules = [
               'name' => 'required|min:3',
               "contact" => 'required|min:10|max:10',
               "email" => 'required|email',
               "password" => [
                  'required',
                  'min:6',
                  'regex:/[a-z]/',
                  'regex:/[A-Z]/',
                  'regex:/[0-9]/',
                  'regex:/[@$!%*#?&]/'
               ]
            ];
            $validation = \Validator::make($arr, $rules);
            if ($validation->fails()) {
               $errors = $validation->errors()->all();
               //  print_r($errors);die();
            } else {
               $data = Tbladmin::where('email', $email)->first();
               if (!$data) {
                  Tbladmin::insert($arr);
                  return redirect('/reg/login');
               } else {
                  echo "<h1>Email already exit</h1>";
               }
            }
         }
         //  $data=Tbladmin::paginate(2);
         return view('welcome')->with('errors', $errors);
      } else {
         return redirect('/reg/login');
      }
   }

   public function login(Request $req)
   {

      if (isset($req->submit)) {
         $email = $req->email;
         $password = $req->password;
         $data = Tbladmin::where('email', $email)->first();
         if ($data->password != $password) {
            echo "<h1>Wrong Password</h1>";
         } else {
            session(['id' => $data->id]);
            return redirect('/reg/viewdata');
         }
      }
      return view('login');

   }
   public function logout(Request $req)
   {
      if ($req->session()->has('id')) {
         $req->session()->flush();
         return redirect('/reg/login');
      }
   }
   public function delete(Request $req, $id)
   {
      Tbladmin::where('id', $id)->delete();
      return redirect('/reg/viewdata');
   }
   public function update(Request $req, $id)
   {
      if (isset($req->submit)) {
         $name = $req->name;
         $contact = $req->contact;
         $email = $req->email;
         $password = $req->password;
         $arr = array('name' => $name, 'contact' => $contact, 'email' => $email, 'password' => $password);
         Tbladmin::where('id', $id)->update($arr);
         return redirect('/reg/viewdata');
      }
      $data = Tbladmin::where('id', $id)->get();
      return view('update')->with('data', $data);
   }
   public function viewdata(Request $req)
   {

      if ($req->session()->has('id')) {
         $filter = $req->filter;
         if (isset($req->filter)) {
            $data = Tbladmin::where('Name', 'Like', '%' . $filter . '%')->paginate(3);
         } else {
            $data = Tbladmin::paginate(3);
         }
         return view('viewdata')->with('data', $data);

      } else {
         return redirect('/reg/login');
      }
   }
}
