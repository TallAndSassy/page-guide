<x-tassy::page-_base>
{{-- Front facing pages. Like 'site' in Wordpress. u
    The user might, or might not, be logged in, but this
    isn't about the person - it is standard site nav stuff. --}}

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    {{--    Modals --}}
    <div>
{{--        @livewire('the-modal-box')--}}
    </div>

    <style>
        /* Nicer Drop-Down --BEGIN- */


        /* Make detail reveals go smoother
        https://codepen.io/morewry/pen/gbJvy
        */
        details[open] .jDetails_body {
            animation-name: invisiblyGrowFontSize, fadeIn;
            animation-duration: 500ms, 200ms;
            animation-delay: 0ms, 300ms;
        }

        /* add wrapper, continue with font-size */
        @keyframes invisiblyGrowFontSize {
            0% {
                /*font-size: 0;*/
                max-height: 0px;
                opacity: 0;
            }
            100% {
                /*font-size: 1em;*/
                max-height: 999px;
                opacity: 0;
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }



        /* Fancy right-side discloser */
        details[open] .jDetails_summary_discloser {
            transform: scale(-1, 1)  rotate(-90deg);
            /*transform: ;*/
            transition: transform 500ms ease-in-out;
            /*animation-duration: 500ms, 200ms;*/
            /*animation-delay: 0ms, 300ms;*/
          /*  transform: scale(-1, 1);*/
          /*color: #1c87c9;*/
          /*-moz-transform: scale(-1, 1);*/
          /*-webkit-transform: scale(-1, 1);*/
          /*-o-transform: scale(-1, 1);*/
          /*-ms-transform: scale(-1, 1);*/
          /*transform: scale(-1, 1);*/
        }
        details .jDetails_summary_discloser {
            /*transform: scale(-1, 1)  rotate(-90deg);*/
            /*transform: ;*/
            transition: transform 300ms ease-in-out;
            /*animation-duration: 500ms, 200ms;*/
            /*animation-delay: 0ms, 300ms;*/
          /*  transform: scale(-1, 1);*/
          /*color: #1c87c9;*/
          /*-moz-transform: scale(-1, 1);*/
          /*-webkit-transform: scale(-1, 1);*/
          /*-o-transform: scale(-1, 1);*/
          /*-ms-transform: scale(-1, 1);*/
          /*transform: scale(-1, 1);*/
        }

        /* Left This puts reveal on far right... in Tall2 5/30/20', we're only
        playing for 'right' reveals so this is net relevant yet */
        /*https://stackoverflow.com/questions/56758098/how-to-position-detail-marker-to-come-after-summary */
        details.jDetailsFarRight {
            min-width: -webkit-fit-content;
            min-width: -moz-fit-content;
            min-width: fit-content;
        }

        .jDetailsFarRight summary {
            position: relative;
            min-width: -webkit-fit-content;
            min-width: -moz-fit-content;
            min-width: fit-content;
            cursor: pointer;
        }

        details.jDetailsFarRight summary::-webkit-details-marker {
            position: absolute;
            right: 0;
            top: 30%;
            z-index: 1;
        }

        /* Nicer Drop-Down --BEGIN- */

    </style>

     <div class="flex flex-col justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8">
        <div class="absolute top-0 right-0 mt-4 mr-4">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a id="navbarDropdown" class="nav-link  inline-block font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150" href="/me" role="button" aria-haspopup="true" aria-expanded="false" v-pre>

                        <span>{{__('tassy::PageGuide.MeLinkText')}}</span>

                    </a>

                        <a
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                        >
                            Log out
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>


    {{$slot}}
</x-tassy::page-_base>

