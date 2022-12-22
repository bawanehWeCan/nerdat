<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="note">{{ __('Note') }}</label>
            <input type="text" name="note" id="note" class="form-control @error('note') is-invalid @enderror" value="{{ isset($tip) ? $tip->note : old('note') }}" placeholder="{{ __('Note') }}" required />
            @error('note')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>