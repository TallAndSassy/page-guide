<div>

{{-- [quote] --}}

{{-- Access this blade via
    <livewire:tassy::livewire.sidenav/>

    Peers:
    This works closely with TallAndSassy\PageGuide\Components\Sidenav
        vendor/tallandsassy/page-guide/src/Components/Sidenav.php
    See the above file for registration instructions...

    Troubleshooting:
    Q: When using <livewire:tassy::livewire.sidenav/>, I see...
        Livewire\Exceptions\ComponentNotFoundException
        Unable to find component: [tassy::livewire.sidenav]
    A: You probably didn't update src/SkeletonServiceProvider.php/boot to have your component.
        See Components/Blah.php for instructions
--}}


@php

    // JJ - How can you make these common without perculating up the heirarchy?  Simple includes hide varaibles.
             $liWrapper_1 = $liWrapper_2 = ' pr-0 ';
             $liWrapper_3 = ' pr-1 pl-0  ';  // feels like should be below, not in li

             $linkFontColor_cssClasses = 'text-gray-300';
             $linkFocus_cssClasses = ' group flex pr-1 pl-2 rounded-md focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150';
             $picked_classes = 'bg-gray-500 rounded';
             $placeholderFontColor_cssClasses = 'text-gray-400';


             $divNode_cssClasses     = "$linkFontColor_cssClasses        $linkFocus_cssClasses no-underline group flex items-center px-2 py-2 text-lg leading-5 font-bold   ";

             $firstLeaf_cssClasses   = "$linkFontColor_cssClasses        $linkFocus_cssClasses p-2 text-lg leading-5 font-bold    ";
             $firstLeafText_cssClasses = "hidden lg:block";
             $secondLeaf_cssClasses  = "$linkFontColor_cssClasses        $linkFocus_cssClasses group flex items-center px-2 py-1 text-sm leading-5 rounded-md  ";
             $secondBreak_cssClasses = "$placeholderFontColor_cssClasses ml-1.5 text-base font-bold ";
             $thirdLeaf_cssClasses   = "$linkFontColor_cssClasses        $linkFocus_cssClasses ml-1 xl:ml-5  ";
             $icon_cssClasses = "md:block lg:hidden xl:block topLevelNavIcon w-6 h-6 xl:mr-3 $placeholderFontColor_cssClasses ";
             $jDetails_summary_cssClasses = "jDetails_summary  $divNode_cssClasses cursor-pointer";
             $jDetails_body_cssClasses = 'ml-0 lg:ml-1 xl:ml-11';

             // Goes inside <a > to make it linky'  Doesn't include classes.  I had trouble parameterizing full html link
             /*function fancylinkInA(string $url) {
                 return <<<EOD
                 wire:click="\$emit('pageRoute','$url')"
                 x-on:click="urlChange('$url'); prevent();"
                 href="{$url}" x-on:click.prevent
                 EOD;
             }*/
    function fancylinkInA(string $url) {
        return \TallAndSassy\PageGuide\Components\Sidenav::wireSwaplinkInA($url);
    }

