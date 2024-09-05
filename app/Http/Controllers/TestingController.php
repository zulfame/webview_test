<?php

namespace App\Http\Controllers;

use App\Models\Testing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestingController extends Controller
{
    public function upload()
    {
        $ip      = ($_SERVER['REMOTE_ADDR']);
        $testing = Testing::where('ip_address', $ip)->first();

        return view('testing.upload', compact('testing'));
    }

    public function upload_store(Request $request)
    {
        $request->validate([
            'photo' => 'nullable|image|max:2048',
            'file'  => 'nullable|file|max:2048',
        ], [
            'photo.image' => 'The photo must be an image.',
            'photo.max'   => 'The photo may not be greater than 2MB.',
            'file.file'   => 'The file must be a file.',
            'file.max'    => 'The file may not be greater than 2MB.',
        ]);

        try {
            $ip      = ($_SERVER['REMOTE_ADDR']);
            $testing = Testing::firstOrNew(['ip_address' => $ip]);

            if ($request->hasFile('photo')) {
                if ($testing->photo) {
                    Storage::disk('public')->delete($testing->photo);
                }

                $photoPath = $request->file('photo');
                $filePhoto = $photoPath->storeAs('testing', time() . '.' . $photoPath->getClientOriginalExtension(), 'public');
            } else {
                $filePhoto = $testing->photo;
            }

            if ($request->hasFile('file')) {
                if ($testing->file) {
                    Storage::disk('public')->delete($testing->file);
                }

                $filePath = $request->file('file');
                $fileFile = $filePath->storeAs('testing', time() . '.' . $filePath->getClientOriginalExtension(), 'public');
            } else {
                $fileFile = $testing->file;
            }

            $dataTesting = [
                'ip_address' => $ip,
                'photo'      => $filePhoto,
                'file'       => $fileFile,
            ];

            $testing->fill($dataTesting);
            $testing->save();

            return back()->with('success', 'File uploaded successfully.');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()->with('error', 'File uploaded failed.');
        }
    }

    public function upload_update(Request $request)
    {
        $ip      = ($_SERVER['REMOTE_ADDR']);
        $testing = Testing::where('ip_address', $ip)->first();

        try {
            if ($request->photo) {
                Storage::disk('public')->delete($testing->photo);

                $dataTesting = [
                    'photo' => null,
                ];

                $testing->fill($dataTesting);
                $testing->save();
            }

            if ($request->file) {
                Storage::disk('public')->delete($testing->file);

                $dataTesting = [
                    'file' => null,
                ];

                $testing->fill($dataTesting);
                $testing->save();

                return back()->with('success', 'File deleted successfully.');
            }
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()->with('error', 'File deleted failed.');
        }
    }

    public function embed()
    {
        $ip      = ($_SERVER['REMOTE_ADDR']);
        $testing = Testing::where('ip_address', $ip)->first();

        return view('testing.embed', compact('testing'));
    }

    public function webcam()
    {
        $ip      = ($_SERVER['REMOTE_ADDR']);
        $testing = Testing::where('ip_address', $ip)->first();

        return view('testing.webcam', compact('testing'));
    }

    public function webcam_post(Request $request)
    {
        $base64Image = $request->photo;

        if (strpos($base64Image, 'data:image') !== false) {
            list(, $base64Image) = explode(',', $base64Image);
        }

        $ip      = $_SERVER['REMOTE_ADDR'];
        $testing = Testing::where('ip_address', $ip)->first();

        if ($testing && $testing->camera) {
            Storage::disk('public')->delete($testing->camera);
        }

        $imageData = base64_decode($base64Image);
        $fileName = 'testing/' . time() . '.jpg';

        Storage::disk('public')->put($fileName, $imageData);

        try {
            $dataTesting = [
                'camera'     => $fileName,
                'latitude'   => $request->latitude,
                'longitude'  => $request->longitude,
                'ip_address' => $ip,
            ];

            if ($testing) {
                $testing->update($dataTesting);
            } else {
                Testing::create($dataTesting);
            }

            return back()->with('success', 'File uploaded successfully.');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()->with('error', 'File uploaded failed. ' . $e->getMessage());
        }
    }
}
