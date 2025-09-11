<?php

namespace App\Http\Livewire\Admin\Courses;

use App\Models\Category;
use App\Models\Course;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class SaveCourse extends Component
{
    public $discount_price;
    public $duration = 90;
    public Course $course;
    public $categories;

    protected $listeners = ["deleted" => "handleDeleted"];

    public function handleDeleted()
    {
        return redirect()->route("admin.courses.index")->with("success", __("messages.course_move_trash"));
    }

    protected function messages()
    {
        return [
            'course.title.required' => __('messages.course_title_required'),
            'course.title.string' => __('messages.course_title_string'),
            'course.title.max' => __('messages.course_title_max'),
            'course.title.unique' => __('messages.course_title_unique'),
            'course.price.numeric' => __('messages.course_price_numeric'),
            'course.price.min' => __('messages.course_price_min'),
            'course.discount_price.numeric' => __('messages.discount_price_numeric'),
            'course.discount_price.min' => __('messages.discount_price_min'),
            'course.category_id.exists' => __('messages.category_not_found'),
            'course.description.max' => __('messages.course_description_max'),
            'course.short_description.max' => __('messages.course_short_description_max'),
            'duration.numeric' => __('messages.course_duration_numeric'),
        ];
    }

    protected function rules(): array
    {
        $slug = Str::slug($this->course->title ?? '');

        return [
            'course.title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('courses', 'title')->ignore($this->course->id ?? null),
                Rule::unique('courses', 'slug')->ignore($this->course->id ?? null)
                    ->where(fn($query) => $query->where('slug', $slug)),
            ],
            'course.category_id' => ['nullable', 'exists:categories,id'],
            'course.price' => ['nullable', 'numeric', 'min:0'],
            'discount_price' => [
                'nullable',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    if ($value !== null && $value >= ($this->course->price ?? 0)) {
                        $fail(__('messages.discount_must_be_less_than_price'));
                    }
                }
            ],
            "course.short_description" => ["nullable", "max:2000"],
            "course.description" => ["nullable", "max:100000"],
            'course.status' => ['required', Rule::in(Course::STATUSES)],
            "duration" => ["nullable", "numeric"],
            "course.is_free" => ["nullable"]
        ];
    }

    public function mount($courseId = null)
    {
        $this->categories = Category::all();

        if ($courseId) {
            $this->course = Course::find($courseId);
            $this->discount_price = $this->course?->discount_price;
            $this->duration = $this->course?->duration;

            if (!$this->course) {
                session()->flash('error', __('messages.course_not_found'));
                redirect()->route('admin.courses.index');
            }
        } else {
            $this->course = new Course();
            $this->course->status = "draft";
            $this->course->duration = $this->duration;
            $this->course->is_free = 0;
        }
    }

    public function save()
    {
        $this->validate();

        $this->course->slug = Str::slug($this->course->title);
        $this->course->category_id = $this->course->category_id ?: null;
        $this->course->discount_price = $this->discount_price ?: null;
        $this->course->duration = $this->duration;

        $this->course->save();

        session()->flash('success', __('messages.saved_changes'));

        return redirect()->route('admin.courses.save', $this->course->id);
    }

    public function render()
    {
        return view('livewire.admin.courses.save-course');
    }
}