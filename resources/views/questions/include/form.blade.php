<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="question">{{ __('Question') }}</label>
            <input type="text" name="question" id="question" class="form-control @error('question') is-invalid @enderror" value="{{ isset($question) ? $question->question : old('question') }}" placeholder="{{ __('Question') }}" required />
            @error('question')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($question) ? $question->description : old('description') }}" placeholder="{{ __('Description') }}" required />
            @error('description')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="subject-id">{{ __('Subject') }}</label>
            <select class="form-select @error('subject_id') is-invalid @enderror" name="subject_id" id="subject-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select subject') }} --</option>
                
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ isset($question) && $question->subject_id == $subject->id ? 'selected' : (old('subject_id') == $subject->id ? 'selected' : '') }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
            </select>
            @error('subject_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="lesson-id">{{ __('Lesson') }}</label>
            <select class="form-select @error('lesson_id') is-invalid @enderror" name="lesson_id" id="lesson-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select lesson') }} --</option>
                
                        @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}" {{ isset($question) && $question->lesson_id == $lesson->id ? 'selected' : (old('lesson_id') == $lesson->id ? 'selected' : '') }}>
                                {{ $lesson->name }}
                            </option>
                        @endforeach
            </select>
            @error('lesson_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="unit-id">{{ __('Unit') }}</label>
            <select class="form-select @error('unit_id') is-invalid @enderror" name="unit_id" id="unit-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select unit') }} --</option>
                
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}" {{ isset($question) && $question->unit_id == $unit->id ? 'selected' : (old('unit_id') == $unit->id ? 'selected' : '') }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
            </select>
            @error('unit_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>