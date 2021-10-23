<div class="card direct-chat direct-chat-primary">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">Internal Comments</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages">
            @if($collections)
                @foreach($collections as $collection)
            <!-- Message. Default to the left -->
            <div class="direct-chat-msg {{$collection->admin_id == auth()->user()->id ? 'right':''}}">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name {{$collection->admin_id == auth()->user()->id ? 'float-right':'float-left'}} ">{{$collection->name}}</span>
                    <span class="direct-chat-timestamp  {{$collection->admin_id == auth()->user()->id ? 'float-left':'float-right'}} ">{{\Carbon\Carbon::parse($collection->created_at)->toFormattedDateString()}}</span>
                </div>
                <!-- /.direct-chat-infos -->
                <img class="direct-chat-img" src="{{URL('')}}/{{$collection->userdata->avatar??$collection->userdata->avatar}}" alt="{{$collection->userdata->display_name}}">
                <!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                    {!! $collection->msg_body !!}

                </div>
                @if($collection->attachment)
                    <br>
                    <a href="{{URL($collection->attachment)}}" download><i class="fas fa-file-download fa-7x"></i></a>
                    <br>
                    <?php $exp=explode('/',$collection->attachment);?>
                    <span class="error">{{ end($exp)}}</span>
                @endif
                <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->
                @endforeach
                @else
                <p class="text-center">no comment found</p>
            @endif

        </div>
        <!--/.direct-chat-messages-->

    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="input-group">
            <input type="text" name="message" placeholder="Type Message ..." class="form-control" wire:model="msg_body">
            <span class="input-group-append">
                <input id="fileInput" type="file" style="display:none;" wire:model="attachment" />
                  <button type="button" class="btn btn-secondary" onclick="document.getElementById('fileInput').click();" ><i class="fas fa-paperclip"></i></button>
                  <button type="button" class="btn btn-primary" wire:click="saveComment">SUBMIT</button>
            </span>
        </div>
        @error('msg_body') <span class="error">{{ $message }}</span> @enderror
        @error('attachment') <span class="error">{{ $message }}</span> @enderror

        <br>

        <div class="row">
            @if($attachmentName)
            <div class="col-md-1">
                <i class="fas fa-file-download fa-7x"></i><br>
                <span class="error">{{$attachmentName}}</span>
            </div>
            @endif
        </div>

    </div>
    <!-- /.card-footer-->

    <script>
        window.addEventListener('load', event => {
            $('.direct-chat-messages').animate({scrollTop: document.body.scrollHeight},"fast");
        })

        window.addEventListener('scroll-down-chat', event => {
            $('.direct-chat-messages').animate({scrollTop: document.body.scrollHeight},"fast");
        })
    </script>
</div>
