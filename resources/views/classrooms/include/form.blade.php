<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($classroom) ? $classroom->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="school-grade-id">{{ __('School Grade') }}</label>
            <select class="form-select @error('school_grade_id') is-invalid @enderror" name="school_grade_id" id="school-grade-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select school grade') }} --</option>
                
                        @foreach ($schoolGrades as $schoolGrade)
                            <option value="{{ $schoolGrade->id }}" {{ isset($classroom) && $classroom->school_grade_id == $schoolGrade->id ? 'selected' : (old('school_grade_id') == $schoolGrade->id ? 'selected' : '') }}>
                                {{ $schoolGrade->name }}
                            </option>
                        @endforeach
            </select>
            @error('school_grade_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>