<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\SongCategory;
use App\Models\Song;
use Illuminate\Support\Str;
use getID3;

class Songfolder extends Component
{

    use WithFileUploads;
    public $folderName; //Variable menampung input folder name
    public $musicFiles = []; //Variable menampung lagu sebelum di upload (Add new Folder)
    public $tempFiles = [];
    public $musicFiles2 = []; //Variable menampung lagu sebelum di upload (Upload New Song)
    public $tempFiles2 = [];
    public $showModal = false; //Show Modal Add New Folder
    public $showModalSong = false; //Show Modal Upload New Song
    public $folders; //GET Semua Folder dari Databases
    public $FolderIsOpen; //Menyimpan Folder yang dibuka
    public $SongIsOpen = []; //Menyimpan lagu yang dibuka berdasarkan folder yang dibuka
    public $songName = []; //Wire:model element input: SongNameInput
    public $songMoveId;
    public $songMoveSearch;
    public $searchFoundFolder;

    public function render()
    {
        return view('livewire.songfolder');
    }

    public function mount()
    {
        $this->folders = songcategory::get();
        // 
    }

    public function saveFolderIsOpen($folder)
    {
        $this->FolderIsOpen = $folder;
        if (!empty($this->SongIsOpen)) {
            $this->SongIsOpen = [];
            $this->songName = [];
        }
        foreach (json_decode($folder['song_id']) as $songid) {
            $this->SongIsOpen[] = song::find($songid);
            $this->songName[] = song::find($songid)->name;
        }
    }

    public function updatedMusicFiles2()
    {
        foreach ($this->musicFiles2 as $file) {
            if (!$this->fileExistsInTempFiles($file, $this->tempFiles2)) {
                $this->tempFiles2[] = $file;
            }
        }

        $this->musicFiles2 = $this->tempFiles2;
        $this->showModalSong = true;
        // dd('hello');
    }
    public function updatedMusicFiles()
    {
        foreach ($this->musicFiles as $file) {
            if (!$this->fileExistsInTempFiles($file, $this->tempFiles)) {
                $this->tempFiles[] = $file;
            }
        }

        $this->musicFiles = $this->tempFiles;

        $this->showModal = true;
    }

    private function fileExistsInTempFiles($file, $files)
    {
        foreach ($files as $tempFile) {
            if ($tempFile->getClientOriginalName() === $file->getClientOriginalName()) {
                session()->flash('error', 'Song already uploaded.');
                return true;
            }
        }
        return false;
    }
    public function removeFile($file)
    {
        // Remove file from tempFiles
        $this->tempFiles = array_filter($this->tempFiles, function ($tempFile) use ($file) {
            return $tempFile->getClientOriginalName() !== $file;
        });

        // Re-index tempFiles array
        $this->tempFiles = array_values($this->tempFiles);

        // Remove file from musicFiles
        $this->musicFiles = array_filter($this->musicFiles, function ($musicFile) use ($file) {
            return $musicFile->getClientOriginalName() !== $file;
        });

        // Re-index musicFiles array
        $this->musicFiles = array_values($this->musicFiles);
        $this->showModal = true;

    }

    public function removeFile2($file)
    {
        // Remove file from tempFiles
        $this->tempFiles2 = array_filter($this->tempFiles2, function ($tempFiles2) use ($file) {
            return $tempFiles2->getClientOriginalName() !== $file;
        });

        // Re-index tempFiles array
        $this->tempFiles2 = array_values($this->tempFiles2);

        // Remove file from musicFiles
        $this->musicFiles2 = array_filter($this->musicFiles2, function ($musicFiles2) use ($file) {
            return $musicFiles2->getClientOriginalName() !== $file;
        });

        // Re-index musicFiles array
        $this->musicFiles2 = array_values($this->musicFiles2);
        $this->showModalSong = true;

    }

    public function convertSongLength($seconds)
    {
        $minutes = floor($seconds / 60); // Menghitung jumlah menit
        $remainingSeconds = $seconds % 60; // Mendapatkan sisa detik
        return sprintf('%02d:%02d', $minutes, $remainingSeconds);
    }

    public function setSongMoveId($songId)
    {
        $this->songMoveId = $songId;
        $this->searchFoundFolder = $this->folders;
    }

    public function unsetSongMoveId()
    {
        $this->songMoveId = null;
        $this->searchFoundFolder = null;
        $this->songMoveSearch = "";
    }

    public function searchFolderForMoveSong()
    {
        if (trim($this->songMoveSearch) != "") {
            $this->searchFoundFolder = [];
        } else {
            $this->searchFoundFolder = $this->folders;
        }
        foreach ($this->folders as $folder) {
            if (Str::contains($folder->name, $this->songMoveSearch)) {
                $this->searchFoundFolder[] = $folder;
            }
        }
        // dd($this->searchFoundFolder);
    }

