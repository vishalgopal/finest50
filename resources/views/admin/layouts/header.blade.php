{{-- @auth --}}
<nav id="sidebar">
    <div class="sidebar-header">
        {{-- <img src="{{asset('images/logo.png')}}" alt="poddar"> --}}
    </div>


    <ul class="list-unstyled components">
        
    {{-- @if(Auth::user()->user_role_type=='superadmin') --}}
        <li class="">
            <a href="{{url('books')}}">
                <i class="fa fa-file-text"></i>
                Books
            </a>            
        </li>     
        <li class="">
            <a href="{{url('packages')}}">
                <i class="fa fa-tasks"></i>
                Packages
            </a>            
        </li>
        <li class="">
           <a href="{{url('users')}}">
               <i class="fa fa-file-text"></i>
              Users
           </a>            
       </li>   
    {{-- @endif --}}
 
        <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
               
                <i class="fa fa-sign-out"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        
        </li>
    </ul>
</nav>
{{-- @endauth --}}