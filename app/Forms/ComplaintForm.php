<?php

namespace App\Forms;

use App\Mail\BasicProductForm;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ComplaintForm extends FormAbstract
{
    public const FORM_NAME = 'Complaints & Check Complaint form ';
    public string $formTemplate = 'site.forms.complaint';

    public function validate(array $data): array
    {
        $data = Validator::make($data, [
            'fullName'             => 'required|string',
            'phone'                => 'required|required',
            'message'              => 'required|string',
            'g-recaptcha-response' => 'required|string',
        ])->validate();

        $response = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['secret' => '6LeMjs0oAAAAALpzfOfrjFoD3Nj3kYoRBeWwcdeu', 'response' => $data['g-recaptcha-response']]
        )->json();

        if ((bool)($response['success'] ?? false) === false) {
            abort(422);
        }

        return $data;
    }

    protected function sendMail(array $data): void
    {
        $recipients = ['samir@mediadesign.az'];

        Mail::to($recipients)->send(new BasicProductForm($data));
    }
}
