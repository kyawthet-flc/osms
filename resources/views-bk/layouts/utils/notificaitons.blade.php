<div class="dropdown for-notification">
  <!--   <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-bell"></i>
        <span class="count bg-danger" style="right: -13px;
top: -11px;width: 30px;height: 30px;vertical-align: middle;padding-top: 15%;">1</span>
    </button> -->

    @if( true )
        <div class="dropdown-menu" aria-labelledby="notification" style="height: auto;max-height: 600px;background-color: #fff;width: 300px;overflow-y: auto;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);padding-top: 0;padding-bottom: 5px;word-wrap: break-word;">
            <p class="red mb-1" style="background-color: #d0d0d0;padding-top: 11px;padding-bottom: 11px;font-weight: bold;">You have 3 Notifications</p>

            @foreach([] as $k => $notification)
            <a class="dropdown-item media" href="{{ route('medical.notify_admin.read', [
                'notifyAdmin' => $notification,
                'redirectUrl' => viewNotification($notification, auth()->user()->isLabUser() )
            ]) }}">
                <p>
                    {{ $k+1 }}. {{ $notification['subject'] }}.<br/>
                    <span style="white-space: pre-line;font-size: 11px;">{{ $notification['description'] }}</span st>
                </p>
            </a>
            @endforeach

        </div>
    @endif

</div>



