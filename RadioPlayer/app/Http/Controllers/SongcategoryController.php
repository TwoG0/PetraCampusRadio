<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoresongcategoryRequest;
use App\Http\Requests\UpdatesongcategoryRequest;
use App\Models\User;
use App\Models\songcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\song;
use getID3;


class SongcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        return view('pages.song');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresongcategoryRequest $request)
    {
        //Create category
        $folderName = $request->input('folder-name');
        $songcategory = songcategory::where('name', $folderName)->first();
        if ($songcategory == null) {
            $newFolder = new songcategory;
            $newFolder->name = $folderName;

            //Create Song
            $durationInSeconds = 0;

            $files = $request->file('music-file'); // file is an array
            $uploadedFiles = [];

            foreach ($files as $file) {
                // dd($file->getClientOriginalName()); // Debugging line, remove in production

                if ($file->isValid()) {
                    // Generate a hash of the file content to check for duplicates
                    $fileHash = md5_file($file->getPathname());

                    // Check if a file with the same hash already exists
                    $existingFiles = Storage::disk('public')->allFiles('songs');
                    $fileExists = false;

                    foreach ($existingFiles as $existingFile) {
                        if ($fileHash === md5_file(storage_path('app/public/' . $existingFile))) {
                            $fileExists = true;
                            break;
                        }
                    }

                    if (!$fileExists) {
                        // Save the file to the storage/app/public/songs directory using its original name
                        $path = $file->storeAs('songs', $file->getClientOriginalName(), 'public');

                        // Analyze the file for duration
                        $getID3 = new getID3();
                        $fileInfo = $getID3->analyze($file->getPathname());

                        // Get the duration
                        if (isset($fileInfo['playtime_seconds'])) {
                            $durationInSeconds = $fileInfo['playtime_seconds']; // Duration in seconds
                            $songName = $file->getClientOriginalName();
                            $song = song::where('name', $songName)->first();
                            if ($song == null) {
                                $newSong = new song;
                                $newSong->name = $songName;
                                $newSong->length = $durationInSeconds;
                                $newSong->path = $path;
                                $newSong->save();
                                $uploadedFiles[] = $newSong->id;
                            }
                            // $minutes = floor($durationInSeconds / 60);
                            // $seconds = floor($durationInSeconds % 60);
                            // $milliseconds = ($durationInSeconds - floor($durationInSeconds)) * 1000;

                            // // Format the duration as MM:SS.mmm
                            // $formattedDuration = sprintf('%02d:%02d.%02d', $minutes, $seconds, $milliseconds);

                            // Save or process the song information
                            // Example: $song = Song::create(['name' => $file->getClientOriginalName(), 'duration' => $formattedDuration]);
                        } else {
                            $durationInSeconds = 0;
                        }

                        
                    }
                }
            }
            

        }


        // dd($request->file('music-file') == null); //Pengecekan apakah file music null atau tidak
        // dd($request->file('music-file')); 
        // dd($request->input('folder-name'), $request->file('music-file'), $request);
        // dd($request->input('folder-name'));



        return redirect('/song');
        // $songcategory = new Songcategory();
    }

    /**
     * Display the specified resource.
     */
    public function show(songcategory $songcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(songcategory $songcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesongcategoryRequest $request, songcategory $songcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(songcategory $songcategory)
    {
        //
    }
}
