<div class="row">
@if (strtolower($user_info->course->course_code) == 'cs')
        <div class="col-lg-12 text-center">
            {{-- CS BLOCKS --}}
            @foreach ($blocks as $block)
            @if (strtolower($block->course) == 'cs')
            <button class="btn btn-lg rounded-0 border-0 font-weight-bold btn-white mb-2 btnBlockCategory" type="button" data="{{json_encode([
                    'level'      => $block->level,
                    'course'     => $block->course,
                    'block_name' => $block->block_name,
                    'semester'   => $current_sem->id,
                ])}}">{{$block->level  . $block->course . $block->block_name}}</button>
            @endif
            @endforeach
    </div>
@else
    <div class="col-lg-12 text-center">
        {{-- CE BLOCKS --}}
        @foreach ($blocks as $block)

        @if (strtolower($block->course) == 'ce')
        <button class="btn btn-lg rounded-0 border-0 font-weight-bold btn-white mb-2 btnBlockCategory" type="button" data="{{json_encode([
                    'level'      => $block->level,
                    'course'     => $block->course,
                    'block_name' => $block->block_name,
                    'semester'   => $current_sem->id,
                ])}}">{{$block->level  . $block->course . $block->block_name}}</button>
        @endif
        @endforeach
    </div>
@endif
</div>
