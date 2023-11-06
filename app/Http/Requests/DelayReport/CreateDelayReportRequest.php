<?php

namespace App\Http\Requests\DelayReport;


use Illuminate\Foundation\Http\FormRequest;

class CreateDelayReportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order_id' => 'required|integer',
        ];
    }
}