    public function moveSong($folderid)
    {
        $newsongcat = SongCategory::find($folderid);
        $songidarr = json_decode($newsongcat->song_id, true);
        $songidarr[] = $this->songMoveId;
        $songidarr = json_encode($songidarr);
        $newsongcat->song_id = $songidarr;
        $newsongcat->save();

        $oldsongcat = SongCategory::find($this->FolderIsOpen['id']);
        $oldsongidarr = json_decode($oldsongcat->song_id, true);
        $oldsongidarr = array_filter($oldsongidarr, function ($id) {
            return $id !== $this->songMoveId;
        });
        $oldsongidarr = array_values($oldsongidarr);
        $oldsongcat->song_id = json_encode($oldsongidarr);
        $oldsongcat->save();

        $this->mount();
        $this->saveFolderIsOpen($oldsongcat);

        $this->unsetSongMoveId();
        $songMoveSearch = "";
        $searchFoundFolder = null;


        // dd(SongCategory::find($folderid)->song_id);
        // $tempSongIdArr = 
    }

    public function renameSong($song, $index)
    {
        if (trim($this->songName[$index]) === "") {
            // dd($this->songName[$index]);
            $this->songName[$index] = $this->SongIsOpen[$index]->name;

        } else {
            $getSong = song::find($song['id']);
            $getSong->name = $this->songName[$index];
            $getSong->save();
        }
        // if (trim($text) === "") {
        //     $getSong = song::find($song['id']);
        //     $getSong->name = 'untitled song';
        //     $getSong->save();
        //     $this->SongIsOpen = [];
        //     foreach (json_decode($this->FolderIsOpen['song_id'],true) as $id) {
        //         $this->SongIsOpen[] = song::find($id);
        //     }
        //     dd(json_decode($this->SongIsOpen[0], true));

        // }
        // dd($song['id'], $text);
        return;
    }

    public function renameFolder($file, $text)
    {
        foreach ($this->folders as $folder) {
            if ($folder->name == $file['name']) {
                if ($folder->name == $text) {
                    session()->flash('renameError', 'There was existing folder');
                    return;
                }
            }
        }
        $getFolder = SongCategory::find($file['id']);
        $getFolder->name = $text;
        $getFolder->save();
        $this->folders = songcategory::get();
        session()->flash('renameSuccess', 'Successfully Rename');
        return;

    }

    public function resetAllSessions()
    {
        session()->forget('renameError');
        session()->forget('renameSuccess');
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->showModalSong = false;
    }



    public function submit()
    {
        // Validate the input
        $this->validate([
            'folderName' => 'required|string|max:255',
            'musicFiles.*' => 'file|mimes:mp3,wav|max:20480',
        ]);

        // Check if the folder/category exists
        $songcategory = SongCategory::where('name', $this->folderName)->first();

        $uploadedFiles = [];

        if ($songcategory === null) {
            foreach ($this->musicFiles as $file) {
                if ($file->isValid()) {
                    // Check if a file with the same name already exists
                    $existingFiles = Storage::disk('public')->allFiles('songs');
                    $fileExists = false;

                    foreach ($existingFiles as $existingFile) {
                        if ($file->getClientOriginalName() === basename($existingFile)) {
                            $fileExists = true;
                            // Fetch the ID of the existing file and add it to the uploaded files
                            $existingSong = Song::where('path', 'songs/' . $file->getClientOriginalName())->first();
                            if ($existingSong) {
                                $uploadedFiles[] = $existingSong->id;
                            }
                            break;
                        }
                    }

                    if (!$fileExists) {
                        // Save the file with its original name
                        $path = $file->storeAs('songs', $file->getClientOriginalName(), 'public');

                        // Analyze the file for duration
                        $getID3 = new getID3();
                        $fileInfo = $getID3->analyze($file->getPathname());

                        // Get the duration
                        $durationInSeconds = $fileInfo['playtime_seconds'] ?? 0;

                        // Create a new Song record
                        $song = new Song;
                        $song->name = $file->getClientOriginalName();
                        $song->length = $durationInSeconds;
                        $song->path = $path;
                        $song->save();

                        $uploadedFiles[] = $song->id;
                    }
                }
            }

            // Create a new SongCategory and associate it with the uploaded files
            $newFolder = new SongCategory;
            $newFolder->name = $this->folderName;
            $newFolder->song_id = json_encode($uploadedFiles);
            $newFolder->save();
            $this->showModal = false;
            $this->folderName = '';
            $this->musicFiles = [];
            $this->tempFiles = [];
            $this->folders = songcategory::get();
            session()->flash('success', 'Success make new folder');
        } else {
            $this->showModal = true;
            session()->flash('error', 'There was existing folder');
        }

        // Display a success message

    }

