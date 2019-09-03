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

    // Function find COG files in directory
    public function getDirContents($dir, $filter = '', &$results = array()) {
        $files = scandir($dir);
    
        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value); 
    
            if(!is_dir($path)) {
                if(empty($filter) || preg_match($filter, $path)) 
                    $results[] = array(
                                        'name' => basename($path),
                                        'path' => $path,
                                        'content' => File::get($path)
                                    );
            } elseif($value != "." && $value != "..") {
                $this->getDirContents($path, $filter, $results);
            }
        }
    
        return $results;
    }

    // Function for load file page
    public function readDirectory($id) {
        $path = public_path().'/file/' . $id;
        // $files = $this->readFolder($id);

        // find all .COG files
        $files = $this->getDirContents($path,'/\.cog$/');
        return view('file', compact('id','files')); 
    }

    // Function for load result page
    public function analyze($id) {
        $path = public_path().'/file/' . $id;
        // $files = $this->readFolder($id);

        // find all .COG files
        $files = $this->getDirContents($path,'/\.cog$/');
        foreach($files as $file){
            $codeline = [];
            if ($fh = fopen($file['path'], 'r')) {
                while (!feof($fh)) {
                    $line = fgets($fh);
                    array_push($codeline, $line);
                }
                fclose($fh);
            }

            $codes = array(
                'name' => $file['name'],
                'flist' => $codeline);
        }
        
        return view('script', compact('id','codes'));
    }

    // Function read all files in the folder
    // public function readFolder($id) {
    //     $path = public_path().'/file/' . $id;
    //     $files = File::allFiles($path);

    //     foreach( $files as $file ) {
    //         $filesArr[] = $file->getRelativePathname();
    //     }        

    //     return $filesArr;
    // }

    // function read specific file
    public function readFile($id,$name) {
        $path = public_path().'/file/' . $id;
        // $files = $this->readFolder($id);

        // find all .COG files
        $files = $this->getDirContents($path, '/\.cog$/');
        foreach($files as $file){
            if($file['name'] == $name) {
                $result = $file['content'];
            }
        }

        return $result;
    }
    
}
