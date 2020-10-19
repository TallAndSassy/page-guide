<x-tassy::page-_base>
    <x-tassy::header.back.index title="{{$title}}"/>
    <hr>


    <!-- Static sidebar for desktop -->
    <div class="flex flex-shrink-0">

        <div class="h-0 flex-1 flex flex-col overflow-y-auto">
            <div class="flex-1 bg-gray-800">
                {{--                        @livewire('sidenav')--}}
{{-- <livewire:tassy::livewire.sidenav/>--}}
            </div>
            <div class="flex-shrink-0 flex bg-gray-700 align-bottom">
                {{--                        @livewire('lowernav')--}}
{{--                <livewire:tassy::livewire.lowernav/>--}}
            </div>
        </div>
    </div>
    </div>
    {{$slot}}
    <x-tassy::footer.back.index/>
</x-tassy::page-_base>
