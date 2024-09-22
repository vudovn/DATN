@props(['createButton', 'options', 'action'])

<div class="flex flex-middle flex-between mb-10">
    <div class="fiter">
        <form action="">
            <div class="flex flex-middle">
                @if(isset($options) && count($options) && is_array($options))
                    @foreach($options as $key => $option)
                    <div class="filter-item {{ $key }} mr-10px">
                        @if(isset($option) && count($option))

                        @php
                            $selected = request($key) ?: old($key);
                        @endphp

                        <select name="{{ $key }}" id="{{ $key }}" class="form-control ">
                            @foreach($option as  $keyItem => $valItem)
                                <option {{ ($keyItem == $selected) ? 'selected' : '' }} value="{{ $keyItem }}">{{ $valItem }}</option>
                            @endforeach
                        </select>    
                        @endif
                    </div>
                    @endforeach
                @endif

                <input 
                    type="text"
                    name="keyword"
                    value="{{ request('keyword') ?: old('keyword') }}"
                    class="form-control mr-10px search-keyword"
                    placeholder="Enter your keyword"
                >

                <button type="submit" name="filter" class="btn btn-success btn-filter">Search</button>

            </div>
        </form>
    </div>
    <div class="actions flex flex-middle">
        <a href="{{ route($createButton['route']) }}" class="btn-action-item btn btn-danger">
            <i class="fa fa-plus"></i>
            {{ $createButton['label'] }}
        </a>
    </div>
</div>