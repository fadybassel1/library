<?php

namespace App\Traits;
use App\Photo;



/**
 * 
 */
trait StoreImageTrait
{
    public function storeCapturedImage($img,$reader){
        if (strpos($img, "data:image/jpeg;base64,") === false) {

            return redirect()->back()->with('error', 'الملف لم يكن صورة');
          }
    
          $image_parts = explode(";base64,", $img);
          $image_type_aux = explode("image/", $image_parts[0]);
          $img = imagecreatefromstring(base64_decode($image_parts[1]));
          if (!$img) {
            return redirect()->back()->with('error', 'الملف لم يكن صورة');
          }
    
          $id=$reader->id;
          if ($reader->photo) {
            $photo = $reader->photo;
            // remove the old image
            unlink('member photos/' . $photo->filename);
            imagejpeg($img, "member photos/$id.jpeg");
            $photo->filename = $id . '.jpeg';
            $photo->save();
          } else {
            imagejpeg($img, "member photos/$id.jpeg");
            Photo::create([
              'filename' => $id . '.jpeg',
              'photoable_id' => $reader->id,
              'photoable_type' => "App\Reader"
            ]);
          }
    }


    public function storeUploadedImage($file,$reader){
        $filextention = $file->getClientOriginalExtension();
        $filename = $reader->id . '.' . $filextention;
  
        if ($reader->photo) {
          $photo = $reader->photo;
          // remove old image.....
          unlink('member photos/' . $photo->filename);
          $file->move('member photos', $filename);
  
          // update photo file name
          $photo->filename = $filename;
          $photo->save();
        } else {
          $file->move('member photos', $filename);
          Photo::create([
            'filename' => $filename,
            'photoable_id' => $reader->id,
            'photoable_type' => "App\Reader"
          ]);
        }        
    }
}
