<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Repositories\ContactRepository;
use Illuminate\Http\Request;
use App\Services\ContactService;
use Exception;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index()
    {
        $contacts = $this->contactService->getAll();

        return view('admin.contact.contact_list', compact('contacts'));
    }

    public function edit($slug)
    {
        $status = ContactRepository::STATUS;

        $contact = ['status' => 200];

        try {
            $contact = $this->contactService->getSingle($slug);
        } catch (Exception $e) {
            $contact = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return view('admin.contact.contact_edit', compact('status', 'contact'));
    }

    public function store(ContactRequest $contactRequest)
    {
        $req = $contactRequest->only('name', 'email', 'phone', 'status');
        $result = ['status' => 200];

        try {
            $result['data'] = $this->contactService->create($req);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function update(ContactRequest $contactRequest, $id)
    {
        $req = $contactRequest->only('name', 'email', 'phone', 'status');

        $result = ['status' => 200];

        try {
            $result['data'] = $this->contactService->update($id, $req);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return redirect()->route('contact.list')->with('message', 'Update thông tin liên hệ thành công');
    }

    public function delete($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->contactService->delete($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return redirect()->back()->with('message', 'Xoa thông tin liên hệ thành công');
    }
}
