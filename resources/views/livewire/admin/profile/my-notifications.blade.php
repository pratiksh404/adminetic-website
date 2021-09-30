<div>
    <div class="card shadow-lg">
        <div class="card-header">
            <h4 class="card-title">My Notifications</h4>
        </div>
        <div class="card-body">
            <ul>
                @if (isset($unread_notifications))
                    @foreach ($unread_notifications as $unread_notification)
                        <li>
                            <a
                                href="{{ adminShowRoute($unread_notification->data['model'], $unread_notification->data['id']) }}">
                                <p><i class="fa fa-circle-o me-3 font-primary"> </i>By
                                    <b>{{ $unread_notification->data['announcement_by'] }}</b>
                                    <span class="pull-right">{{ $unread_notification->data['date_time'] }}</span>
                                </p>
                            </a>
                        </li>
                    @endforeach
                @else
                    <li>
                        <p><i class="fa fa-circle-o me-3 font-primary"> </i>No Notfications Yet</p>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
