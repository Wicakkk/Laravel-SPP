<li class="nav-item @if ($active == 'Spp'){
    {{'active'}}
}@endif">
    <a class="nav-link" href="{{url('pembayaran')}}">
        <i class="fas fa-fw fa-cube"></i>
        <span>Spp</span>
    </a>
</li>
<li class="nav-item @if ($active == 'Profile') active @endif">
    <a class="nav-link" href="{{ route('profile.edit') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>Profile</span>
    </a>
</li>
