@extends('master.main')

@section('content')
    <h1>Course Classes Accordion</h1>

    <div class="accordion">
        @foreach($courseClasses as $courseClass)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $courseClass->id }}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $courseClass->id }}" aria-expanded="true" aria-controls="collapse{{ $courseClass->id }}">
                        {{ $courseClass->name }}
                    </button>
                </h2>
                <div id="collapse{{ $courseClass->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $courseClass->id }}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul>
                            @foreach($students as $student)
                                @if($student->course_class_id == $courseClass->id)
                                    <li>{{ $student->name }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
