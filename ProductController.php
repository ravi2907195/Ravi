<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class ProductController extends Controller
{

    public function index(){
        $Students = Students::orderby('created_at', 'DESC')->paginate(8);
        return view('products.list', [
            'Students' => $Students
        ]);
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
             $Students = new Students();
        $Students->name = $request->name;
        $Students->email = $request->email;
        $Students->password = $request->password;
        $Students->save();
        return redirect()->route('products.index')->with('success', 'Product added successfully');
    }

    public function edit($id)
    {
        $student = Students::findOrFail($id); // Correcting variable name
        return view('products.edit', compact('student')); // Correcting compact usage
    }
    
    public function update(Request $request, $id)
    {
        $student = Students::findOrFail($id); // Correcting variable name
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = $request->password; // Storing the password directly (not recommended in real apps)
        $student->save();
    
        return redirect()->route('products.index'); // Simple redirection after save
    }
    public function destroy($id){
        $student = Students::findOrFail($id);
        $student->delete();
        return redirect()->route('products.index');
    }

     public function view(){
        return view('login');
     }
     public function profile(){
        return view('profile');
     }

     public function logout(){
       session()->pull('user');
       return redirect()->route('profile');
     }
    public function  login(Request $request){
            $request->session()->put('user',$request->input('user'));
            echo session('user'); 
        return redirect()->route('profile');
        
    }


    public function fileview(){
        return view('fileupload');
    }
    public function upload(Request $request){
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048', // Example validation, customize it as needed
        ]);
    
        // Store the uploaded file in the 'public' directory
        $path = $request->file('file')->store('public');
    
        // Extract the filename using Laravel's basename function
        $filename = basename($path);
    
        // Return the view with the filename
        return view('profile', ['path' => $filename]);
    }
    
    // public function upload(Request $request){
    //     $path = $request->file('file')->store('public');
    //     $fileNameArray = explode('/', $path); // Split by '/' to get the filename
        
    //     $filename = $fileNameArray[1]; // Get the second part (the filename)
    //     return view('profile', ['path' => $filename]);
    // }

    // public function search(Request $request){
    //         $studentdata = Students::Where('name','like',"%$request->search%")->get();
    //         return view('products.list',[
    //           'Students' =>  $studentdata,
    //           'search' => $request->search
    //         ]);
    // }
    public function search(Request $request)
{
    $searchTerm = $request->input('search');

    // Use paginate instead of get to enable pagination
    $studentdata = Students::where('name', 'like', '%' . $searchTerm . '%')
        ->paginate(8); // This will enable the use of links()

    return view('products.list', [
        'Students' => $studentdata,
        'search' => $searchTerm
    ]);
}

    public function deletemultiple(Request $request){
        $result = Students::destroy($request->ids);
      if($result){
        return redirect()->route('products.index');
      }else{
        echo "something went wrong please try again";
      }
    }
          
}
