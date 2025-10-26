<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function authorize(): bool { return auth()->check(); }
    public function rules(): array {
        return [
            'title'       => ['required','string','max:255'],
            'abstract'    => ['nullable','string'],
            'year'        => ['nullable','digits:4'],
            'type'        => ['required','in:final_year_project,term_paper,seminar_paper,oral_history,faculty_publication,department_record'],
            'course_code' => ['nullable','string','max:50'],
            'category_id' => ['required','exists:categories,id'],
            'status'      => ['required','in:draft,published'],

            // files[]
            'files'       => ['nullable','array','max:6'],
            'files.*'     => ['file','max:51200'], // 50MB each
        ];
    }
}
