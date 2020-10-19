@php

    // JJ - How can you make these common without perculating up the heirarchy?  Simple includes hide varaibles.
             $liWrapper_1 = $liWrapper_2 = 'pr-1 ';
             $liWrapper_3 = ' pr-1 -ml-2 pl-2  ';  // feels like should be below, not in li

             $linkFontColor_cssClasses = 'text-gray-300';
             $linkFocus_cssClasses = ' group flex pr-1 pl-2 rounded-md focus:outline-none focus:bg-gray-600 transition ease-in-out duration-150';
             $picked_classes = 'bg-gray-500 rounded';
             $placeholderFontColor_cssClasses = 'text-gray-400';


             $divNode_cssClasses     = "$linkFontColor_cssClasses        $linkFocus_cssClasses no-underline group flex items-center px-2 py-2 text-lg leading-5 font-bold   ";

             $firstLeaf_cssClasses   = "$linkFontColor_cssClasses        $linkFocus_cssClasses p-2 text-lg leading-5 font-bold    ";
             $secondLeaf_cssClasses  = "$linkFontColor_cssClasses        $linkFocus_cssClasses group flex items-center px-2 py-1 text-sm leading-5 rounded-md  ";
             $secondBreak_cssClasses = "$placeholderFontColor_cssClasses ml-1.5 text-base font-bold ";
             $thirdLeaf_cssClasses   = "$linkFontColor_cssClasses        $linkFocus_cssClasses ml-5 ";
             $icon_cssClasses = "topLevelNavIcon w-6 h-6 mr-3 $placeholderFontColor_cssClasses";
             $jDetails_summary_cssClasses = "jDetails_summary cursor-pointer $divNode_cssClasses";
             $jDetails_body_cssClasses = 'ml-11';

 $firstLeafText_cssClasses = "hidden lg:block";
@endphp

<div>
    <nav>
        <ul class="">
            @foreach (\TallAndSassy\PageGuide\PageGuideAdminWranglerBottom::wranglees() as $key=>$asrOrClosure)
            <li class='{{$liWrapper_1}} '>

                <a
                    {!! fancyLinkInA($asrOrClosure['url']) !!}
                    class="{{$firstLeaf_cssClasses}}"
                >
                    <x-heroicon-o-home class='{{$icon_cssClasses}} {{$asrOrClosure['classes']}}' stroke='currentColor'/>
                    <span class="cursor-pointer {{$firstLeafText_cssClasses}}">{{$asrOrClosure['name']}}</span>
                </a>

            </li>
           @endforeach


            <li class='{{$liWrapper_1}}'>
                <details class="">
                    <summary class="{{$jDetails_summary_cssClasses}}">
                        <x-heroicon-o-cog class="{{$icon_cssClasses}}" stroke="currentColor"/>
                        Config
                    </summary>
                    <div class="jDetails_body {{$jDetails_body_cssClasses}}">
                        <ul>
                            <li><a {!! fancyLinkInA('/admin/homepage') !!}
                                   class="{{$secondLeaf_cssClasses}} "
                                >Home Page</a></li>
                            <li><a {!! fancyLinkInA('/admin/location') !!}
                                   class="{{$secondLeaf_cssClasses}}">Location</a></li>
                            <li><a {!! fancyLinkInA('/admin/powerups') !!}
                                   class="{{$secondLeaf_cssClasses}}">Power-Ups</a></li>
                            <li><a {!! fancyLinkInA('/admin/site_settings') !!}
                                   class="{{$secondLeaf_cssClasses}}">Site Settings</a></li>
                            <li><a {!! fancyLinkInA('/admin/config/advanced') !!}
                                   class="{{$secondLeaf_cssClasses}}">Advanced</a></li>
                        </ul>
                    </div>
                </details>
            </li>

            <li class='{{$liWrapper_1}} '>
                <a {!! fancyLinkInA('/admin/about') !!}
                   class="{{$firstLeaf_cssClasses}}"
                >
                    <x-zondicon-information-outline class="{{$icon_cssClasses}}"
                                                    stroke="currentColor"/>
                    <span class="">About</span>
                </a>
            </li>

            <li class='{{$liWrapper_1}}'>
                <details class="">
                    <summary class="{{$jDetails_summary_cssClasses}}">
                        <x-heroicon-o-cog class="{{$icon_cssClasses}}" stroke="currentColor"/>
                        Dev
                    </summary>
                    <div class="jDetails_body {{$jDetails_body_cssClasses}}">
                        <ul>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/010_hello') !!}
                                   class="{{$secondLeaf_cssClasses}} "
                                >010_hello</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/012_hello_with_params/name/jj') !!}
                                   class="{{$secondLeaf_cssClasses}} "
                                >012_hello_with_params/name/JJ</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/015_standard') !!}
                                   class="{{$secondLeaf_cssClasses}}">015_standard</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/017_tabs') !!}
                                   class="{{$secondLeaf_cssClasses}}">017_tabs</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/017_tabs2') !!}
                                   class="{{$secondLeaf_cssClasses}}">017_tabs2</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/020_modalHost__') !!}
                                   class="{{$secondLeaf_cssClasses}}">020_modalHost__</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/030_polling') !!}
                                   class="{{$secondLeaf_cssClasses}}">030_polling</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/040_keyVal') !!}
                                   class="{{$secondLeaf_cssClasses}}">040_keyVal</a></li>
                            <li>
                                <div class="{{$secondBreak_cssClasses}}">Cfd Basics</div>
                            </li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/100_CfdEasy') !!}
                                   class="{{$secondLeaf_cssClasses}}">100_CfdEasy</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/110_CfdBasics_SiteWide') !!}
                                   class="{{$secondLeaf_cssClasses}}">110_CfdBasics_SiteWide</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/115_CfdBasics_UserExtrasViaForeignKey') !!}
                                   class="{{$secondLeaf_cssClasses}}">115_CfdBasics_UserExtrasViaForeignKey</a></li>
                            <li>
                                <div class="{{$secondBreak_cssClasses}}">Cfd Form</div>
                            </li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/150_CfdForm__intro') !!}
                                   class="{{$secondLeaf_cssClasses}}">150_CfdForm__intro</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/152_CfdForm_Table') !!}
                                   class="{{$secondLeaf_cssClasses}}">152_CfdForm_Table</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/155_CfdForm_New') !!}
                                   class="{{$secondLeaf_cssClasses}}">155_CfdForm_New</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/156_CfdForm_ViewNewest') !!}
                                   class="{{$secondLeaf_cssClasses}}">156_CfdForm_ViewNewest</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/158_CfdForm_ViewOldest') !!}
                                   class="{{$secondLeaf_cssClasses}}">158_CfdForm_ViewOldest</a></li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/160_CfdForm_Table_Fuller_Dogs') !!}
                                   class="{{$secondLeaf_cssClasses}}">160_CfdForm_Table_Fuller_Dogs</a></li>


                            <li>
                                <div class="{{$secondBreak_cssClasses}}">Wysiwig </div>
                            </li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/200_TrixBasics') !!}
                                   class="{{$secondLeaf_cssClasses}}">200_TrixBasics</a></li>
                            <li>
                                <div class="{{$secondBreak_cssClasses}}">Packages</div>
                            </li>
                            <li><a {!! fancyLinkInA('/admin/DevDemo/301_SimplePackage') !!}
                                   class="{{$secondLeaf_cssClasses}}">301_SimplePackage</a></li>
                        </ul>
                    </div>
                </details>


            </li>
        </ul>
    </nav>
</div>