@endphp
<!-- Sidebar component, swap this element with another sidebar if you like -->

    <nav class="hidden md:flex md:flex-1 px-2 py-4 bg-gray-800 lg:w-36 xl:w-56">

        <style>
            /* Do not show > reveal */
            summary.jDetails_summary::marker {
                display: none;
            }

            summary.jDetails_summary::-webkit-details-marker {
                display: none;
            }
        </style>


        <ul class="">
            <li class='{{$liWrapper_1}} '>

                <a
                    {!! fancyLinkInA('/admin/dashboard') !!}
                    class="{{$firstLeaf_cssClasses}}"
                >
                    <x-heroicon-o-home class='{{$icon_cssClasses}}' stroke='currentColor'/>
                    <span class="cursor-pointer {{$firstLeafText_cssClasses}}">Dashboard</span>
                </a>

            </li>


            <li class='{{$liWrapper_1}}'>
                <details class="">
                    <summary class="{{$jDetails_summary_cssClasses}}">
                        <x-heroicon-o-pencil class="{{$icon_cssClasses}}" stroke="currentColor"/>
                        <span class=" {{$firstLeafText_cssClasses}}">Library</span>
                    </summary>
                    <div class="jDetails_body {{$jDetails_body_cssClasses}}">
                        <ul>
                            <li><a class="{{$secondLeaf_cssClasses}} "
                                    {!! fancyLinkInA('/admin/communication_template') !!}>Communication</a></li>
                            <li><a class="{{$secondLeaf_cssClasses}}" {!! fancyLinkInA('/admin/media') !!}>Media</a>
                            </li>
                            <li><a class="{{$secondLeaf_cssClasses}}" {!! fancyLinkInA('/admin/CourseLibrary') !!}>Courses</a>
                            </li>
                            <li>
                                <div class="{{$secondBreak_cssClasses}}">Calendars</div>
                            </li>
                            <li><a class="{{$thirdLeaf_cssClasses}}" {!! fancyLinkInA('/admin/seasons') !!}>Seasons</a>
                            </li>
                            <li><a class="{{$thirdLeaf_cssClasses}}" {!! fancyLinkInA('/admin/school_calendars') !!}>School
                                    Calendars</a></li>
                        </ul>
                    </div>
                </details>

            </li>

            <li class='{{$liWrapper_1}}'>
                <details class="">
                    <summary class="{{$jDetails_summary_cssClasses}}">
                        <x-heroicon-o-user-group class="{{$icon_cssClasses}}" stroke="currentColor"/>
                        <span class=" {{$firstLeafText_cssClasses}}">People</span>
                    </summary>
                    <div class="jDetails_body {{$jDetails_body_cssClasses}}">
                        <ul>
                            <li><a {!! fancyLinkInA('/admin/people/instructors') !!}
                                   class="{{$secondLeaf_cssClasses}} "
                                   href="/admin/people/instructors">Instructors</a></li>
                            <li><a {!! fancyLinkInA('/admin/people/FlightInstructors') !!}
                                   class="{{$secondLeaf_cssClasses}} "
                                   href="/admin/people/instructors">Flight Instructors</a></li>
                            <li><a {!! fancyLinkInA('/admin/people/GroundCrewLobby') !!}
                                   class="{{$secondLeaf_cssClasses}} "
                                   href="/admin/people/GroundCrewLobby">Ground Crew</a></li>
                            <li><a {!! fancyLinkInA('/admin/people/users') !!}
                                   class="{{$secondLeaf_cssClasses}}">Users</a></li>
                            <li><a {!! fancyLinkInA('/admin/people/teachers') !!}
                                   class="{{$secondLeaf_cssClasses}}">School Teachers</a></li>
                            <li><a class="{{$secondLeaf_cssClasses}}" {!! fancyLinkInA('/admin/people') !!}
                                >All People</a></li>
                        </ul>
                    </div>
                </details>

            </li>


            <li class='{{$liWrapper_1}}'>
                <details class="">
                    <summary class="{{$jDetails_summary_cssClasses}}">
                        <x-zondicon-fast-forward class="{{$icon_cssClasses}}" stroke="currentColor"/>
                        <span class=" {{$firstLeafText_cssClasses}}">Live Operations</span>
                    </summary>
                    <div class="jDetails_body {{$jDetails_body_cssClasses}}">
                        <ul>
                            <li>
                                <div class="{{$secondBreak_cssClasses}}">Seasonal Prep</div>
                            </li>
                            <li><a class="{{$thirdLeaf_cssClasses}}" {!! fancyLinkInA('/admin/lineup') !!}>Lineup</a>
                            </li>
                            <li><a class="{{$thirdLeaf_cssClasses}}" {!! fancyLinkInA('/admin/rollout') !!}>Rollout</a>
                            </li>
                            <li>
                                <div class="{{$secondBreak_cssClasses}}">Operations</div>
                            </li>
                            <li><a class="{{$thirdLeaf_cssClasses}}" {!! fancyLinkInA('/admin/enrollment') !!}>Enrollment</a>
                            </li>
                            <li><a class="{{$thirdLeaf_cssClasses}}" {!! fancyLinkInA('/admin/disruptions') !!}>Disruptions</a>
                            </li>
                            <li>
                                <a class="{{$thirdLeaf_cssClasses}}" {!! fancyLinkInA('/admin/finances') !!}>Finances</a>
                            </li>
                            <li><a class="{{$thirdLeaf_cssClasses}}" {!! fancyLinkInA('/admin/school_calendars') !!}>Communications</a>
                            </li>
                        </ul>
                    </div>
                </details>

            </li>
            <li class='{{$liWrapper_1}} '>
                <a {!! fancyLinkInA('/admin/help/issue/passwordReset') !!}
                   class="{{$firstLeaf_cssClasses}}"

                >
                    <x-heroicon-o-question-mark-circle class="{{$icon_cssClasses}}"
                                                       stroke="currentColor"/>
                    <span class=" {{$firstLeafText_cssClasses}}">Help</span>
                </a>
            </li>


        </ul>


    </nav>


</div>



