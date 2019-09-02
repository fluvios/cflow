<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Zipper;

class ParseController extends Controller
{
    // Function for load index page
    public function index() {
        return view('index'); 
    }

    // Function for processing form in index file
    public function load(Request $request) {
        // check zip file        
        if ($request->hasFile('archive')) {
            // create folder name
            $now = strtotime(date("Y-m-d H:i:s")); 
            $path = public_path().'/file/' . $now;
            File::makeDirectory($path, $mode = 0777, true, true);

            // extract zip file
            Zipper::make($request->file('archive'))->extractTo($path);
            return redirect()->action(
                'ParseController@readDirectory', ['id' => $now]
            );    
        } else {
            echo "File not uploaded!";
        }
    }

    // Function for load file page
    public function readDirectory($id) {
        $files = $this->readFolder($id);

        return view('file', compact('id','files')); 
    }

    // Function for load result page
    public function analyze($id) {
        return view('script', compact('id')); 
    }

    // Function read all files in the folder
    public function readFolder($id) {
        $path = public_path().'/file/' . $id;
        $files = File::allFiles($path);

        foreach( $files as $file ) {
            $filesArr[] = $file->getRelativePathname();
        }        

        return $filesArr;
    }

    // function read specific file
    public function readFile($id,$filename) {
        $path = public_path().'/file/'.$id.'/'.$filename;
        $file = File::get($path);

        return $file;
    }
}
