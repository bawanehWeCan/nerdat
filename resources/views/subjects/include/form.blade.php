<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($subject) ? $subject->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Description') }}" required>{{ isset($subject) ? $subject->description : old('description') }}</textarea>
            @error('description')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="expected">{{ __('Expected') }}</label>
            <input type="time" name="expected" id="expected" class="form-control @error('expected') is-invalid @enderror" value="{{ isset($subject) && $subject->expected ? $subject->expected->format('H:i') : old('expected') }}" placeholder="{{ __('Expected') }}" required />
            @error('expected')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="classroom-id">{{ __('Classroom') }}</label>
            <select class="form-select @error('classroom_id') is-invalid @enderror" name="classroom_id" id="classroom-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select classroom') }} --</option>
                
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ isset($subject) && $subject->classroom_id == $classroom->id ? 'selected' : (old('classroom_id') == $classroom->id ? 'selected' : '') }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
            </select>
            @error('classroom_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>