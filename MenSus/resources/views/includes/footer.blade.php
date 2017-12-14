<div class="footer-wrapper">
    <div class="footer">
        <p> © 2016 All Rights Reserved.</p>
        @if(!Auth::user())
            <a href={{route('admin.login')}}>Admin</a>
        @endif
    </div>
</div>