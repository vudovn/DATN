@props(['createButton', 'options', 'action'])

<div class="d-flex justify-content-between animate__animated animate__fadeIn">
    <div class="filter">
        <form action="">
            <div class="form-row">
                @if(isset($options) && count($options) && is_array($options))
                    @foreach($options as $key => $option)
                        <div class="form-group col-auto filter-item {{ $key }}">
                            @if(isset($option) && count($option))
                            @php
                                $selected = request($key) ?: old($key);
                            @endphp
                            <select name="{{ $key }}" id="{{ $key }}" class="form-control select2">
                                @foreach($option as $keyItem => $valItem)
                                    <option {{ ($keyItem == $selected) ? 'selected' : '' }} value="{{ $keyItem }}">{{ $valItem }}</option>
                                @endforeach
                            </select>    
                            @endif
                        </div>
                    @endforeach
                @endif

                <div class="form-group col-auto">
                    <input 
                        type="text"
                        name="keyword"
                        value="{{ request('keyword') ?: old('keyword') }}"
                        class="form-control"
                        placeholder="Nhập từ khóa"
                    >
                </div>

                <div class="form-group col-auto">
                    <button type="submit" name="filter" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    
    @if(isset($createButton) && $createButton)
    <div class="actions">
        <a href="{{ route($createButton['route']) }}" class="btn btn-danger">
            <i class="fa fa-plus"></i>
            {{ $createButton['label'] ?? '' }}
        </a>
    </div>
    @endif
</div>
