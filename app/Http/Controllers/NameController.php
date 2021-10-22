<?php

namespace App\Http\Controllers;

use App\Http\Requests\NameStoreRequest;
use App\Mail\NotifyUser;
use App\Models\Name;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NameController extends Controller
{
    public function store(NameStoreRequest $request) {
        try {
            $data = $request->all();
            $data['status_id'] = 1;
            $newRequest = Name::create($data);
            $response = [
                'success' => true,
                'data' => $newRequest
            ];
        } catch(Exception $exception) {
            $response = [
                'success' => false,
                'message' => $exception->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function list(Request $request) {
        try {
            $data = Name::with('status')->get();
            $response = [
                'success' => true,
                'data' => $data
            ];
        } catch (Exception $exception) {
            $response = [
                'success' => false,
                'message' => $exception->getMessage()
            ];
        }
        
        return response()->json($response);
    }

    public function decide(Request $request) {
        try {
            $data = $request->all();
            $nameRequest = Name::with('status')->findOrFail($data['id']);
            $nameRequest->status_id = $data['status_id'];
            $nameRequest->description = $data['description'] ?? null;
            $nameRequest->save();
            $emailData = [
                'name' => $nameRequest->name,
                'status' => $nameRequest['status']['title'],
                'description' => $nameRequest->description ?? 'Default desc',
                'email' => $nameRequest->email,
            ];
            Mail::to($emailData['email'])->send(new NotifyUser($emailData));
            $response = [
                'success' => true,
                'data' => $nameRequest
            ];
        } catch (Exception $exception) {
            $response = [
                'success' => false,
                'message' => $exception->getMessage(),
            ];
        }
        
        return response()->json($response);
    }

    public function filtered(Request $request) {
        
        try {
            $data = $request->all();
            $result = Name::with('status')
            ->byName($data['name'])
            ->byStatus($data['status_id'])
            ->byDate($data['date'])
            ->get();
            $response = [
                'success' => true,
                'data' => $result
            ];
        } catch (Exception $exception) {
            $response = [
                'success' => false,
                'message' => $exception->getMessage()
            ];
        }
        
        return response()->json($response);
    }
}
