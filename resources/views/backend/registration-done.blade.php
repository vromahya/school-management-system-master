<h1>Done</h1>
<div class="mx-auto">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{session('message')}}
        </div>
    @endif
    @if (session()->has('data'))
        <div class="alert alert-success">
            {{session('data')->college_name}}
        </div>
    @endif
</div>