    public function submit2()
    {
        // Validate the input
        $this->validate([
            'musicFiles2.*' => 'file|mimes:mp3,wav|max:20480',
        ]);

        // Check if the folder/category exists
        $songcategory = SongCategory::where('name', $this->FolderIsOpen['name'])->first();
        $uploadedFiles = [];

        if ($songcategory != null) {
            foreach ($this->musicFiles2 as $file) {
                if ($file->isValid()) {
                    // Check if a file with the same name already exists
                    $existingFiles = Storage::disk('public')->allFiles('songs');
                    $fileExists = false;

                    foreach ($existingFiles as $existingFile) {
                        if ($file->getClientOriginalName() === basename($existingFile)) {
                            $fileExists = true;
                            // Fetch the ID of the existing file and add it to the uploaded files
                            $existingSong = Song::where('path', 'songs/' . $file->getClientOriginalName())->first();
                            if ($existingSong) {
                                $uploadedFiles[] = $existingSong->id;
                            }
                            break;
                        }
                    }

                    if (!$fileExists) {
                        // Save the file with its original name
                        $path = $file->storeAs('songs', $file->getClientOriginalName(), 'public');

                        // Analyze the file for duration
                        $getID3 = new getID3();
                        $fileInfo = $getID3->analyze($file->getPathname());

                        // Get the duration
                        $durationInSeconds = $fileInfo['playtime_seconds'] ?? 0;

                        // Create a new Song record
                        $song = new Song;
                        $song->name = $file->getClientOriginalName();
                        $song->length = $durationInSeconds;
                        $song->path = $path;
                        $song->save();

                        $uploadedFiles[] = $song->id;
                    }
                }
            }

            // Create a new SongCategory and associate it with the uploaded files
            foreach (json_decode($songcategory->song_id) as $id) {
                $uploadedFiles[] = $id;
            }
            $this->SongIsOpen = [];
            foreach ($uploadedFiles as $id) {
                $this->SongIsOpen[] = song::find($id);
            }

            $this->FolderIsOpen = SongCategory::find($this->FolderIsOpen['id']);
            $songcategory->song_id = $uploadedFiles;
            $songcategory->save();
            $this->showModalSong = false;
            $this->musicFiles2 = [];
            $this->tempFiles2 = [];
            session()->flash('success', 'Success uploaded new song');
        } else {
            $this->showModalSong = true;
            session()->flash('error', 'There was existing song');
        }

        // Display a success message

    }

    public function delete(songcategory $folder)
    {
        $foundFolder = $this->folders->firstWhere('id', $folder->id);        // Jika folder ditemukan, hapus dari database
        if ($foundFolder) {
            $songid = json_decode($foundFolder->song_id, true); //temukan decode song id di folder sekarang
            if (!empty($songid)) {
                foreach ($songid as $id) {
                    // $song = song::find($id);
                    $isSong = false;
                    foreach ($this->folders as $f) { //cek setiap folder yang ada kecuali folder saat ini yang akan dihapus
                        if ($f != $folder) {
                            $fsongid = json_decode($f->song_id, true);
                            if (in_array($id, $fsongid)) {
                                $isSong = true;
                                break;
                            }

                        }
                    }

                    if ($isSong == false) {
                        $song = song::find($id);
                        if (Storage::disk('public')->exists($song->path)) {
                            Storage::disk('public')->delete($song->path);
                            $song->delete();
                        }
                    }
                }

            }

            if (!empty($this->FolderIsOpen['id'])) {
                if ($this->FolderIsOpen['id'] == $folder->id) {
                    $this->FolderIsOpen = [];
                    $this->SongIsOpen = [];
                }

            }

            $foundFolder->delete();

            // Update koleksi folders setelah penghapusan
            $this->folders = songcategory::get();
            $this->showModal = false;
            // Optionally, you can emit a success message or trigger some event
            session()->flash('message', 'Folder deleted successfully.');
        } else {
            // Jika folder tidak ditemukan, berikan pesan kesalahan
            session()->flash('error', 'Folder not found.');
        }
    }

    public function deleteSong($song)
    {
        $thissongid = $song['id'];
        if (in_array($thissongid, json_decode($this->FolderIsOpen['song_id'], true))) {
            $count = 0; //Hitung ada berapa banyak lagu ini di folder lain
            foreach ($this->folders as $f) {
                if ($f->id != $this->FolderIsOpen['id'] && in_array($thissongid, json_decode($f->song_id, true))) {
                    $count++;
                }
                // dd($f->song_id);
            }


            $songcat = SongCategory::find($this->FolderIsOpen['id']);
            $songidarr = json_decode($this->FolderIsOpen['song_id'], true);
            $songidarr = array_filter($songidarr, function ($id) use ($thissongid) {
                return $id !== $thissongid;
            });
            //Membuat array menjadi [], Jika tidak dikonvert maka array akan menjadi {key: value}
            $temparr = [];
            foreach ($songidarr as $as) {
                $temparr[] = $as;
            }

            $this->FolderIsOpen['song_id'] = $temparr;
            $songcat->song_id = json_encode($temparr);

            if ($count <= 0) {
                $updatesong = song::find($thissongid);
                if (Storage::disk('public')->exists($updatesong->path)) {
                    Storage::disk('public')->delete($updatesong->path);
                    $updatesong->delete();
                }
            }

            $songcat->save();
            $this->folders = SongCategory::get();
            $this->SongIsOpen = [];
            foreach ($this->FolderIsOpen['song_id'] as $id) {
                $this->SongIsOpen[] = song::find($id);
            }
            // dd($this->folders);
        }
    }
}
