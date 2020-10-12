<div class="flex">
    <div class="bg-gray-800">
        <x-tassy::header.back.corner-block/>
    </div>
    <div class="bg-red-400 ">
        <x-tassy::header.back.title>{{$title}}</x-tassy::header.back.title>
    </div>
    <x-tassy::header.back.menu/>
    {{$slot}}
</div>
