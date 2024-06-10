<?php

namespace App\Forms;

use App\Mail\BasicProductForm;
use App\Repository\InsuranceTypeRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CaseHappenedForm extends FormAbstract
{
    public const FORM_NAME = 'Case happened form';
    public string $formTemplate = 'site.forms.case-happened-form';

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

public function getData(): void
{
    $insuranceTypesRepository = app(InsuranceTypeRepositoryInterface::class);
    $this->setData([
        'insuranceTypes' => $insuranceTypesRepository->allActiveNested(),
    ]);
}

    protected function sendMail(array $data): void
    {
        $recipients = ['samir@mediadesign.az'];

        Mail::to($recipients)->send(new BasicProductForm($data));
    }
}
