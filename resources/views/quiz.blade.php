<x-app-layout>
    <x-slot name="header">
        {{$quiz->title}}
    </x-slot>

    <div class="card">
        <div class="card-body">
            <p class="card-text">
                @foreach ($collection as $item)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1"
                        value="option1" checked>
                    <label class="form-check-label" for="exampleRadios1">
                        Default radio
                    </label>
                </div>
                 @endforeach
            </p>
        </div>
    </div>

</x-app-layout>
