<div>
    @php
        $liWrapper_1 = $liWrapper_2 = ' pr-0 ';
              $liWrapper_3 = ' pr-1 pl-2  ';  // feels like should be below, not in li

              $linkFontColor_cssClasses = 'text-gray-300';
              $linkFocus_cssClasses = ' group flex pr-1 pl-2 rounded-md focus:outline-none focus:bg-gray-700 transition ease-in-out duration-150';
              $picked_classes = 'bg-gray-500 rounded';
              $placeholderFontColor_cssClasses = 'text-gray-400';


              $divNode_cssClasses     = "$linkFontColor_cssClasses        $linkFocus_cssClasses no-underline group flex items-center px-2 py-2 text-lg leading-5 font-bold   ";

              $firstLeaf_cssClasses   = "$linkFontColor_cssClasses        $linkFocus_cssClasses p-2 text-lg leading-5 font-bold    ";
              $firstLeafText_cssClasses = "pl-2 pt-0.5";
              $secondLeaf_cssClasses  = "$linkFontColor_cssClasses        $linkFocus_cssClasses group flex items-center ml-8 px-2 py-1 text-sm leading-5 rounded-md  ";
              $secondBreak_cssClasses = "$placeholderFontColor_cssClasses ml-10   text-base font-bold ";
              $thirdLeaf_cssClasses   = "$linkFontColor_cssClasses        $linkFocus_cssClasses ml-13  ";
              $icon_cssClasses = "topLevelNavIcon w-6 h-6  $placeholderFontColor_cssClasses ";
              $jDetails_summary_cssClasses = "jDetails_summary  $divNode_cssClasses cursor-pointer";
              $jDetails_body_cssClasses = 'ml-0 ';

              // Goes inside <a > to make it linky'  Doesn't include classes.  I had trouble parameterizing full html link
              /*function fancylinkInA(string $url) {
                  return <<<EOD
                  wire:click="\$emit('pageRoute','$url')"
                  x-on:click="urlChange('$url'); prevent();"
                  href="{$url}" x-on:click.prevent
                  EOD;
              }*/
              if (!function_exists('fancylinkInA')) {
     function fancylinkInA(string $url) {
         return \TallAndSassy\PageGuide\Components\Sidenav::wireSwaplinkInA($url);
     }
     }

    @endphp
    <style>
        /* Do not show > reveal */
        summary.jDetails_summary::marker {
            display: none;
        }

        summary.jDetails_summary::-webkit-details-marker {
            display: none;
        }
    </style>

    <nav class=" flex flex-1 px-2 py-4 bg-gray-800">
        <ul class="">
            @php $menuKeys = array_keys($menutree->asrMenus);;@endphp
            @for ($i = 0; $i < count($menuKeys); $i++)
                @php
                    $key = $menuKeys[$i];
                    $menuEntry = $menutree->asrMenus[$key];
                    if ($key == 'admin.salad.fruit') {
                        #dd($menuEntry);
                    }
                @endphp
                @if ($menutree::isTopLeaf($menuEntry))
                    <li class='{{$liWrapper_1}} '>
                        <a {!! fancyLinkInA($menuEntry['Url']) !!} class="{{$firstLeaf_cssClasses}} {{$menutree::isOnThisRoute($menuEntry) ? 'font-extrabold text-lg' : ''}}">
                            @if (! empty($menuEntry['SvgHtml']) )
                                {!! $menuEntry['SvgHtml'] !!}
                            @elseif (! empty($menuEntry['IconName']) )
                                {{-- If you see something like: ErrorException Svg by name "o-homeasdf" from set "heroicons" not found...--}}
                                {{-- [ ] Did you put 'x-' in front.  You shouldn't use 'heroicon-o-home', not 'x-heroicon-o-home'--}}
                                {{-- [ ] Did you need to install this font kit, like 'composer require blade-ui-kit/blade-heroicons' as specified on the --}}
                                {{--     https://blade-ui-kit.com/blade-icons/heroicon-o-home                            --}}
                                {{-- Try visiting https://blade-ui-kit.com/blade-icons.--}}
                                @svg($menuEntry['IconName'], $icon_cssClasses)
                            @endif
                            <span class=" {{$firstLeafText_cssClasses}}">{{$menuEntry['Label']}}</span>
                        </a>
                    </li>
                @elseif ($menutree::isTopNode($menuEntry))
                    <li class='{{$liWrapper_1}}'>
                        <details class="">
                            <summary class="{{$jDetails_summary_cssClasses}}">
                                @if (! empty($menuEntry['SvgHtml']) )
                                    {!! $menuEntry['SvgHtml'] !!}
                                @elseif (! empty($menuEntry['IconName']) )
                                    {{-- If you see something like: ErrorException Svg by name "o-homeasdf" from set "heroicons" not found...--}}
                                    {{-- [ ] Did you put 'x-' in front.  You should use 'heroicon-o-home', not 'x-heroicon-o-home'--}}
                                    {{-- [ ] Did you need to install this font kit, like 'composer require blade-ui-kit/blade-heroicons' as specified on the --}}
                                    {{--     https://blade-ui-kit.com/blade-icons/heroicon-o-home                            --}}
                                    {{-- Try visiting https://blade-ui-kit.com/blade-icons.--}}
                                    @svg($menuEntry['IconName'], $icon_cssClasses)
                                @endif
                                <span class=" {{$firstLeafText_cssClasses}}">{{$menuEntry['Label']}}</span>
                            </summary>
                            <div class="jDetails_body {{$jDetails_body_cssClasses}}">
                                <ul>
                                    @php
                                        #$hasMoreSubMenus = true; #presumably, the first time, we'll see
                                        $hasMoreSubMenus = isset($menuKeys[$i+1]) && !$menutree::isTop( $menutree->asrMenus[$menuKeys[$i+1]]);#presumably, the first time, we'll see it, but if not, lets recovery gracefully
                                        $depth = 2;
                                        $lastItemWasType = null;
                                    @endphp
                                    @while ($hasMoreSubMenus || $i > 2000)
                                        @php

                                            $hasMoreSubMenus = isset($menuKeys[$i+1]) && !$menutree::isTop( $menutree->asrMenus[$menuKeys[$i+1]]);

                                        @endphp
                                        @if ($hasMoreSubMenus)
                                            @php  $i++; $key = $menuKeys[$i];
                                            $menuEntry = $menutree->asrMenus[$key];
                                            @endphp
                                            @if ($menutree::isGroup($menuEntry))
                                                @php
                                                    if (is_null($lastItemWasType) || $lastItemWasType == 'Link') {
                                                        $depth = 2; // Groups don't go more than one deeper, a new group resets
                                                        $lastItemWasType = 'Group';
                                                    }
                                                @endphp
                                                <li>
                                                    <div class="{{$secondBreak_cssClasses}}">{{$menuEntry['Label']}}</div>
                                                </li>
                                            @elseif ($menutree::isLink($menuEntry))
                                                @php
                                                    if ($lastItemWasType == 'Group') {
                                                        $depth = 3;
                                                        $lastItemWasType = 'Link';
                                                    }
                                                @endphp
                                                <li>
                                                    <a class="{{($depth == 2) ? $secondLeaf_cssClasses : ($depth == 3 ? $thirdLeaf_cssClasses : dd([__FILE__,__LINE__,"Too deep"]))}} {{$menutree::isOnThisRoute($menuEntry) ? 'font-extrabold text-lg' : ''}} "
                                                        {!! fancyLinkInA('/admin/communication_template') !!}>{{$menuEntry['Label']}}</a>
                                                </li>
                                            @elseif ($menutree::isTop($menuEntry))
                                                {{--  Do Nothing--}}
                                                 @php dd([__FILE__,__LINE__,"YIKES:",'i'=>$i, '$key'=>$key, '$menuEntry'=>$menuEntry, 'menutree'=>$menutree]); @endphp
                                            @endif
                                        @endif
                                    @endwhile
                                </ul>
                            </div>
                        </details>
                    </li>
                @else
                    @php dump([__FILE__,__LINE__,"YIKES:",'i'=>$i, '$key'=>$key, '$menuEntry'=>$menuEntry, 'menutree'=>$menutree]); @endphp
                @endif
            @endfor
        </ul>
    </nav>
</div>
