<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($lesson) ? $lesson->name : old('name') }}" placeholder="{{ __('Name') }}" required />
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
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Description') }}" required>{{ isset($lesson) ? $lesson->description : old('description') }}</textarea>
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
            <input type="time" name="expected" id="expected" class="form-control @error('expected') is-invalid @enderror" value="{{ isset($lesson) && $lesson->expected ? $lesson->expected->format('H:i') : old('expected') }}" placeholder="{{ __('Expected') }}" required />
            @error('expected')
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
                            <option value="{{ $unit->id }}" {{ isset($lesson) && $lesson->unit_id == $unit->id ? 'selected' : (old('unit_id') == $unit->id ? 'selected' : '') }}>
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