<div class="form-group">
    <label for="subject">Subject</label>
    <input type="text" name="subject" placeholder="Subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject', $story->subject) }}" />
    @error('subject')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="body">Body</label>
    <textarea name="body" class="form-control @error('body') is-invalid @enderror">{{ old('body', $story->body) }}</textarea>
    @error('body')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <label for="type">Type</label>

    <select name="type" class="form-control @error('type') is-invalid @enderror">
        <option value="">--Select--</option>
        <option value="short" {{ ( 'short' == old('type', $story->type) ) ? 'selected' : '' }}>Short Story</option>
        <option value="long" {{ ( 'long' == old('type', $story->type) ) ? 'selected' : '' }}>Long Story</option>
    </select>
    @error('type')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="form-group">
    <legend>Active</legend>
    <div class="form-check @error('active') is-invalid @enderror">
        <input class="form-check-input" name="active" type="radio" {{ ( 1 == old('active', $story->active) ) ? 'checked' : '' }} value="1" />
        <label for="active" class="form-check-label">Yes</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" name="active" type="radio" {{ ( 0 == old('active', $story->active) ) ? 'checked' : '' }} value="0" />
        <label for="active" class="form-check-label">No</label>
    </div>
    @error('active')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>