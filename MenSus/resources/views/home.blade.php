@extends('layouts.master')
@section('header')
    @include('includes.headers.home')
@endsection
@section('content')
    <div class="content">
        @if(Session::has('fail'))
            <div class="info-box fail">
                {{ Session::get('fail') }}
            </div>
        @endif
        <div class="description">
            <h1>WELCOME !</h1>
            <div class="content">
                Mentorski sustav (MenSus) je:
                <p>
                    Lorem ipsum dolor sit amet, vestibulum curabitur dui dis, urna nullam orci at. Quis ultrices urna gravida, nunc aliquam ultrices sed. Justo sed consectetuer neque, nam semper mi ultricies quisque, quisque rhoncus vehicula vestibulum, mauris in mauris ligula. Ac dolor magna condimentum a, at neque est ipsum, leo aliquet malesuada aliquam. Libero massa elementum arcu ut, class dapibus aliquam suscipit, suspendisse orci id leo parturient. Tincidunt augue arcu ipsum, id gravida egestas sed massa. Fringilla non minus nam tempor, dignissim aliquet neque dictumst, diam odio congue nibh, dui placerat neque magna mauris.</p>
                <p>
                    Consequat feugiat officiis ac aliquet, ut erat blandit suspendisse pharetra. Ante nec sapien hymenaeos elit, malesuada quam imperdiet nulla, sit varius ad nec arcu. Ac lacus id curabitur, lorem et at convallis sem. Eget quisque congue purus, facilisi curabitur sapien sed feugiat, velit quis consequat semper velit. Nam sit fusce aliquam, libero pellentesque quisque libero suspendisse, consectetuer sed pulvinar faucibus duis, erat suspendisse quam duis felis. Quo massa eget ut quis, ridiculus duis velit tellus ullamcorper, praesent in urna mollis erat. Dolor dui lacus interdum, quam enim per lobortis, scelerisque in lacus sed, nulla pede egestas sapien. Nec blandit eros id, ligula metus ut consectetuer, non et viverra quis, pellentesque fusce tellus massa.</p>
                <p>
                </p>

            </div>
        </div>
    </div>
@endsection