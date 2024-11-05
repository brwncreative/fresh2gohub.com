<div id="dashboard">
    <div class="intro">
        <p class="medium-title">Hi {{ Auth::user()->name }} Welcome to your dashboard</p>
        <p class="paragraph-reg">Interact with your website content, users and more here</p>
    </div>
    <hr>
    <p><i class="bi bi-lightning-fill"></i> Quick Actions:
    </p>
    <div class="quick-actions">
        {{-- Products --}}
        <a href="{{ route('dashboard', ['purpose' => 'products']) }}">
            <div class="qa">
                <div class="bar">
                </div>
                <div class="text">
                    <span class="small-title">Products</span>
                    <p> Manage products </p>
                </div>
            </div>
        </a>
        {{-- Orders --}}
        <a href="{{ route('dashboard', ['purpose' => 'orders']) }}">
            <div class="qa">
                <div class="bar">
                </div>
                <div class="text">
                    <span class="small-title">Orders</span>
                    <p> Manage orders </p>
                </div>
            </div>
        </a>
        {{-- Users --}}
        <a href="{{ route('dashboard', ['purpose' => 'users']) }}">
            <div class="qa">
                <div class="bar">
                </div>
                <div class="text">
                    <span class="small-title">Users</span>
                    <p> Manage users and send mail</p>
                </div>
            </div>
        </a>
    </div>
</div>
