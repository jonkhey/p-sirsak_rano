<input type="file" class="form-control @error($name) is-invalid @enderror" id="{{ $name ?? '' }}" name="{{ $name ?? '' }}" aria-label="File Browser" onchange="preview_image(event)">
@error($name)
<div class="invalid-feedback">{{ $message }}</div>
@enderror
